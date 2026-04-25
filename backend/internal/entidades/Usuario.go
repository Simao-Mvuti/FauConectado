package model

import (
	"strings"
)

type Usuario struct {
	Id    string `db:"id"`
	Nome  string `db:"nome"`
	Email string `db:"email"`
	Senha string `db:"senha"`
	curso string `db:"curso"`
	Ano   int    `db:"ano"`
}

type UsuarioCadastro struct {
	Nome  string `json:"nome" binding:"required,min=3,max=30"`
	Email string `json:"email" binding:"required,email"`
	Senha string `json:"senha" binding:"required,min=3"`
	curso string `json:"curso"`
	Ano   int    `json:"ano" binding:"gt=0",lte=5"`
}

type UsuarioLogin struct {
	Email string `json:"email" binding:"required,email"`
	Senha string `json:"senha" binding:"required,min=3"`
}

func (u UsuarioCadastro) ToUsuario() Usuario {
	return Usuario{
		Nome:  strings.TrimSpace(u.Nome),
		Email: strings.TrimSpace(u.Email),
		Senha: strings.TrimSpace(u.Senha),
		curso: strings.TrimSpace(u.curso),
		Ano:   u.Ano,
	}
}
