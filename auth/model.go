package auth

import (
	"strings"
	"time"

	"github.com/golang-jwt/jwt/v5"
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
	Nome  string `json:"nome" form:"nome" validate:"required,min=2,max=30"`
	Email string `json:"email" form:"email" validate:"required,email"`
	Senha string `json:"senha" form:"senha" validate:"required"`
}

type usuarioLogin struct {
	Email string `json:"email" form:"email" validate:"email"`
	Senha string `json:"senha" form:"senha" validate:"required"`
}

type RecuperarPassword struct {
	Email string `json:"email" form:"email"`
}

type PasswordResetToken struct {
	UserID    string
	Token     string
	ExpiresAt time.Time
}

type ClamsCustom struct {
	Id    string `json:"id_user"`
	Email string `json:"email"`
	Papel string `json:"papel"`
	jwt.RegisteredClaims
}
type ResfresToken struct {
	ID         string
	UsuarioID  string
	Token      string
	ExpiraEm   time.Time
	CriatedoEm time.Time
}

func (usuarioCadastro *usuarioCadastro) ToUsuario(senhaHash string) *usuario {
	return &usuario{
		Nome:        strings.TrimSpace(usuarioCadastro.Nome),
		Email:       strings.TrimSpace(usuarioCadastro.Email),
		Senha:       senhaHash,
		DataCriacao: time.Now(),
	}
}
