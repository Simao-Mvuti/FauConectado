package usecase

import "projeto/internal/domain"

func DtoToMaterial(dto domain.MaterialCreated) domain.Material {
	return domain.Material{
		Title:       dto.Title,
		Description: dto.Description,
		User_id:     dto.User_id,
		File_Url:    dto.File_Url,
		Type:        dto.Type,
	}
}
