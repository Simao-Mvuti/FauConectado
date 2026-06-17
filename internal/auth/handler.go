package auth

import (
	"net/http"

	"github.com/gin-gonic/gin"
)

type Handler struct {
	Service *Service
}

func (h *Handler) Login(c *gin.Context) {
	loginUser := new(LoginUser)

	if err := c.Bind(loginUser); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"status":      "error",
			"description": err.Error(),
			"hellp":       "/help",
		})

		return
	}

	if err := h.Service.login(loginUser); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"status":      "error",
			"description": err.Error(),
			"hellp":       "/help",
		})

		return
	}

	c.JSON(http.StatusCreated, gin.H{
		"status":      "sucess",
		"description": "login",
	})

}

func (h *Handler) Register(c *gin.Context) {
	createUser := new(CreateUser)

	if err := c.Bind(createUser); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"status":      "error",
			"description": err.Error(),
			"hellp":       "/help",
		})
		return
	}

	if err := h.Service.createUser(createUser); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"status":      "error",
			"description": err.Error(),
			"hellp":       "/help",
		})

		return
	}

	c.JSON(http.StatusCreated, gin.H{
		"status":      "sucess",
		"description": "user x created witch id x",
	})
}
