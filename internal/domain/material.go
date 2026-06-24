package domain

import "time"

type MaterialCreated struct {
	Title       string `form:"title" binding:"required,min=2,max=50"`
	Description string `form:"description"`
	FileUrl     string `form:"file_url" binding:"required"`
	Type        string `form:"type_file" binding:"required"`
	CourseID    uint   `form:"course_id"`
}

type Material struct {
	Id          int       `db:"id"`
	Title       string    `db:"title"`
	Description string    `db:"description"`
	UserID      uint      `db:"user_id"`
	FileURL     string    `db:"file_url"`
	Type        string    `db:"document_type"`
	Point       int       `db:"point"`
	CreatedAt   time.Time `db:"created_at"`
}
