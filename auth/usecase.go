package auth

import (
	"bytes"
	"crypto/rand"
	"encoding/hex"
	"encoding/json"
	"fmt"
	"net/http"
	"time"

	"github.com/golang-jwt/jwt/v5"
)

func enviarEmailResend(email string, token string) {
	url := "https://api.resend.com/emails"
	apiKey := "re_your_api_key" // Sua chave secreta do provedor

	link := "https://meusite.com/reset?token=" + token
	htmlContent := "<p>Você solicitou a alteração de senha.</p><p>Clique no link para redefinir: <a href='" + link + "'>" + link + "</a></p>"

	payload := map[string]interface{}{
		"from":    "Suporte <suporte@meusite.com>", // Seu domínio verificado
		"to":      []string{email},
		"subject": "Recuperação de Senha",
		"html":    htmlContent,
	}

	jsonPayload, _ := json.Marshal(payload)
	req, _ := http.NewRequest("POST", url, bytes.NewBuffer(jsonPayload))
	req.Header.Set("Authorization", "Bearer "+apiKey)
	req.Header.Set("Content-Type", "application/json")

	client := &http.Client{Timeout: 10 * time.Second}
	resp, err := client.Do(req)
	if err == nil {
		defer resp.Body.Close()
	}
}

func GerarTokenRecuperacao(userID string) (*PasswordResetToken, error) {
	bytes := make([]byte, 32)
	if _, err := rand.Read(bytes); err != nil {
		return nil, err
	}

	tokenHex := hex.EncodeToString(bytes)
	expiracao := time.Now().Add(15 * time.Minute)

	return &PasswordResetToken{
		UserID:    userID,
		Token:     tokenHex,
		ExpiresAt: expiracao,
	}, nil
}

func GerarTokenJWT(id, email, papel string, jwtSecret string, duracao time.Duration) (string, error) {
	claims := ClamsCustom{
		Id:    id,
		Email: email,
		Papel: papel,
		RegisteredClaims: jwt.RegisteredClaims{
			ExpiresAt: jwt.NewNumericDate(time.Now().Add(duracao)),
			IssuedAt:  jwt.NewNumericDate(time.Now()),
		},
	}

	token := jwt.NewWithClaims(jwt.SigningMethodHS256, claims)

	tokenString, err := token.SignedString([]byte(jwtSecret))
	if err != nil {
		return "", err
	}

	return tokenString, nil
}

func ValidarTokenJWT(tokenStr string) (*jwt.Token, error) {
	token, err := jwt.Parse(tokenStr, func(token *jwt.Token) (interface{}, error) {
		if _, ok := token.Method.(*jwt.SigningMethodHMAC); !ok {
			return nil, fmt.Errorf("método de assinatura inesperado")
		}
		// Convertido para []byte antes de devolver:
		return []byte("segredo_super_secreto"), nil
	})

	return token, err
}
