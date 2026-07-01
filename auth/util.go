package auth

import (
	"encoding/json"
	"errors"
	"fmt"
	"net/http"
	"strings"
	"time"

	"github.com/go-playground/form/v4"
	"github.com/go-playground/validator/v10"
	"golang.org/x/crypto/bcrypt"
)

var (
	TIMEOUT_DB            = 5 * time.Minute
	EMAIL_EXISTENTE       = errors.New("email já existe")
	CREDENCIAIS_INVALIDOS = errors.New("credencias inválidos")
	ERRO_INTERNO          = errors.New("Erro interno do sistema")
)

func (handler *Handler) BindValidate(v any, w http.ResponseWriter, r *http.Request) error {
	contentType := r.Header.Get("Content-Type")

	if !strings.Contains(contentType, "application/json") &&
		!strings.Contains(contentType, "application/x-www-form-urlencoded") {
		return fmt.Errorf("Content-Type não suportado")
	}

	// 1. Processa o Bind dependendo do tipo de mídia
	if strings.Contains(contentType, "application/json") {
		if err := json.NewDecoder(r.Body).Decode(v); err != nil {
			return fmt.Errorf("JSON inválido")
		}
	} else if strings.Contains(contentType, "application/x-www-form-urlencoded") {
		if err := r.ParseForm(); err != nil {
			return fmt.Errorf("Erro ao processar formulário")
		}

		var decoder = form.NewDecoder()
		if err := decoder.Decode(v, r.Form); err != nil {
			return fmt.Errorf("Erro ao mapear formulário para a estrutura")
		}
	}

	if err := handler.Validate.Struct(v); err != nil {
		return err
	}

	return nil
}

func FormatarErros(err error) map[string]string {
	erros := make(map[string]string)

	if errs, ok := err.(validator.ValidationErrors); ok {
		for _, e := range errs {
			erros[e.Field()] = fmt.Sprintf("Falhou na validação: %s", e.Tag())
		}
	}

	return erros
}

func CriptografarSenha(senha string) (string, error) {
	hash, err := bcrypt.GenerateFromPassword([]byte(senha), bcrypt.DefaultCost)
	return string(hash), err
}

func CompararSenha(senha string, hash string) bool {
	err := bcrypt.CompareHashAndPassword([]byte(hash), []byte(senha))
	return err == nil
}
