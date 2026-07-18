package auth

import (
	"context"
	"log"
	"os"

	"github.com/jackc/pgx/v5"
)

func NovoBanco(dsn string) *pgx.Conn {
	conn, err := pgx.Connect(context.Background(), os.Getenv("DSN"))
	if err != nil {
		log.Fatal(err)
	}

	return conn
}
