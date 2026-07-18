package service

import (
	"context"
	"uinotify/internal/auth"
	"uinotify/internal/model"
	"uinotify/internal/repository"
)

type InformacoesService struct {
	Repo *repository.InformacoesRepository
}

func (service *InformacoesService) BuscarNoticias() ([]model.Noticia, error) {
	ctx, cancel := context.WithTimeout(context.Background(), auth.TIMEOUT_DB)
	defer cancel()
	return service.Repo.BuscarNoticias(ctx)
}
