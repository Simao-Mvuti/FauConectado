package database

import (
	"database/sql"
	"fmt"
	"log"

	"github.com/golang-migrate/migrate/v4"
	"github.com/golang-migrate/migrate/v4/database/postgres"
	_ "github.com/golang-migrate/migrate/v4/source/file"
	_ "github.com/lib/pq"
)

func Conection(dsn string) *sql.DB {
	db, err := sql.Open("postgres", dsn)
	if err != nil {
		panic(err)
	}

	if err := db.Ping(); err != nil {
		panic(err)
	}

	driver, err := postgres.WithInstance(db, &postgres.Config{})
	if err != nil {
		log.Fatalf("Erro ao criar driver de migração: %v", err)
	}

	m, err := migrate.NewWithDatabaseInstance(
		"file://db/migrations",
		"postgres", driver,
	)
	if err != nil {
		log.Fatalf("Erro ao inicializar migração: %v", err)
	}

	// 4. Executa as migrações (A mágica acontece aqui!)
	err = m.Up()
	if err != nil && err != migrate.ErrNoChange {
		log.Fatalf("Erro ao rodar migrações: %v", err)
	}

	if err == migrate.ErrNoChange {
		fmt.Println("O banco já está atualizado! Nenhuma migração pendente.")
	} else {
		fmt.Println("Migrações aplicadas com sucesso! Tabela criada.")
	}

	return db
}
