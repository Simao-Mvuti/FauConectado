package routas

import "github.com/gin-gonic/gin"

func AlunoRotas(api *gin.Engine) {
	api.GET("/aluno", func(ctx *gin.Context) {
		ctx.JSON(200, "Testando")
	})
}
