package handler

import (
	"log"
	"net/http"
	"projeto/internal/usecase"
	"strconv"

	"github.com/gin-gonic/gin"
)

type ADMHandler struct {
	Service usecase.ADMService
}

func (h *ADMHandler) DeleteUser(c gin.Context) {
	idInput := c.Param("id")
	if idInput == "" {
		c.JSON(http.StatusBadRequest, gin.H{"errror": "bad request"})
		return
	}

	id, err := strconv.Atoi(idInput)
	if err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"errror": "bad request"})
		return
	}

	err = h.Service.DeleteUser(uint(id))
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"errror": "internal error"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"message": "user deleted",
	})
}
func (h *ADMHandler) FindUsers(c *gin.Context) {
	inicioInput := c.Query("inicio")
	fimInput := c.Query("fim")

	var inicio uint
	var fim uint = 10

	if inicioInput != "" {
		num, err := strconv.Atoi(inicioInput)
		if err != nil {
			c.JSON(http.StatusBadRequest, gin.H{"errror": "bad request"})
		}

		inicio = uint(num)
	}

	if fimInput != "" {
		num, err := strconv.Atoi(inicioInput)
		if err != nil {
			c.JSON(http.StatusBadRequest, gin.H{"errror": "bad request"})
		}

		fim = uint(num)
	}

	users, err := h.Service.ListUser(inicio, fim)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{
			"error": "internal server error",
		})
		log.Println(err)
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"users":   users,
		"message": "successful",
		"total":   len(users),
	})
}
