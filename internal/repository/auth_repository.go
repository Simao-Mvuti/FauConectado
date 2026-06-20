package repository

import (
	"database/sql"
	"errors"
	"projeto/internal/domain"
	"strings"
)

func NewAuthRepository(db *sql.DB) authRepository {
	return authRepository{
		DB: db,
	}
}

type authRepository struct {
	DB *sql.DB
}

func (r *authRepository) FindUserByEmail(email string) (*domain.User, error) {
	user := new(domain.User)

	query := `
		SELECT id,name,email,password
		FROM users
		WHERE email = $1
	`

	row := r.DB.QueryRow(query, email)

	err := row.Scan(
		&user.Id,
		&user.Name,
		&user.Email,
		&user.Password,
	)

	if err != nil {
		if errors.Is(err, sql.ErrNoRows) {
			return nil, domain.ErrUserNotFound
		}

		return nil, err
	}

	return user, nil
}

func (r *authRepository) RegiterUser(input *domain.User) error {
	existeUser, err := r.FindUserByEmail(input.Email)
	if existeUser != nil && err == nil {
		return domain.ErrEmailAlreadyExists
	}

	if err != nil && !errors.Is(err, domain.ErrUserNotFound) {
		return err
	}

	query := "INSERT INTO users (name,email,password) VALUES ($1,$2,$3)"
	_, err = r.DB.Exec(query, input.Name, input.Email, input.Password)

	if err != nil {
		if strings.Contains(err.Error(), "duplicate key") {
			return domain.ErrEmailAlreadyExists
		}

		return err
	}

	return nil
}
