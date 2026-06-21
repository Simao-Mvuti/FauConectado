package handler_test

import (
	"bytes"
	"net/http"
	"net/http/httptest"
	"projeto/internal/domain"
	"projeto/internal/handler"
	"projeto/internal/routes"
	"testing"

	"github.com/gin-gonic/gin"
	"github.com/go-playground/assert/v2"
)

// 1. Criamos um Mock do seu Serviço de Autenticação
type AuthServiceMock struct {
	// Defina aqui variáveis para controlar o retorno do mock, ex:
	RetornoErro error
}

// Simulando o método Login que o seu handler provavelmente chama
func (m *AuthServiceMock) Login(input *domain.UserLogin) (string, error) {
	return "token_falso_jwt", m.RetornoErro
}

// Simulando o método Register
func (m *AuthServiceMock) CreateUser(input *domain.UserCreate) error {
	return m.RetornoErro
}

func TestCreateUserSucess(t *testing.T) {
	gin.SetMode(gin.TestMode)
	mockService := &AuthServiceMock{}
	mockHandler := handler.Handler{mockService}

	e := gin.Default()
	routes.SetupRouteAuth(e, &mockHandler)
	w := httptest.NewRecorder()

	body := bytes.NewBufferString(`{"name":"samuel","email":"sammvuti@gmail.com","password":"123456776"}`)
	req, _ := http.NewRequest("POST", "/api/v1/auth/register", body)
	req.Header.Set("Content-Type", "application/json")

	e.ServeHTTP(w, req)
	assert.Equal(t, http.StatusCreated, w.Code)
}

func TestCreateUserFail(t *testing.T) {
	gin.SetMode(gin.TestMode)
	mockService := &AuthServiceMock{}
	mockHandler := handler.Handler{mockService}

	e := gin.Default()
	routes.SetupRouteAuth(e, &mockHandler)
	w := httptest.NewRecorder()

	body := bytes.NewBufferString(`{"nome":"sl","email":"sammvuticom","password":"127"}`)
	req, _ := http.NewRequest("POST", "/api/v1/auth/register", body)
	req.Header.Set("Content-Type", "application/json")

	e.ServeHTTP(w, req)
	assert.Equal(t, http.StatusBadRequest, w.Code)
}

func TestRotaLoginSucess(t *testing.T) {
	gin.SetMode(gin.TestMode)

	// 2. Instancia o mock do serviço (sem banco de dados!)
	mockService := &AuthServiceMock{}

	// 3. Cria o Handler injetando o Mock
	mockHandler := handler.Handler{Service: mockService}

	// 4. Cria o roteador isolado usando o Mock
	e := gin.Default()
	routes.SetupRouteAuth(e, &mockHandler)
	w := httptest.NewRecorder()

	// 5. Prepara a requisição simulada
	body := bytes.NewBufferString(`{"email":"teste@email.com", "password":"123345555"}`)
	req, _ := http.NewRequest("POST", "/api/v1/auth/login", body)
	req.Header.Set("Content-Type", "application/json")

	// 6. Executa
	e.ServeHTTP(w, req)

	// 7. Valida o resultado esperado do Handler
	assert.Equal(t, http.StatusOK, w.Code)
}

func TestRotaLoginFail(t *testing.T) {
	gin.SetMode(gin.TestMode)

	// 2. Instancia o mock do serviço (sem banco de dados!)
	mockService := &AuthServiceMock{}

	// 3. Cria o Handler injetando o Mock
	mockHandler := handler.Handler{Service: mockService}

	// 4. Cria o roteador isolado usando o Mock
	e := gin.Default()
	routes.SetupRouteAuth(e, &mockHandler)
	w := httptest.NewRecorder()

	// 5. Prepara a requisição simulada
	body := bytes.NewBufferString(`{"email":"testcom", "password":"123"}`)
	req, _ := http.NewRequest("POST", "/api/v1/auth/login", body)
	req.Header.Set("Content-Type", "application/json")

	// 6. Executa
	e.ServeHTTP(w, req)

	// 7. Valida o resultado esperado do Handler
	assert.Equal(t, http.StatusBadRequest, w.Code)
}
