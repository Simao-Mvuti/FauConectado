package main

import (
	"fmt"
	"projeto/internal/auth"
	"projeto/internal/configuretion"
	"projeto/internal/database"

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

	db := database.Conection(dsn)
	defer db.Close()
	userRepository := auth.Repository{DB: db}
	userService := auth.Service{Repository: &userRepository}
	userHandler := auth.Handler{Service: &userService}

	api := e.Group("/api/v1/")
	authRoutes := api.Group("/auth")
	authRoutes.POST("/login", userHandler.Login)
	authRoutes.POST("/register", userHandler.Register)

	fmt.Println("Servidor Rodando...")
	e.Run()
}
