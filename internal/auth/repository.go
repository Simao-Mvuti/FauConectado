package auth

import (
	"database/sql"
)

type Repository struct {
	DB *sql.DB
}

func (r *Repository) findUserForEmail(input string) (*User, error) {
	user := new(User)
	query := "SELECT id,nome,email,password FROM user WHERE email = $1"
	row := r.DB.QueryRow(query, input)
	err := row.Scan(&user.ID, &user.Nome, &user.Email, &user.Password)

	return user, err
}

func (r *Repository) regiterUser(input User) error {
	query := "INSERT INTO user (nome,email,password) VALUES ($1,$2,$3)"
	_, err := r.DB.Exec(query, input.Nome, input.Email, input.Password)
	if err != nil {
		return &ErrorInternal{
			Erro:  err.Error(),
			Local: "Repository",
		}
	}

	return nil
}
