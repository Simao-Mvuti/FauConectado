package database

import (
	"faculdadeConectado/internal/config"
	"fmt"
	"time"

	"github.com/jmoiron/sqlx"
	_ "github.com/lib/pq"
)

func Conectar(cfg *config.CONFIG) (*sqlx.DB, error) {
	dsn := fmt.Sprintf(
		"host=%s port=%s user=%s password=%s dbname=%s sslmode=disable",
		cfg.HOST, cfg.PORTA, cfg.USUARIO, cfg.SENHA, cfg.NOME,
	)

	db, err := sqlx.Open("postgres", dsn)
	db.SetMaxOpenConns(20)
	db.SetMaxIdleConns(10)
	db.SetConnMaxLifetime(5 * time.Minute)
	db.SetConnMaxIdleTime(2 * time.Minute)
	return db, err
}
