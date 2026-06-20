package util

import (
	"projeto/internal/domain"
	"strings"
)

func Saniticacao_login(input *domain.UserLogin) *domain.User {
	return &domain.User{
		Email:    strings.TrimSpace(input.Email),
		Password: strings.TrimSpace(input.Password),
	}
}

func Saniticacao_create(input *domain.UserCreate) *domain.User {
	return &domain.User{
		Nome:     strings.TrimSpace(input.Nome),
		Email:    strings.TrimSpace(input.Email),
		Password: strings.TrimSpace(input.Password),
	}
}
