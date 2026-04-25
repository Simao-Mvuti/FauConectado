package interfaces

import model "faculdadeConectado/internal/entidades"

type UsuarioInterface interface {
	SalvarUsuario(usuario model.Usuario) error
	BuscarUsuarioPorEmail(email string) (model.Usuario, error)
}
