package routes

import (
	"log"
	"net/http"
	"projeto/internal/configuretion"
	"projeto/internal/handler"
	middleware "projeto/internal/handler/middleware"

	"github.com/gin-gonic/gin"
	"github.com/ulule/limiter/v3"
	mgin "github.com/ulule/limiter/v3/drivers/middleware/gin"
	"github.com/ulule/limiter/v3/drivers/store/memory"
)

func SetupRouteLimite(e *gin.Engine) {
	rate, err := limiter.NewRateFromFormatted("5-S")
	if err != nil {
		log.Fatal(err)
	}
	// 2. Cria o armazenamento em memória (para testes locais)
	store := memory.NewStore()
	// 3. Instancia o middleware pronto para o Gin
	routerLimitemiddleware := mgin.NewMiddleware(limiter.New(store, rate))
	e.Use(routerLimitemiddleware)
}

func SetupRouteAuth(e *gin.Engine, userHandler *handler.Handler) {
	authRoutes := e.Group("/api/v1/auth")
	{
		authRoutes.POST("/login", userHandler.Login)
		authRoutes.POST("/register", userHandler.Register)
	}

	protected := e.Group("/api/v1")
	protected.Use(middleware.AuthMiddleware(configuretion.JWT_KEY))
	{
		protected.GET("/profile", func(ctx *gin.Context) {
			user, existe := ctx.Get("userID")
			if !existe {
				ctx.JSON(http.StatusForbidden, "sem autorizacao")
				return
			}

			ctx.JSON(200, gin.H{
				"user":    user,
				"message": "login successful",
				"next":    "/",
			})
		})

	}
}

func SetupRouteADM(e *gin.Engine, admHandler *handler.ADMHandler) {
	e.Use(middleware.AuthMiddleware(configuretion.JWT_KEY))
	e.Use(middleware.ADMMiddleware())
	admRoutes := e.Group("/api/v1/adm")
	{
		admRoutes.GET("/users", admHandler.FindUsers)
	}
}
