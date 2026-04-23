package main

import (
	"faculdadeConectado/internal/config"
	"faculdadeConectado/internal/routas"
	"log"

	"github.com/gin-gonic/gin"
)

func main() {
	config, err := config.LeituraEnv(".env")
	if err != nil {
		log.Fatal(err)
	}
	api := gin.Default()
	routas.AlunoRotas(api)
	api.Run(":" + config.PORTA_API)
}
