package auth

import (
	"encoding/json"
	"errors"
	"fmt"
	"net/http"
	"strings"
	"time"

	"golang.org/x/crypto/bcrypt"
)

var (
	TIMEOUT_DB      = 5 * time.Minute
	EMAIL_EXISTENTE = errors.New("email já existe")
)

// Bind agora aceita "any" (qualquer ponteiro de struct)
func Bind(v any, w http.ResponseWriter, r *http.Request) error {
	contentType := r.Header.Get("Content-Type")

	// 1. Verifica se o Content-Type é suportado
	if !strings.Contains(contentType, "application/json") &&
		!strings.Contains(contentType, "application/x-www-form-urlencoded") {
		return fmt.Errorf("Content-Type não suportado")
	}

	// 2. Se for JSON, decodifica direto na struct mapeando as tags `json:"..."`
	if strings.Contains(contentType, "application/json") {
		if err := json.NewDecoder(r.Body).Decode(v); err != nil {
			return fmt.Errorf("JSON inválido")
		}
		return nil
	}

	// 3. Se for Form URL Encoded
	if strings.Contains(contentType, "application/x-www-form-urlencoded") {
		if err := r.ParseForm(); err != nil {
			return fmt.Errorf("Erro ao processar formulário")
		}

		switch target := v.(type) {
		case *usuarioCadastro:
			target.Nome = r.FormValue("nome")
			target.Email = r.FormValue("email")
			target.Senha = r.FormValue("senha")
		case *usuarioLogin:
			target.Email = r.FormValue("email")
			target.Senha = r.FormValue("senha")
		default:
			return fmt.Errorf("tipo de struct não suportado para Form Data")
		}
		return nil
	}

	return nil
}

func CriptografarSenha(senha string) (string, error) {
	hash, err := bcrypt.GenerateFromPassword([]byte(senha), bcrypt.DefaultCost)
	return string(hash), err
}

func CompararSenha(senha string, hash string) bool {
	err := bcrypt.CompareHashAndPassword([]byte(hash), []byte(senha))
	return err == nil
}
