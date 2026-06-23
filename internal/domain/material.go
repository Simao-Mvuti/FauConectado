package domain

import "time"

type MaterialCreated struct {
	Title       string `json:"title" binding:"required min=2 max=50"`
	Description string `json:"description"`
	UserID      int    `json:"user_id" binding:"required"`
	FileUrl     string `json:"file_url" binding:"required"`
	Type        string `json:"type_file" binding:"required"`
	MaterialID  int    `db:"material_id"`
}

type Material struct {
	id          int       `db:"id"`
	Title       string    `db:"title"`
	Description string    `db:"description"`
	UserID      int       `db:"user_id"`
	FileURL     string    `db:"file_url"`
	Type        string    `db:"document_type"`
	Point       int       `db:"point"`
	CuorseID    int       `db:"cuorse_id"`
	CreatedAt   time.Time `db:"created_at"`
}
