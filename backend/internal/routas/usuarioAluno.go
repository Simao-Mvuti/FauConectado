package routas

import (
	"faculdadeConectado/internal/handler"
	"faculdadeConectado/internal/repository"
	"faculdadeConectado/internal/service"

	"github.com/gin-gonic/gin"
	"github.com/jmoiron/sqlx"
)

func UsuarioRotas(api *gin.Engine, db *sqlx.DB) {
	repository := repository.NewUsuarioRepository(db)
	service := service.NewService(repository)
	handler := handler.UsuarioHandler{Service: service}
	routas := api.Group("/usuario")
	{
		routas.POST("/", handler.CadastrarAluno)
	}

}
