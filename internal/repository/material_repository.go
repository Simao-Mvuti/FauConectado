package repository

import (
	"context"
	"projeto/internal/domain"

	"github.com/jmoiron/sqlx"
)

func NewMaterialRepository(db *sqlx.DB) materialRepository {
	return materialRepository{
		DB: db,
	}
}

type materialRepository struct {
	DB *sqlx.DB
}

func (r *materialRepository) Create(ctx context.Context, material domain.Material) error {
	query := "INSERT INTO materials (title,description,user_id,file_url,type,course_id,created_at) VALUES($1,$2,$3,$4,$5,$6,$7)"
	_, err := r.DB.ExecContext(ctx, query, material.Title, material.Description, material.UserID, material.FileURL, material.Type, material.CuorseID)
	return err
}

func (r *materialRepository) FindMaterials(ctx context.Context, limit, offset uint) ([]domain.Material, error) {
	var materias []domain.Material
	query := "SELECT id,title,description,user_id,file_url,type,point,course_id,created_at LIMIT $1 OFFSET $2"
	err := r.DB.SelectContext(ctx, &materias, query, limit, offset)
	if err != nil {
		return materias, err
	}

	return materias, nil
}
