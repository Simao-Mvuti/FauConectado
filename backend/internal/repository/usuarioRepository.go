package repository

import (
	model "faculdadeConectado/internal/entidades"

	"github.com/jmoiron/sqlx"
)

func NewUsuarioRepository(db *sqlx.DB) *usuarioRepository {
	return &usuarioRepository{
		DB: db,
	}
}

type usuarioRepository struct {
	DB *sqlx.DB
}

func (u usuarioRepository) SalvarUsuario(usuario model.Usuario) error {
	query := "INSERT INTO usuarios (nome,email,senha,curso,ano) VALUES (:nome,:email,:senha,:curso,:ano)"
	_, err := u.DB.NamedExec(query, usuario)
	return err
}

func (u usuarioRepository) BuscarUsuarioPorEmail(email string) (model.Usuario, error) {
	var usuario model.Usuario
	query := "SELECT id,nome,senha,curso,ano FROM usuarios WHERE email=$1"
	err := u.DB.Get(&usuario, query, email)
	return usuario, err
}
