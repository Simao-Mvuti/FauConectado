package handler

import (
	model "faculdadeConectado/internal/entidades"
	"faculdadeConectado/internal/service"

	"github.com/gin-gonic/gin"
)

type UsuarioHandler struct {
	Service *service.UsuarioService
}

func (a UsuarioHandler) CadastrarAluno(c *gin.Context) {
	var input model.UsuarioCadastro
	if err := c.ShouldBindJSON(&input); err != nil {
		c.JSON(400, gin.H{"Mensagem": err.Error()})
		return
	}

	if err := a.Service.CadastrarUsuario(input); err != nil {
		c.JSON(500, gin.H{"Mensagem": "Erro ao salvar o usuário"})
		return
	}

	c.JSON(201, gin.H{"Mensagem": "Sucesso"})
}

func (a UsuarioHandler) LoginAluno(c *gin.Context) {
	var input model.UsuarioLogin
	if err := c.ShouldBindJSON(&input); err != nil {
		c.JSON(400, gin.H{"Mensagem": "Campos inválidos", "Detalhes": err.Error()})
		return
	}

	err := a.Service.Login(input)
	if err != nil {
		c.JSON(401, gin.H{"Mensagem": "Credenciais inválidos"})
		return
	}

	c.JSON(200, gin.H{"Mensagem": "Sucesso"})
}
