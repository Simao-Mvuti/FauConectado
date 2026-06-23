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

func (h *Handler) Register(c *gin.Context) {
	createUser := new(domain.UserCreate)

	if err := c.ShouldBindJSON(createUser); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"error": err.Error(),
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

func (h *Handler) Login(c *gin.Context) {
	loginUser := new(domain.UserLogin)

	if err := c.ShouldBindJSON(loginUser); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"error": err.Error(),
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
		"next":    "/me",
	})
}
