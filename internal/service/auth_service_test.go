package service_test

import (
	"projeto/internal/domain"
	"projeto/internal/repository"
	"projeto/internal/service"
	"testing"

	"github.com/stretchr/testify/assert"
	"gorm.io/driver/sqlite"
	"gorm.io/gorm"
)

// Função auxiliar para criar um banco limpo antes de cada teste
func SetupTestDB(t *testing.T) *gorm.DB {
	// 1. Conecta em um banco SQLite temporário que roda na memória RAM
	db, err := gorm.Open(sqlite.Open(":memory:"), &gorm.Config{})
	if err != nil {
		t.Fatalf("Erro ao abrir banco de teste: %v", err)
	}

	// 2. Roda as migrações para criar as tabelas idênticas ao seu banco real
	// Substitua pelo modelo real do seu usuário
	err = db.AutoMigrate(&domain.User{})
	if err != nil {
		t.Fatalf("Erro ao rodar migrações de teste: %v", err)
	}

	return db
}

func TestAuthService_Register_BancoReal(t *testing.T) {
	// 1. Prepara o banco de dados limpo na memória
	db_gorm := SetupTestDB(t)
	db, err := db_gorm.DB()
	if err != nil {
		t.Fatalf("Erro ao abrir banco de teste: %v", err)
	}

	// 2. Instancia as engrenagens REAIS (sem Mocks aqui!)
	repo := repository.NewAuthRepository(db)
	service := service.NewAuthService(&repo)

	// 3. Define os dados de teste
	novoUsuario := domain.UserCreate{
		Name:     "Lucas Silva",
		Email:    "lucas@test.com",
		Password: "senha123secreta",
	}

	// 4. Executa a lógica da Service de verdade
	err = service.CreateUser(&novoUsuario)

	// --- VALIDAÇÕES NO BANCO REAL ---

	// Validação A: A service não pode retornar erro ao salvar
	assert.NoError(t, err)

	// Validação B: Vamos direto no banco ver se o usuário realmente foi salvo!
	var usuarioSalvo domain.User
	resultado := db_gorm.First(&usuarioSalvo, "email = ?", "lucas@test.com")

	assert.NoError(t, resultado.Error) // Garante que achou o registro no banco
	assert.Equal(t, "Lucas Silva", usuarioSalvo.Name)

	// Se a sua Service criptografa a senha antes de salvar, você pode validar aqui:
	assert.NotEqual(t, "senha123secreta", usuarioSalvo.Password) // Garante que a senha foi hasheada no banco!
}

func TestAuthService_Register_EmailDuplicado(t *testing.T) {
	db_gorm := SetupTestDB(t)
	db, err := db_gorm.DB()
	if err != nil {
		t.Fatalf("Erro ao abrir banco de teste: %v", err)
	}

	repo := repository.NewAuthRepository(db)
	service := service.NewAuthService(&repo)

	usuario := domain.UserCreate{
		Name:     "Ana",
		Email:    "ana@test.com",
		Password: "senha_da_ana",
	}

	// Salva a primeira vez (Deve dar certo)
	err = service.CreateUser(&usuario)
	assert.NoError(t, err)

	// Tenta salvar exatamente o mesmo usuário de novo (Deve dar ERRO do banco)
	errDuplicado := service.CreateUser(&usuario)

	// O teste passa se a service entender o erro do banco e retornar uma falha
	assert.Error(t, errDuplicado)
}
