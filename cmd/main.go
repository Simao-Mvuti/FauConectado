package main

import (
	"log"
	"projeto/internal/configuretion"
	"projeto/internal/database"
	"projeto/internal/handler"
	"projeto/internal/repository"
	"projeto/internal/routes"
	"projeto/internal/service"

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
	userService := service.NewAuthService(&userRepository)
	userHandler := handler.Handler{Service: &userService}
	e := routes.SetupRoute(&userHandler)
	e.Run()
}
