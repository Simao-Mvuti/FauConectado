package auth

import (
	"time"
)

type Usuario struct {
	ID           uint
	Ano          uint
	Nome         string
	Email        string
	Curso        string
	EstaDeletado bool
	CriadoEm     time.Time
}

type UsuarioCriacao struct {
	Ano   uint   `form:"ano" validate:"required,gte=1,lte=5"`
	Nome  string `form:"nome" validate:"required,min=2,max=30"`
	Email string `form:"email" validate:"required,email"`
	Curso string `form:"curso" validate:"required"`
}
