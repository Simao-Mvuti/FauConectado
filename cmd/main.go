package main

import (
	"fmt"
	"log"
	"projeto/internal/configuretion"
	"projeto/internal/database"
	"projeto/internal/handler"
	"projeto/internal/repository"
	"projeto/internal/service"

	"github.com/gin-gonic/gin"
	"github.com/joho/godotenv"
)

func main() {
	e := gin.Default()
	if err := godotenv.Load(".env"); err != nil {
		panic(err)
	}

	dsn, err := configuretion.DatabaseConf()
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

	api := e.Group("/api/v1/")
	authRoutes := api.Group("/auth")
	authRoutes.POST("/login", userHandler.Login)
	authRoutes.POST("/register", userHandler.Register)

	fmt.Println("Servidor Rodando...")
	e.Run()
}
