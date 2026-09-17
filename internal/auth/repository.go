package auth

import (
	"context"

	"github.com/jackc/pgx/v5"
)

type authRepository struct {
	DB *pgx.Conn
}

func NovoAuthRepository(db *pgx.Conn) *authRepository {
	return &authRepository{
		DB: db,
	}
}

func (repository *authRepository) salvarUsuario(ctx context.Context, usuario *UsuarioCriacao) error {
	_, err := repository.DB.Exec(ctx, "INSERT INTO usuarios (nome,email,curso,ano) VALUES ($1,$2,$3,$4)", usuario.Nome, usuario.Email, usuario.Curso, usuario.Ano)
	return err
}

func (repository *authRepository) buscarUsuarios(ctx context.Context) ([]Usuario, error) {
	usuarios := []Usuario{}
	rows, err := repository.DB.Query(ctx, "SELECT id,nome,email,curso,ano,criado_em,esta_deletado")
	for rows.Next() {
		u := Usuario{}
		if err := rows.Scan(&u.ID, u.Nome, u.Email, u.Curso, u.Ano, u.CriadoEm, u.EstaDeletado); err != nil {
			return usuarios, err
		}
		usuarios = append(usuarios, u)
	}

	return usuarios, err
}

func (repository *authRepository) atualizarAnoUsuario(ctx context.Context, ano, id uint) error {
	_, err := repository.DB.Exec(ctx, "UPDATE FROM usuarios SET ano = $1 WHERE id = $2", ano, id)
	return err
}

func (repostory *authRepository) deletarUsuario(ctx context.Context, id uint) error {
	_, err := repostory.DB.Exec(ctx, "UPDATE FROM usuarios SET esta_deletado = true WHERE id = $1", id)
	return err
}

func (repository *authRepository) deletarUsuarioPermanente(ctx context.Context, id uint) error {
	_, err := repository.DB.Exec(ctx, "DELETE FROM usuarios WHERE id = $1", id)
	return err
}
