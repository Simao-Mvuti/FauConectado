package auth

import (
	"context"
	"time"
)

type service struct {
	Re        Repository
	JWTCodigo string
}

func newService(re Repository, jwtCodigo string) *service {
	return &service{
		Re: re,
	}
}

func (service *service) recuperarSenha(email RecuperarPassword) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()

	usuario, err := service.Re.buscarUsuarioPorEmail(ctx, email.Email)
	if err != nil {
		return err
	}

	token, err := GerarTokenRecuperacao(usuario.ID)
	if err != nil {
		return err
	}

	if err := service.Re.salvarTokenResetPassword(ctx, token); err != nil {
		return err
	}

	return nil
}

func (service *service) logout(id string) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()

	if err := service.Re.deletarRefreshToken(ctx, id); err != nil {
		return err
	}

	return nil
}

func (service *service) login(input usuarioLogin) (string, string, error) {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()

	usuarioEcontrado, err := service.Re.buscarUsuarioPorEmail(ctx, input.Email)
	if err != nil {
		return "", "", CREDENCIAIS_INVALIDOS
	}

	if usuarioEcontrado == nil {
		return "", "", CREDENCIAIS_INVALIDOS
	}

	if !CompararSenha(input.Senha, usuarioEcontrado.Senha) {

		return "", "", CREDENCIAIS_INVALIDOS
	}

	token, err := GerarTokenJWT(usuarioEcontrado.ID, usuarioEcontrado.Email, usuarioEcontrado.Papel, service.JWTCodigo, 24*time.Minute)
	if err != nil {
		return "", "", err
	}

	refreshtoken, err := GerarTokenJWT(usuarioEcontrado.ID, usuarioEcontrado.Email, usuarioEcontrado.Papel, service.JWTCodigo, 1*time.Hour)
	if err != nil {
		return "", "", err
	}

	refreshToken := ResfresToken{
		Token:     refreshtoken,
		UsuarioID: usuarioEcontrado.ID,
		ExpiraEm:  time.Now().Add(48 * time.Minute),
	}

	if err := service.Re.salvarRefreshToken(ctx, refreshToken); err != nil {
		return "", "", err
	}

	return token, refreshtoken, nil
}

func (service *service) CriarTabelaUsuario() error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.CriarTabelaUsuarios(ctx)
}

func (service *service) atualizarUsuarioNome(id string, nome string) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.atualizarUsuarioNome(ctx, id, nome)
}

func (service *service) numerosUsuarios() (uint, error) {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	total, err := service.Re.numerosUsuarios(ctx)
	return total, err
}

func (service *service) salvarUsuario(input *usuarioCadastro) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	usuarioEncontrado, err := service.buscarUsuarioPorEmail(input.Email)
	if err != nil {
		return err
	}

	if usuarioEncontrado != nil {
		return EMAIL_EXISTENTE
	}

	hash, err := CriptografarSenha(input.Senha)
	if err != nil {
		return err
	}

	usuario := input.ToUsuario(hash)

	return service.Re.salvarUsuario(ctx, usuario)
}

func (service *service) deletarUsuario(id string) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.deletarUsuario(ctx, id)
}

func (service *service) deletarUsuarioPermanentemente(ctx context.Context, id string) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.deletarUsuarioPermanentemente(ctx, id)
}

func (service *service) atualizarUsuarioSenha(id, senha string) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.atualizarUsuarioSenha(ctx, id, senha)
}

func (service *service) buscarUsuarioPorEmail(email string) (*usuario, error) {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.buscarUsuarioPorEmail(ctx, email)
}

func (service *service) buscarUsuarioPorID(id string) (*usuario, error) {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.buscarUsuarioPorID(ctx, id)
}

func (service *service) buscarUsuarios() ([]usuario, error) {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.buscarUsuarios(ctx)
}

func (service *service) buscarUsuariosTodos(ctx context.Context) ([]usuario, error) {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.buscarUsuariosTodos(ctx)
}

type Repository interface {
	numerosUsuarios(ctx context.Context) (uint, error)
	salvarUsuario(ctx context.Context, usuario *usuario) error
	deletarUsuario(ctx context.Context, id string) error
	deletarUsuarioPermanentemente(ctx context.Context, id string) error
	atualizarUsuarioNome(ctx context.Context, id string, nome string) error
	atualizarUsuarioSenha(ctx context.Context, id string, senha string) error
	buscarUsuarioPorEmail(ctx context.Context, email string) (*usuario, error)
	buscarUsuarioPorID(ctx context.Context, id string) (*usuario, error)
	buscarUsuarios(ctx context.Context) ([]usuario, error)
	buscarUsuariosTodos(ctx context.Context) ([]usuario, error)
	CriarTabelaUsuarios(ctx context.Context) error
	salvarRefreshToken(ctx context.Context, refreshToken ResfresToken) error
	deletarRefreshToken(ctx context.Context, id string) error
	salvarTokenResetPassword(ctx context.Context, token *PasswordResetToken) error
}
