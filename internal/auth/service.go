package auth

import (
	"context"
	"log"
)

type authService struct {
	Repo *authRepository
}

func NovoAuthService(repository *authRepository) *authService {
	return &authService{
		Repo: repository,
	}
}

func (service *authService) criarConta(usuario *UsuarioCriacao) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	err := service.Repo.salvarUsuario(ctx, usuario)
	log.Println(err)
	return err
}

func (service *authService) buscarUsuarios() ([]Usuario, error) {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	usuarios, err := service.Repo.buscarUsuarios(ctx)
	log.Println(err)
	return usuarios, err
}

func (service *authService) atualizarUsuario(id, ano uint) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	err := service.Repo.atualizarAnoUsuario(ctx, ano, id)
	return err
}

func (service *authService) deletarUsuario(id uint) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	err := service.Repo.deletarUsuario(ctx, id)
	log.Println(err)
	return err
}

func (service *authService) deletarPermanenteUsuario(id uint) error {
	ctx, cancel := context.WithTimeout(context.Background(), TIMEOUT_DB)
	defer cancel()
	err := service.Repo.deletarUsuarioPermanente(ctx, id)
	log.Println(err)
	return err
}
