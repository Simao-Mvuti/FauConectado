package service

import (
	"context"
	"projeto/internal/domain"
	"projeto/internal/usecase"
	"time"
)

func NewADMService(re usecase.ADMRepository) admService {
	return admService{
		Re: re,
	}
}

type admService struct {
	Re usecase.ADMRepository
}

func (s *admService) DeleteUser(id uint) error {
	ctx, cancel := context.WithTimeout(context.Background(), 5*time.Second)
	defer cancel()
	return s.Re.DeleteUser(ctx, id)
}

func (s *admService) ListUser(inicio, fim uint) ([]domain.User, error) {
	ctx, cancel := context.WithTimeout(context.Background(), 5*time.Second)
	defer cancel()
	offset := (inicio - 1) * fim
	return s.Re.ListUser(ctx, inicio, offset)
}
