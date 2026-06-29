package auth

import (
	"database/sql"
	"errors"
	"log"
	"net/http"
)

type Handler struct {
	Service Service
}

func NewHandler(db *sql.DB) (*Handler, error) {
	repository := newRepository(db)
	service := newService(repository)
	handler := Handler{
		Service: service,
	}
	err := service.CriarTabelaUsuario()
	return &handler, err
}

func (handler *Handler) Registro(w http.ResponseWriter, r *http.Request) {
	usuarioInput := usuarioCadastro{}
	if err := Bind(&usuarioInput, w, r); err != nil {
		http.Error(w, err.Error(), 400)
		return
	}

	if err := handler.Service.salvarUsuario(&usuarioInput); err != nil {
		if errors.Is(err, EMAIL_EXISTENTE) {
			http.Error(w, err.Error(), http.StatusConflict)
			return
		}

		log.Println(err)
		http.Error(w, "Erro interno", http.StatusInternalServerError)
		return
	}

	w.WriteHeader(http.StatusCreated)
	_, err := w.Write([]byte("Usuário Criado com Sucesso"))
	if err != nil {
		log.Println(err)
		http.Error(w, "Erro interno", http.StatusInternalServerError)
		return
	}
}

func (handler *Handler) Login(w http.ResponseWriter, r *http.Request) {
	usuario := usuarioLogin{}
	if err := Bind(&usuario, w, r); err != nil {
		http.Error(w, err.Error(), http.StatusBadRequest)
		return
	}
}

func (handler *Handler) IniciarRotas(mux *http.ServeMux) {
	mockHandler := func(w http.ResponseWriter, r *http.Request) {
		w.Write([]byte("Rota temporária (Mock)"))
	}

	// Fluxo básico de Entrada/Saída
	mux.HandleFunc("POST /auth/register", handler.Registro)
	mux.HandleFunc("POST /auth/login", handler.Login)
	mux.HandleFunc("POST /auth/logout", mockHandler)

	// Verificação de Conta
	mux.HandleFunc("POST /auth/verify-email", mockHandler)
	mux.HandleFunc("POST /auth/resend-verification", mockHandler)

	// Recuperação de Senha
	mux.HandleFunc("POST /auth/forgot-password", mockHandler)
	mux.HandleFunc("POST /auth/reset-password", mockHandler)

	// Gerenciamento do Perfil do Usuário Logado
	mux.HandleFunc("GET /auth/me", mockHandler)          // Faltou o GET para puxar os dados atuais!
	mux.HandleFunc("PUT /auth/me", mockHandler)          // Atualizar dados (nome, etc)
	mux.HandleFunc("PUT /auth/me/password", mockHandler) // Atualizar apenas a senha (estando logado)
	mux.HandleFunc("DELETE /auth/me", mockHandler)       // Deletar a própria conta

	// Tokens e Sessões
	mux.HandleFunc("POST /auth/refresh", mockHandler)
}

type Service interface {
	numerosUsuarios() (uint, error)
	salvarUsuario(usuario *usuarioCadastro) error
	deletarUsuario(id string) error
	atualizarUsuarioNome(id string, nome string) error
	atualizarUsuarioSenha(id string, senha string) error
	buscarUsuarioPorEmail(email string) (*usuario, error)
	buscarUsuarioPorID(id string) (*usuario, error)
	buscarUsuarios() ([]usuario, error)
	CriarTabelaUsuario() error
}
