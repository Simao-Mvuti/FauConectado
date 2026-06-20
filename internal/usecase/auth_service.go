package usecase

import (
	"projeto/internal/domain"
)

type AuthService interface {
	Login(input *domain.UserLogin) (string, error)
	CreateUser(input *domain.UserCreate) error
}

type AuthRepository interface {
	FindUserByEmail(email string) (*domain.User, error)
	RegiterUser(input *domain.User) error
}
