package service

import (
	model "faculdadeConectado/internal/entidades"
	"faculdadeConectado/internal/repository/interfaces"
	"fmt"

	"golang.org/x/crypto/bcrypt"
)

func NewService(repository interfaces.UsuarioInterface) *UsuarioService {
	return &UsuarioService{
		repo: repository,
	}
}

type UsuarioService struct {
	repo interfaces.UsuarioInterface
}

func (U UsuarioService) CadastrarUsuario(input model.UsuarioCadastro) error {
	usuario := input.ToUsuario()
	senha, err := bcrypt.GenerateFromPassword([]byte(usuario.Senha), bcrypt.DefaultCost)
	if err != nil {
		return fmt.Errorf("Erro ao gerar Senha,Detalhe %v", err)
	}

	usuario.Senha = string(senha)
	err = U.repo.SalvarUsuario(usuario)
	if err != nil {
		return fmt.Errorf("Erro ao salvar no banco,Detalhe", err)
	}

	return nil
}

func (U UsuarioService) Login(input model.UsuarioLogin) error {
	usuario, err := U.repo.BuscarUsuarioPorEmail(input.Email)
	if err != nil {
		return fmt.Errorf("Erro ao buscar usuario,Detalhe &v", err)
	}

	err = bcrypt.CompareHashAndPassword([]byte(usuario.Senha), []byte(input.Senha))

	if err != nil {
		return fmt.Errorf("Senha errada,Detalhe &v", err)
	}

	return nil
}
