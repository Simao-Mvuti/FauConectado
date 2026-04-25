package config

import (
	"errors"
	"os"

	"github.com/joho/godotenv"
)

type CONFIG struct {
	PORTA_API string
	PORTA     string
	HOST      string
	USUARIO   string
	SENHA     string
	NOME      string
}

func LeituraEnv(pasta string) (CONFIG, error) {
	if err := godotenv.Load(pasta); err != nil {
		return CONFIG{}, errors.New("Erro ao carregar o arquivo de configuração")
	}

	porta_api := os.Getenv("PORTA_API")
	porta := os.Getenv("DB_PORTA")
	host := os.Getenv("DB_HOST")
	usuario := os.Getenv("DB_USUARIO")
	senha := os.Getenv("DB_SENHA")
	nome := os.Getenv("DB_NOME")

	if porta_api == "" ||
		porta == "" ||
		host == "" ||
		usuario == "" ||
		senha == "" ||
		nome == "" {
		return CONFIG{}, errors.New("Váriavel da porta da api ,está vázio")
	}

	config := CONFIG{
		PORTA_API: porta_api,
		PORTA:     porta,
		NOME:      nome,
		SENHA:     senha,
		USUARIO:   usuario,
		HOST:      host}

	return config, nil
}
