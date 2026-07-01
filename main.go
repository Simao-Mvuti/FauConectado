package main

import (
	"database/sql"
	"log"
	"net/http"
	"os"
	"projeto/auth"
	"time"

	"github.com/go-playground/validator/v10"
	"github.com/joho/godotenv"
	_ "github.com/lib/pq"
)

func main() {
	if err := godotenv.Load(".env"); err != nil {
		panic(err)
	}

	dsn := os.Getenv("DATABASE_URL")
	jwtkey := os.Getenv("JWT_KEY")

	db, err := sql.Open("postgres", dsn)
	if err != nil {
		log.Fatal(err)
	}

	defer db.Close()

	db.SetMaxOpenConns(100)
	db.SetMaxIdleConns(10)
	db.SetConnMaxLifetime(time.Hour)
	validate := validator.New()
	authHandler, err := auth.NewHandler(db, jwtkey, validate)

	if err != nil {
		log.Fatal(err.Error())
	}

	mux := http.NewServeMux()
	authHandler.IniciarRotas(mux)
	log.Println("Servidor rodando na porta :8080...")
	log.Fatal(http.ListenAndServe(":8080", mux))
}
