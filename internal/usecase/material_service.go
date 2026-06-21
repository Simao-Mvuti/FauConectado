package usecase

import (
	"context"
	"projeto/internal/domain"
)

type MaterilService interface {
	Create(material *domain.MaterialCreated) error
	FindMaterials(limit, offset uint) ([]domain.Material, error)
}

type MaterilRepository interface {
	Create(ctx context.Context, material *domain.Material) error
	FindMaterials(ctx context.Context, limit, offset uint) ([]domain.Material, error)
}
