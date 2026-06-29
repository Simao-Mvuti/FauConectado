package auth

import (
	"database/sql"
)

type Handler struct {
	Service Service
}

func NewHandler(db *sql.DB) *Handler {
	repository := NewRepository(db)
	service := NewService(repository)
	return &Handler{
		Service: service,
	}
}

type Service interface {
	numerosUsuarios() (uint, error)
	salvarUsuario(usuario *usuario) error
	deletarUsuario(id string) error
	atualizarUsuarioNome(id string, nome string) error
	atualizarUsuarioSenha(id string, senha string) error
	buscarUsuarioPorEmail(email string) (*usuario, error)
	buscarUsuarioPorID(id string) (*usuario, error)
	buscarUsuarios() ([]usuario, error)
}
