package database

import (
	"os"
	"time"

	_ "github.com/golang-migrate/migrate/v4/source/file"
	_ "github.com/jackc/pgx/v5/stdlib"
	"github.com/jmoiron/sqlx"
	_ "github.com/lib/pq"
)

func Conection(dsn string) (*sqlx.DB, error) {
	db, err := sqlx.Connect("pgx", dsn)
	if err != nil {
		return db, err
	}

	if err := db.Ping(); err != nil {
		return db, err
	}

	db.SetMaxOpenConns(25)                 // Máximo de conexões abertas ao mesmo tempo
	db.SetMaxIdleConns(25)                 // Quantas conexões ficam abertas esperando em cache
	db.SetConnMaxLifetime(5 * time.Minute) // Tempo de vida de cada conexão

	return db, nil
}

func AplicarMigracoes(db *sqlx.DB, ArquivoSchame string) error {
	file, err := os.ReadFile(ArquivoSchame)
	db.MustExec(string(file))
	return err
}
