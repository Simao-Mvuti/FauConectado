package repository

import (
	"context"
	"database/sql"
	"errors"
	"projeto/internal/domain"
)

func NewADMpository(db *sql.DB) admRepository {
	return admRepository{
		DB: db,
	}
}

type admRepository struct {
	DB *sql.DB
}

func (r *admRepository) DeleteUser(ctx context.Context, id uint) error {
	query := "DELETE FROM users WHERE id = $1"
	_, err := r.DB.ExecContext(ctx, query, id)
	return err
}

func (r *admRepository) ListUser(ctx context.Context, inicio, offset uint) ([]domain.User, error) {
	users := []domain.User{}
	query := "SELECT id,name,email,password FROM users LIMIT $1 OFFSET $2"
	rows, err := r.DB.QueryContext(ctx, query, inicio, offset)
	if err != nil {
		if errors.Is(err, sql.ErrNoRows) {
			return users, domain.ErrUserNotFound
		}
		return users, err
	}

	for rows.Next() {
		user := domain.User{}
		if err := rows.Scan(&user.Id, &user.Name, &user.Email, &user.Password); err != nil {
			return users, err
		}

		users = append(users, user)
	}

	return users, nil
}
