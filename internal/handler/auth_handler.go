package handler

import (
	"errors"
	"log"
	"net/http"
	"projeto/internal/domain"
	"projeto/internal/usecase"

	"github.com/gin-gonic/gin"
)

type Handler struct {
	Service usecase.AuthService
}

// Register godoc
// @Summary Realiza o cadastro do usuário
// @Description Cadastra o usuário
// @Tags Auth
// @Accept json
// @Produce json
// @Success 200
// @Failure 400
// @Router /auth/register [post]
func (h *Handler) Register(c *gin.Context) {
	createUser := new(domain.UserCreate)

	if err := c.ShouldBindJSON(createUser); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"error": "invalid request body",
		})
		return
	}

	err := h.Service.CreateUser(createUser)
	if err != nil {

		if errors.Is(err, domain.ErrEmailAlreadyExists) {
			c.JSON(http.StatusBadRequest, gin.H{
				"error": "email already exists",
			})
			return
		}

		c.JSON(http.StatusInternalServerError, gin.H{
			"error": "internal server error",
		})
		log.Println(err)
		return
	}

	c.JSON(http.StatusCreated, gin.H{
		"next": "/login",
	})
}

// Login godoc
// @Summary Realiza o login do usuário
// @Description Autentica o usuário com e-mail e senha e devolve um token JWT
// @Tags Auth
// @Accept json
// @Produce json
// @Param input body domain.UserLogin true "Credenciais de Acesso"
// @Success 200 {object} map[string]string "token: jwt_token"
// @Failure 400 {object} map[string]string "erro: dados inválidos"
// @Router /auth/login [post]
func (h *Handler) Login(c *gin.Context) {
	loginUser := new(domain.UserLogin)

	if err := c.ShouldBindJSON(loginUser); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"error": "invalid request body",
		})
		return
	}

	token, err := h.Service.Login(loginUser)
	if err != nil {

		if errors.Is(err, domain.ErrUserNotFound) {
			c.JSON(http.StatusUnauthorized, gin.H{
				"error": "invalid credentials",
			})
			return
		}

		c.JSON(http.StatusInternalServerError, gin.H{
			"error": "internal server error",
		})
		log.Println(err)
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"token":   token,
		"message": "login successful",
		"next":    "/",
	})
}
