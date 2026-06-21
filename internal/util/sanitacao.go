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
		Name:     strings.TrimSpace(input.Name),
		Email:    strings.TrimSpace(input.Email),
		Password: strings.TrimSpace(input.Password),
	}
}

func Saniticacao_Material(input *domain.MaterialCreated) *domain.MaterialCreated {
	return &domain.MaterialCreated{
		Title:       strings.TrimSpace(input.Title),
		Description: strings.TrimSpace(input.Description),
		Type:        strings.TrimSpace(input.Type),
	}
}
