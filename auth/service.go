package auth

import "context"

type service struct {
	Re Repository
}

func NewService(re Repository) *service {
	return &service{
		Re: re,
	}
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

func (service *service) salvarUsuario(usuario *usuario) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.salvarUsuario(ctx, usuario)
}

func (service *service) deletarUsuario(id string) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	return service.Re.deletarUsuario(ctx, id)
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

type Repository interface {
	numerosUsuarios(ctx context.Context) (uint, error)
	salvarUsuario(ctx context.Context, usuario *usuario) error
	deletarUsuario(ctx context.Context, id string) error
	atualizarUsuarioNome(ctx context.Context, id string, nome string) error
	atualizarUsuarioSenha(ctx context.Context, id string, senha string) error
	buscarUsuarioPorEmail(ctx context.Context, email string) (*usuario, error)
	buscarUsuarioPorID(ctx context.Context, id string) (*usuario, error)
	buscarUsuarios(ctx context.Context) ([]usuario, error)
}
