package repository

import (
	"context"
	"database/sql"
	"projeto/internal/domain"
)

func NewMaterialRepository(db *sql.DB) materialRepository {
	return materialRepository{
		DB: db,
	}
}

type materialRepository struct {
	DB *sql.DB
}

func (r *materialRepository) Create(ctx context.Context, material domain.Material) error {
	query := "INSERT INTO materials (title,description,user_id,file_url,type,point,created_at) VALUES($1,$2,$3,$4,$5,$6,$7)"
	_, err := r.DB.ExecContext(ctx, query, material.Title, material.Description, material.User_id, material.File_Url, material.Type, material.Point, material.Created_at)
	return err
}

func (r *materialRepository) FindMaterials(ctx context.Context, limit, offset uint) ([]domain.Material, error) {
	var materias []domain.Material
	query := "SELECT id,title,description,user_id,file_url,type,point,created_at LIMIT $1 OFFSET $2"
	rows, err := r.DB.QueryContext(ctx, query, limit, offset)
	if err != nil {
		return materias, err
	}

	for rows.Next() {
		material := domain.Material{}
		err := rows.Scan(
			&material.Id,
			&material.Title,
			&material.Description,
			&material.User_id,
			&material.File_Url,
			&material.Type,
			&material.Point,
			&material.Created_at,
		)

		if err != nil {
			return materias, err
		}

		materias = append(materias, material)
	}

	return materias, nil
}
