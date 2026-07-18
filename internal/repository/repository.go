package repository

import (
	"context"
	"uinotify/internal/model"

	"github.com/jackc/pgx/v5"
)

type InformacoesRepository struct {
	DB *pgx.Conn
}

func (repository *InformacoesRepository) BuscarNoticias(ctx context.Context) ([]model.Noticia, error) {
	noticias := []model.Noticia{}
	rows, err := repository.DB.Query(ctx, "SELECT titulo,categoria,descricao FROM noticias")
	for rows.Next() {
		n := model.Noticia{}
		if err := rows.Scan(&n.Titulo, &n.Categoria, &n.Descricao); err != nil {
			return noticias, err
		}
		noticias = append(noticias, n)
	}
	return noticias, err
}
