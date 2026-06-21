package handler

import (
	"log"
	"net/http"
	"projeto/internal/domain"
	"projeto/internal/usecase"
	"strconv"

	"github.com/gin-gonic/gin"
)

type MaterialHandler struct {
	Service usecase.MaterilService
}

func (h *MaterialHandler) CreateMaterial(c *gin.Context) {
	var material domain.MaterialCreated
	if err := c.ShouldBindJSON(&material); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"errror": "bad request", "ditle": err.Error()})
		return
	}

	if err := h.Service.Create(&material); err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "error internal"})
		log.Println(err.Error())
		return
	}

	c.JSON(http.StatusCreated, gin.H{"mensage": "material created"})
}

func (h *MaterialHandler) FindMaterial(c *gin.Context) {
	var inicio uint
	var fim uint

	inicioInput := c.Query("inicio")
	fimInput := c.Query("fim")

	if inicioInput != "" {
		i, err := strconv.Atoi(inicioInput)
		if err != nil {
			c.JSON(http.StatusBadRequest, gin.H{"errror": "bad request"})
		}

		inicio = uint(i)
	}

	if fimInput != "" {
		i, err := strconv.Atoi(fimInput)
		if err != nil {
			c.JSON(http.StatusBadRequest, gin.H{"errror": "bad request"})
		}

		fim = uint(i)
	}

	materials, err := h.Service.FindMaterials(inicio, fim)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "error internal"})
		log.Println(err.Error())
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"materials": materials,
	})
}
