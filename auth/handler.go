package auth

import (
	"database/sql"
	"encoding/json"
	"errors"
	"log"
	"net/http"

	"github.com/go-playground/validator/v10"
)

type Handler struct {
	Service  Service
	Validate *validator.Validate
}

func NewHandler(db *sql.DB, jwtCodigo string, validate *validator.Validate) (*Handler, error) {
	repository := newRepository(db)
	service := newService(repository, jwtCodigo)
	handler := &Handler{
		Service:  service,
		Validate: validate,
	}
	err := service.CriarTabelaUsuario()
	return handler, err
}
func (handler *Handler) RecuperarSenha(w http.ResponseWriter, r *http.Request) {
	input := RecuperarPassword{}
	if err := handler.BindValidate(&input, w, r); err != nil {
		resposta := FormatarErros(err)
		w.WriteHeader(http.StatusBadRequest)
		if err := json.NewEncoder(w).Encode(resposta); err != nil {
			log.Println(err)
			http.Error(w, ERRO_INTERNO.Error(), http.StatusInternalServerError)
			return
		}
	}

	handler.Service.recuperarSenha(input)
}

func (Handler *Handler) Me(w http.ResponseWriter, r *http.Request) {
	userID := r.Context().Value(UserIDKey).(string)
	usuario, err := Handler.Service.buscarUsuarioPorID(userID)
	if err != nil {
		http.Error(w, ERRO_INTERNO.Error(), http.StatusInternalServerError)
		return
	}

	w.WriteHeader(http.StatusInternalServerError)
	if err := json.NewEncoder(w).Encode(usuario); err != nil {
		http.Error(w, ERRO_INTERNO.Error(), http.StatusInternalServerError)
		return
	}
}

func (handler *Handler) Registro(w http.ResponseWriter, r *http.Request) {
	usuarioInput := usuarioCadastro{}
	if err := handler.BindValidate(&usuarioInput, w, r); err != nil {
		resposta := FormatarErros(err)
		w.WriteHeader(http.StatusBadRequest)
		if err := json.NewEncoder(w).Encode(resposta); err != nil {
			log.Println(err)
			http.Error(w, ERRO_INTERNO.Error(), http.StatusInternalServerError)
			return
		}
	}

	if err := handler.Service.salvarUsuario(&usuarioInput); err != nil {
		if errors.Is(err, EMAIL_EXISTENTE) {
			http.Error(w, err.Error(), http.StatusConflict)
			return
		}

		log.Println(err)
		http.Error(w, ERRO_INTERNO.Error(), http.StatusInternalServerError)
		return
	}

	w.WriteHeader(http.StatusCreated)
	_, err := w.Write([]byte("Usuário Criado com Sucesso"))
	if err != nil {
		log.Println(err)
		http.Error(w, ERRO_INTERNO.Error(), http.StatusInternalServerError)
		return
	}
}

func (handler *Handler) Login(w http.ResponseWriter, r *http.Request) {
	usuario := usuarioLogin{}
	if err := handler.BindValidate(&usuario, w, r); err != nil {
		resposta := FormatarErros(err)
		w.WriteHeader(http.StatusBadRequest)
		if err := json.NewEncoder(w).Encode(resposta); err != nil {
			log.Println(err)
			http.Error(w, ERRO_INTERNO.Error(), http.StatusInternalServerError)
			return
		}
		return
	}

	token, refreshtoken, err := handler.Service.login(usuario)
	if err != nil {
		if errors.Is(err, CREDENCIAIS_INVALIDOS) {
			http.Error(w, err.Error(), http.StatusBadRequest)
			return
		}

		http.Error(w, ERRO_INTERNO.Error(), http.StatusInternalServerError)
		return
	}

	resposta := map[string]string{"mensagem": "Sucesso", "Token": token, "Refresh Token": refreshtoken}

	w.WriteHeader(200)
	if err := json.NewEncoder(w).Encode(resposta); err != nil {
		log.Println(err)
		http.Error(w, ERRO_INTERNO.Error(), http.StatusInternalServerError)
		return
	}
}

func (Handler *Handler) Logout(w http.ResponseWriter, r *http.Request) {
	userID := r.Context().Value(UserIDKey).(string)
	if err := Handler.Service.logout(userID); err != nil {
		http.Error(w, ERRO_INTERNO.Error(), http.StatusInternalServerError)
		return
	}

	w.WriteHeader(http.StatusOK)
}

func (handler *Handler) IniciarRotas(mux *http.ServeMux) {
	mockHandler := http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
		w.Write([]byte("Rota temporária (Mock)"))
	})
	// Fluxo básico de Entrada/Saída
	mux.HandleFunc("POST /auth/register", handler.Registro)
	mux.HandleFunc("POST /auth/login", handler.Login)
	mux.Handle("POST /auth/logout", Middleware(http.HandlerFunc(handler.Logout)))

	// Verificação de Conta
	mux.HandleFunc("POST /auth/verify-email", mockHandler)
	mux.HandleFunc("POST /auth/resend-verification", mockHandler)

	// Recuperação de Senha
	mux.HandleFunc("POST /auth/forgot-password", handler.RecuperarSenha)
	mux.HandleFunc("POST /auth/reset-password", mockHandler)

	// Gerenciamento do Perfil do Usuário Logado
	mux.HandleFunc("GET /auth/me", handler.Me)           // Faltou o GET para puxar os dados atuais!
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
	login(usuario usuarioLogin) (string, string, error)
	logout(id string) error
	recuperarSenha(email RecuperarPassword) error
}
