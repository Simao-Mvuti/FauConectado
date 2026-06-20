package routes

import (
	"projeto/internal/handler"

	"github.com/gin-gonic/gin"
)

func SetupRoute(userHandler *handler.Handler) *gin.Engine {
	e := gin.Default()
	authRoutes := e.Group("/api/v1/auth")
	authRoutes.POST("/login", userHandler.Login)
	authRoutes.POST("/register", userHandler.Register)
	return e
}
