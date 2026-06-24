package handler

import (
	"log"
	"net/http"
	"path/filepath"
	"projeto/internal/domain"
	"projeto/internal/usecase"
	"projeto/internal/util"

	"github.com/gin-gonic/gin"
	"github.com/google/uuid"
)

type MaterialHandler struct {
	Service usecase.MaterilService
}

func (h *MaterialHandler) CreateMaterial(c *gin.Context) {
	var material domain.MaterialCreated

	if err := c.ShouldBind(&material); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"error": err.Error(),
		})
		return
	}

	file, err := c.FormFile("file")
	if err != nil {
		c.JSON(http.StatusBadRequest, gin.H{
			"error": "arquivo obrigatório",
		})
		return
	}

	filename := uuid.New().String() +
		filepath.Ext(file.Filename)

	path := "./uploads/pdf/" + filename

	if err := c.SaveUploadedFile(file, path); err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{
			"error": "erro ao salvar arquivo",
		})
		return
	}

	userID := c.MustGet(util.ID_USER).(uint)

	err = h.Service.CreateMaterial(
		&material,
		userID,
		path,
	)

	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{
			"error": err.Error(),
		})
		return
	}

	c.JSON(http.StatusCreated, gin.H{
		"message": "material criado",
	})
}

func (h *MaterialHandler) FindMaterial(c *gin.Context) {
	inicioInput := c.Query("inicio")
	fimInput := c.Query("fim")

	inicio, err := util.StringToInt(inicioInput)
	if err != nil {
		inicio = 1
	}
	fim, err := util.StringToInt(fimInput)
	if err != nil {
		fim = 10
	}

	materials, err := h.Service.FindMaterials(uint(inicio), uint(fim))
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "error internal"})
		log.Println(err.Error())
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"tamanho_lista": len(materials),
		"materials":     materials,
	})
}
