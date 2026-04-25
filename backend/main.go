package main

import (
	"faculdadeConectado/internal/config"
	"faculdadeConectado/internal/database"
	"faculdadeConectado/internal/routas"
	"log"

	"github.com/gin-gonic/gin"
)

func main() {
	config, err := config.LeituraEnv(".env")
	if err != nil {
		log.Fatal(err)
	}

	db, err := database.Conectar(&config)
	if err != nil {
		log.Fatal(err)
	}

	api := gin.Default()
	routas.UsuarioRotas(api, db)
	api.Run(":" + config.PORTA_API)
}
