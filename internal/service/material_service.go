package service

import (
	"context"
	"projeto/internal/domain"
	"projeto/internal/usecase"
	"projeto/internal/util"
)

func NewMaterialService(re usecase.MaterilRepository) materialService {
	return materialService{
		Re: re,
	}
}

type materialService struct {
	Re usecase.MaterilRepository
}

func (s *materialService) CreateMaterial(input *domain.MaterialCreated) error {
	ctx, cancel := context.WithTimeout(context.Background(), util.TIMEOUT)
	defer cancel()

	material := usecase.DtoToMaterial(*input)
	return s.Re.Create(ctx, &material)
}

func (s *materialService) FindMaterial(inicio, limite uint) ([]domain.Material, error) {
	offset := (inicio - 1) * limite
	ctx, cancel := context.WithTimeout(context.Background(), util.TIMEOUT)
	defer cancel()
	return s.Re.FindMaterials(ctx, inicio, offset)
}
