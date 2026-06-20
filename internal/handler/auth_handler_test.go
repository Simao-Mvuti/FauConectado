package handler_test

import (
	"bytes"
	"encoding/json"
	"net/http"
	"net/http/httptest"
	"projeto/internal/domain"
	"projeto/internal/handler"
	"testing"

	"github.com/gin-gonic/gin"
	"github.com/go-playground/assert/v2"
)

func setupRouterGet(routa string, hander func(c *gin.Context)) *gin.Engine {
	gin.SetMode(gin.TestMode)
	r := gin.New()
	r.GET(routa, hander)
	return r
}

func TestPingHandler(t *testing.T) {
	routa := "/ping"
	router := setupRouterGet(routa, func(c *gin.Context) {
		c.String(200, "Pong")
	})

	req, _ := http.NewRequest(http.MethodGet, routa, nil)
	w := httptest.NewRecorder()

	router.ServeHTTP(w, req)

	assert.Equal(t, http.StatusOK, w.Code)
}

type ServiceFack struct {
}

func (s *ServiceFack) Login(input *domain.UserLogin) (string, error) {
	return "", nil
}
func (s *ServiceFack) CreateUser(input *domain.UserCreate) error {
	return nil
}

func TestRegisterHandler(t *testing.T) {
	// Configuração
	gin.SetMode(gin.TestMode)

	// Setup do router
	router := gin.Default()
	serviceFack := ServiceFack{}
	handler := handler.Handler{&serviceFack} // Você provavelmente vai injetar um service/mock aqui
	router.POST("/auth/register", handler.Register)

	// Dados de teste
	testUser := gin.H{
		"nome":     "Lucas",
		"email":    "lucas@email.com",
		"password": "12344578",
	}

	body, _ := json.Marshal(testUser)

	// Criar requisição
	req, _ := http.NewRequest("POST", "/auth/register", bytes.NewBuffer(body))
	req.Header.Set("Content-Type", "application/json")

	// Executar
	w := httptest.NewRecorder()
	router.ServeHTTP(w, req)

	// Verificações

	assert.Equal(t, http.StatusCreated, w.Code)
}
