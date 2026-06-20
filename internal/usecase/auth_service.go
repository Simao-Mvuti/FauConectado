package usecase

import (
	"context"
	"projeto/internal/domain"
)

type AuthService interface {
	Login(input *domain.UserLogin) (string, error)
	CreateUser(input *domain.UserCreate) error
}

type AuthRepository interface {
	FindUserByEmail(ctx context.Context, email string) (*domain.User, error)
	RegiterUser(ctx context.Context, input *domain.User) error
}
