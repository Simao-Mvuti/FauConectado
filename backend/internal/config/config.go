package config

import (
	"errors"
	"os"

	"github.com/joho/godotenv"
)

type CONFIG struct {
	PORTA_API string
}

func LeituraEnv(pasta string) (CONFIG, error) {
	if err := godotenv.Load(pasta); err != nil {
		return CONFIG{}, errors.New("Erro ao carregar o arquivo de configuração")
	}

	porta_api := os.Getenv("PORTA_API")

	if porta_api == "" {
		return CONFIG{}, errors.New("Váriavel da porta da api ,está vázio")
	}

	return CONFIG{PORTA_API: porta_api}, nil
}
