package usecase

import "projeto/internal/domain"

func DtoToMaterial(dto domain.MaterialCreated) domain.Material {
	return domain.Material{
		Title:       dto.Title,
		Description: dto.Description,
		UserID:      dto.UserID,
		FileURL:     dto.FileUrl,
		Type:        dto.Type,
	}
}
