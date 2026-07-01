package auth

import (
	"context"
	"database/sql"
	"errors"
)

type repository struct {
	db *sql.DB
}

func newRepository(db *sql.DB) *repository {
	return &repository{
		db: db,
	}
}

func (repository *repository) CriarTabelaUsuarios(ctx context.Context) error {
	query := `
    CREATE TABLE IF NOT EXISTS usuarios (
      	id 			UUID NOT NULL DEFAULT gen_random_uuid() PRIMARY KEY,
        nome        VARCHAR(30) NOT NULL,	
        email       VARCHAR(40) UNIQUE NOT NULL,     
        papel       VARCHAR(10) DEFAULT 'usuario',
        senha       TEXT,
        data_criacao  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        esta_deletado BOOL DEFAULT FALSE
		CONSTRAINT nome_nao_vazio CHECK (TRIM(nome) <> '')
		CONSTRAINT email_nao_vazio CHECK (TRIM(email) <> '')
    )
    `
	query2 := `
  			CREATE TABLE IF NOT EXISTS refresh_tokens (
    			id    UUID NOT NULL DEFAULT gen_random_uuid() PRIMARY KEY,
    			usuario_id    UUID NOT NULL, 
    			token_hash    TEXT NOT NULL,
    			expires_at    TIMESTAMP NOT NULL,
				created_at    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
			)
    `

	query3 := `CREATE TABLE IF NOT EXISTS password_resets (
		user_id    TEXT,
		token     TEXT,
		expires_At TIMESTAMP
	)
	`

	tx, err := repository.db.BeginTx(ctx, nil)
	if err != nil {
		return err
	}

	defer tx.Rollback()

	_, err = tx.ExecContext(ctx, query)
	if err != nil {
		return err
	}

	_, err = tx.ExecContext(ctx, query2)
	if err != nil {
		return err
	}

	_, err = tx.ExecContext(ctx, query3)
	if err != nil {
		return err
	}

	return tx.Commit()
}

func (repository *repository) salvarTokenResetPassword(ctx context.Context, token *PasswordResetToken) error {
	query := "INSERT INTO password_resets (user_id,token,expires) VALUES ($1,$2,$3)"
	_, err := repository.db.ExecContext(ctx, query, token.UserID, token.Token, token.ExpiresAt)
	return err
}

func (repository *repository) salvarRefreshToken(ctx context.Context, refreshToken ResfresToken) error {
	query := "INSERT INTO refresh_tokens (usuario_id, token_hash,expires_at) VALUES ($1,$2,$3)"
	_, err := repository.db.ExecContext(ctx, query, refreshToken.UsuarioID, refreshToken.Token, refreshToken.ExpiraEm)
	return err
}

func (repository *repository) deletarRefreshToken(ctx context.Context, id string) error {
	query := "DELETE refresh_tokens WHERE id = $1"
	_, err := repository.db.ExecContext(ctx, query, id)
	return err
}

func (repository *repository) numerosUsuarios(ctx context.Context) (uint, error) {
	query := "SELECT COUNT(*) FROM usuarios"
	var total uint
	row := repository.db.QueryRowContext(ctx, query)
	err := row.Scan(&total)
	return total, err
}

func (repository *repository) salvarUsuario(ctx context.Context, usuario *usuario) error {
	query := "INSERT INTO usuarios (nome,email,senha) VALUES ($1,$2,$3)"
	_, err := repository.db.ExecContext(ctx, query, usuario.Nome, usuario.Email, usuario.Senha)
	return err
}

func (repository *repository) deletarUsuarioPermanentemente(ctx context.Context, id string) error {
	query := "DELETE usuarios WHERE id = $1"
	_, err := repository.db.ExecContext(ctx, query, id)
	return err
}

func (repository *repository) deletarUsuario(ctx context.Context, id string) error {
	query := "UPDATE usuarios SET esta_deletado = true WHERE id = $1"
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
	query := "SELECT id,nome,email,papel,senha,data_criacao,esta_deletado FROM usuarios WHERE email = $1"
	usuario := usuario{}
	row := repository.db.QueryRowContext(ctx, query, email)
	if err := row.Scan(&usuario.ID, &usuario.Nome, &usuario.Email, &usuario.Papel, &usuario.Senha, &usuario.DataCriacao, &usuario.EstaDeletado); err != nil {
		return nil, err
	}

	return &usuario, nil
}

func (repository *repository) buscarUsuarioPorID(ctx context.Context, id string) (*usuario, error) {
	query := "SELECT id,nome,email,papel,senha,data_criacao,esta_deletado FROM usuarios WHERE id = $1"
	usuario := usuario{}
	row := repository.db.QueryRowContext(ctx, query, id)
	if err := row.Scan(&usuario.ID, &usuario.Nome, &usuario.Email, &usuario.Papel, &usuario.Senha, &usuario.DataCriacao, &usuario.EstaDeletado); err != nil {
		if errors.Is(err, sql.ErrNoRows) {
			return nil, nil
		}
		return nil, err

	}

	return &usuario, nil
}

func (repository *repository) buscarUsuarios(ctx context.Context) ([]usuario, error) {
	query := "SELECT id,nome,email,papel,senha,data_criacao,esta_deletado FROM usuarios  WHERE esta_deletado = false"
	var usuarios = []usuario{}
	rows, err := repository.db.QueryContext(ctx, query)
	if err != nil {
		return usuarios, err
	}

	for rows.Next() {
		u := usuario{}
		if err := rows.Scan(&u.ID, &u.Nome, &u.Email, &u.Papel, &u.Senha, &u.DataCriacao, &u.EstaDeletado); err != nil {
			return usuarios, err
		}

		usuarios = append(usuarios, u)
	}

	return usuarios, err
}

func (repository *repository) buscarUsuariosTodos(ctx context.Context) ([]usuario, error) {
	query := "SELECT id,nome,email,papel,senha,data_criacao,esta_deletado FROM usuarios"
	var usuarios = []usuario{}
	rows, err := repository.db.QueryContext(ctx, query)
	if err != nil {
		return usuarios, err
	}

	for rows.Next() {
		u := usuario{}
		if err := rows.Scan(&u.ID, &u.Nome, &u.Email, &u.Papel, &u.Senha, &u.DataCriacao, &u.EstaDeletado); err != nil {
			return usuarios, err
		}

		usuarios = append(usuarios, u)
	}

	return usuarios, err
}
