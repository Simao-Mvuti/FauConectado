package auth

import (
	"strings"
	"time"
)

type usuario struct {
	ID           string
	Nome         string
	Email        string
	Papel        string
	Senha        string
	DataCriacao  time.Time
	EstaDeletado bool
}

type usuarioCadastro struct {
	Nome  string `json:"nome"`
	Email string `json:"email"`
	Senha string `json:"senha"`
}

type usuarioLogin struct {
	Email string `json:"email"`
	Senha string `json:"senha"`
}

func (usuarioCadastro *usuarioCadastro) ToUsuario(senhaHash string) *usuario {
	return &usuario{
		Nome:        strings.TrimSpace(usuarioCadastro.Nome),
		Email:       strings.TrimSpace(usuarioCadastro.Email),
		Senha:       senhaHash,
		DataCriacao: time.Now(),
	}
}
