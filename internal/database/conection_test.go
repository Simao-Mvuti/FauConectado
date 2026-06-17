package database

import (
	"projeto/internal/configuretion"
	"testing"

	"github.com/joho/godotenv"
)

func TestConection_error(t *testing.T) {
	if err := godotenv.Load("/../.env"); err != nil {
		t.Log("Aviso: Não foi possível carregar o .env, usando variáveis do sistema.")
	}

	dsn, err := configuretion.DatabaseConf()
	if err != nil {
		t.Fatal("Esperava receber um dsn ,mas obtive erro")
	}

	db := Conection(dsn)

	if db == nil {
		t.Fatal("Conexão retornou um objeto de banco de dados nulo (nil)")
	}

	defer db.Close()

	err = db.Ping()
	if err != nil {
		t.Fatalf("O banco conectou, mas falhou ao responder o Ping: %v", err)
	}

}

func TestConection_sucesss(t *testing.T) {
	if err := godotenv.Load(".env"); err != nil {
		t.Log("Aviso: Não foi possível carregar o .env, usando variáveis do sistema.")
	}

	dsn, err := configuretion.DatabaseConf()
	if err != nil {
		t.Fatal("Esperava receber um dsn ,mas obtive erro")
	}

	db := Conection(dsn)

	if db == nil {
		t.Fatal("Conexão retornou um objeto de banco de dados nulo (nil)")
	}

	defer db.Close()

	err = db.Ping()
	if err != nil {
		t.Fatalf("O banco conectou, mas falhou ao responder o Ping: %v", err)
	}

}
