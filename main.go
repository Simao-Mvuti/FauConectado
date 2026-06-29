package main

import (
	"database/sql"
	"log"
	"net/http"
	"projeto/auth"

	_ "github.com/lib/pq"
)

func main() {
	db, err := sql.Open("postgres", "postgres://meu_usuario_seguro:uma_senha_muito_forte_123@localhost:5432/meu_banco_de_producao?sslmode=disable")
	if err != nil {
		log.Fatal(err)
	}

	defer db.Close()
	log.Println("Conectado")
	authHandler, err := auth.NewHandler(db)

	if err != nil {
		log.Fatal(err)
	}

	mux := http.NewServeMux()
	authHandler.IniciarRotas(mux)
	log.Println("Servidor rodando na porta :8080...")
	log.Fatal(http.ListenAndServe(":8080", mux))
}
