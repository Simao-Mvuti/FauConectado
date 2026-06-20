package routes

import (
	"log"
	"projeto/internal/configuretion"
	"projeto/internal/handler"
	middleware "projeto/internal/handler/middleware"

	"github.com/gin-gonic/gin"
	"github.com/ulule/limiter/v3"
	mgin "github.com/ulule/limiter/v3/drivers/middleware/gin"
	"github.com/ulule/limiter/v3/drivers/store/memory"
)

func SetupRoute(userHandler *handler.Handler) *gin.Engine {
	e := gin.Default()
	rate, err := limiter.NewRateFromFormatted("5-S")
	if err != nil {
		log.Fatal(err)
	}
	// 2. Cria o armazenamento em memória (para testes locais)
	store := memory.NewStore()
	// 3. Instancia o middleware pronto para o Gin
	routerLimitemiddleware := mgin.NewMiddleware(limiter.New(store, rate))
	e.Use(routerLimitemiddleware)
	authRoutes := e.Group("/api/v1/auth")
	{
		authRoutes.POST("/login", userHandler.Login)
		authRoutes.POST("/register", userHandler.Register)
	}

	protected := e.Group("/api/v1")
	protected.Use(middleware.AuthMiddleware(configuretion.JWT_KEY))
	{

	}

	return e
}
