package usecase

import (
	"context"
	"projeto/internal/domain"
)

type MaterilService interface {
	CreateMaterial(material *domain.MaterialCreated, userID uint, url string) error
	FindMaterials(inicio, limite uint) ([]domain.Material, error)
	DeleteMaterial(id uint) error
}

type MaterilRepository interface {
	CreateMaterial(ctx context.Context, material *domain.Material) error
	FindMaterials(ctx context.Context, limit, offset uint) ([]domain.Material, error)
	DeleteMaterial(ctx context.Context, id uint) error
}
