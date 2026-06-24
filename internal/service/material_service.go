package service

import (
	"context"
	"os"
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

func (s *materialService) CreateMaterial(input *domain.MaterialCreated, userId uint, url string) error {
	ctx, cancel := context.WithTimeout(context.Background(), util.TIMEOUT)
	defer cancel()

	material := usecase.DtoToMaterial(*input)
	material.UserID = userId
	material.FileURL = url
	err := s.Re.CreateMaterial(ctx, &material)
	if err != nil {
		os.Remove(url)
		return err
	}

	return nil
}

func (s *materialService) FindMaterials(inicio, limite uint) ([]domain.Material, error) {
	offset := (inicio - 1) * limite
	ctx, cancel := context.WithTimeout(context.Background(), util.TIMEOUT)
	defer cancel()
	return s.Re.FindMaterials(ctx, inicio, offset)
}

func (s *materialService) DeleteMaterial(id uint) error {
	ctx, cancel := context.WithTimeout(context.Background(), util.TIMEOUT)
	defer cancel()
	return s.Re.DeleteMaterial(ctx, id)
}
