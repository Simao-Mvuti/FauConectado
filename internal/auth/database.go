package auth

import (
	"context"
	"database/sql"
	"log"
	"os"

	"github.com/golang-migrate/migrate/v4"
	"github.com/golang-migrate/migrate/v4/database/postgres" // Verificou se tem o /v4/
	_ "github.com/golang-migrate/migrate/v4/source/file"     // Verificou se tem o /v4/
	"github.com/jackc/pgx/v5"
	_ "github.com/jackc/pgx/v5/stdlib"
)

func NovoBanco(dsn string) *pgx.Conn {
	conn, err := pgx.Connect(context.Background(), os.Getenv("DSN"))
	if err != nil {
		log.Fatal(err)
	}

	return conn
}

func InitDB(connString string) {
	database, err := sql.Open("pgx", connString)
	if err != nil {
		log.Fatalf("❌ Erro ao abrir conexão com Postgres: %v", err)
	}

	// Criar o driver de migração específico para Postgres
	driver, err := postgres.WithInstance(database, &postgres.Config{})
	if err != nil {
		log.Fatalf("❌ Erro ao criar driver de migração Postgres: %v", err)
	}

	// Instanciar o golang-migrate apontando para a pasta local
	m, err := migrate.NewWithDatabaseInstance(
		"file://db/migrations",
		"postgres", // Nome do driver que o golang-migrate usa internamente
		driver,
	)
	if err != nil {
		log.Fatalf("❌ Erro ao instanciar golang-migrate: %v", err)
	}

	// Executa as migrações pendentes
	if err := m.Up(); err != nil && err != migrate.ErrNoChange {
		log.Fatalf("❌ Erro ao aplicar migrações: %v", err)
	}
}
