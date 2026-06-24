package repository

import (
	"context"
	"database/sql"
	"errors"
	"projeto/internal/domain"
	"strings"

	"github.com/jmoiron/sqlx"
)

func NewAuthRepository(db *sqlx.DB) authRepository {
	return authRepository{
		DB: db,
	}
}

type authRepository struct {
	DB *sqlx.DB
}

func (r *authRepository) FindUserByEmail(ctx context.Context, email string) (*domain.User, error) {
	user := domain.User{}

	query := `
		SELECT id,name,email,password,course,year,role
		FROM users
		WHERE email = $1
	`

	err := r.DB.GetContext(ctx, &user, query, email)
	if err != nil {
		if errors.Is(err, sql.ErrNoRows) {
			return nil, domain.ErrUserNotFound
		}

		return nil, err
	}

	return &user, nil
}

func (r *authRepository) RegiterUser(ctx context.Context, input *domain.User) error {
	query := "INSERT INTO users (name,email,password,course ,year,role) VALUES ($1,$2,$3,$4,$5,$6)"
	_, err := r.DB.ExecContext(ctx, query, input.Name, input.Email, input.Password, input.Course, input.Year, input.Role)

	if err != nil {
		if strings.Contains(err.Error(), "duplicate key") {
			return domain.ErrEmailAlreadyExists
		}

		return err
	}

	return nil
}
