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

	if err := database.AplicarMigracoes(db, "./db/schema.sql"); err != nil {
		log.Println(err.Error())
	}

	materialRepository := repository.NewMaterialRepository(db)
	userRepository := repository.NewAuthRepository(db)
	admRepository := repository.NewADMpository(db)

	materialService := service.NewMaterialService(&materialRepository)
	userService := service.NewAuthService(&userRepository)
	admService := service.NewADMService(&admRepository)

	materialHandler := handler.MaterialHandler{Service: &materialService}
	admHandler := handler.ADMHandler{Service: &admService}
	userHandler := handler.Handler{Service: &userService}

	gin.SetMode(gin.TestMode)
	e := gin.Default()
	//routes.SetupRouteLimite(e)
	routes.SetupRouteAuth(e, &userHandler)
	routes.SetupRouteProteted(e, &admHandler, &materialHandler)

	e.Run()
}
