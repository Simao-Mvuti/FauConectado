package usecase

import (
	"context"
	"projeto/internal/domain"
)

type ADMRepository interface {
	ListUser(ctx context.Context, inicio, fim uint) ([]domain.User, error)
	DeleteUser(ctx context.Context, id uint) error
}

type ADMService interface {
	ListUser(inicio, fim uint) ([]domain.User, error)
	DeleteUser(id uint) error
}
