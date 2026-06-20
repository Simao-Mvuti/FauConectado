package database

import (
	"database/sql"
	"fmt"
	"time"

	"github.com/golang-migrate/migrate/v4"
	"github.com/golang-migrate/migrate/v4/database/postgres"
	_ "github.com/golang-migrate/migrate/v4/source/file"
	_ "github.com/lib/pq"
)

func Conection(dsn string) (*sql.DB, error) {
	db, err := sql.Open("postgres", dsn)
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

func AplicarMigracoes(db *sql.DB) error {
	driver, err := postgres.WithInstance(db, &postgres.Config{})
	if err != nil {
		return fmt.Errorf("Erro ao criar driver de migração: %v", err)
	}

	m, err := migrate.NewWithDatabaseInstance(
		"file://db/migrations",
		"postgres", driver,
	)
	if err != nil {
		return fmt.Errorf("Erro ao inicializar migração: %v", err)
	}

	// 4. Executa as migrações (A mágica acontece aqui!)
	err = m.Up()
	if err != nil && err != migrate.ErrNoChange {
		return fmt.Errorf("Erro ao rodar migrações: %v", err)
	}

	if err == migrate.ErrNoChange {
		return fmt.Errorf("O banco já está atualizado! Nenhuma migração pendente.")
	} else {
		return fmt.Errorf("Migrações aplicadas com sucesso! Tabela criada.")
	}
}
