package main

import (
	"log"
	"projeto/internal/configuretion"
	"projeto/internal/database"
	"projeto/internal/handler"
	"projeto/internal/repository"
	"projeto/internal/routes"
	"projeto/internal/service"

	"github.com/gin-gonic/gin"
	"github.com/joho/godotenv"
)

// @title API de Autenticação
// @version 1.0
// @description Servidor de testes de rotas e estresse.
// @host localhost:8080
// @BasePath /api/v1
func main() {
	if err := godotenv.Load(".env"); err != nil {
		panic(err)
	}

	dsn, err := configuretion.DatabaseConf()
	if err != nil {
		panic(err)
	}

	err = configuretion.JWTKeyConf()
	if err != nil {
		panic(err)
	}

	db, err := database.Conection(dsn)
	if err != nil {
		panic(err)
	}

	defer db.Close()

	if err := database.AplicarMigracoes(db); err != nil {
		log.Println(err.Error())
	}

	userRepository := repository.NewAuthRepository(db)
	admRepository := repository.NewADMpository(db)
	userService := service.NewAuthService(&userRepository)
	admService := service.NewADMService(&admRepository)
	userHandler := handler.Handler{Service: &userService}
	admHandler := handler.ADMHandler{Service: &admService}

	e := gin.Default()
	routes.SetupRouteLimite(e)
	routes.SetupRouteAuth(e, &userHandler)
	routes.SetupRouteADM(e, &admHandler)

	e.Run()
}
