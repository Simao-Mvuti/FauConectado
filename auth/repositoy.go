package auth

import (
	"context"
	"database/sql"
)

type repository struct {
	db *sql.DB
}

func NewRepository(db *sql.DB) *repository {
	return &repository{
		db: db,
	}
}

func (repository *repository) numerosUsuarios(ctx context.Context) (uint, error) {
	query := "SELECT COUNT(*) FROM usuarios"
	var total uint
	row := repository.db.QueryRowContext(ctx, query)
	err := row.Scan(&total)
	return total, err
}

func (repository *repository) salvarUsuario(ctx context.Context, usuario *usuario) error {
	query := "INSERT INTO usuarios (id,nome,email,papel,senha) VALUES ($1,$2,$3,%3,%4)"
	_, err := repository.db.ExecContext(ctx, query, usuario.ID, usuario.Nome, usuario.Email, usuario.Papel, usuario.Senha)
	return err
}

func (repository *repository) deletarUsuario(ctx context.Context, id string) error {
	query := "DELETE usuarios WHERE id = $1"
	_, err := repository.db.ExecContext(ctx, query, id)
	return err
}

func (repository *repository) atualizarUsuarioNome(ctx context.Context, id string, nome string) error {
	query := "UPDATE FROM usuarios SET nome = $1 WHERE id = $2"
	_, err := repository.db.ExecContext(ctx, query, nome, id)
	return err
}

func (repository *repository) atualizarUsuarioSenha(ctx context.Context, id string, senha string) error {
	query := "UPDATE FROM usuarios SET senha = $1 WHERE id = $2"
	_, err := repository.db.ExecContext(ctx, query, senha, id)
	return err
}

func (repository *repository) buscarUsuarioPorEmail(ctx context.Context, email string) (*usuario, error) {
	query := "SELECT id,nome,email,papel,senha FROM usuarios WHERE email = $1"
	usuario := usuario{}
	row := repository.db.QueryRowContext(ctx, query, email)
	if err := row.Scan(&usuario.ID, &usuario.Nome, &usuario.Email, &usuario.Papel, &usuario.Senha); err != nil {
		return &usuario, err
	}

	return &usuario, nil
}

func (repository *repository) buscarUsuarioPorID(ctx context.Context, id string) (*usuario, error) {
	query := "SELECT id,nome,email,papel,senha FROM usuarios WHERE id = $1"
	usuario := usuario{}
	row := repository.db.QueryRowContext(ctx, query, id)
	if err := row.Scan(&usuario.ID, &usuario.Nome, &usuario.Email, &usuario.Papel, &usuario.Senha); err != nil {
		return &usuario, err
	}

	return &usuario, nil
}

func (repository *repository) buscarUsuarios(ctx context.Context) ([]usuario, error) {
	query := "SELECT id,nome,email,papel,senha FROM usuarios"
	var usuarios = []usuario{}
	rows, err := repository.db.QueryContext(ctx, query)
	if err != nil {
		return usuarios, err
	}

	for rows.Next() {
		u := usuario{}
		if err := rows.Scan(&u.ID, &u.Nome, &u.Email, &u.Papel, &u.Senha); err != nil {
			return usuarios, err
		}

		usuarios = append(usuarios, u)
	}

	return usuarios, err
}
