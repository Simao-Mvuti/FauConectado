package middleware

import (
	"net/http"
	"projeto/internal/domain"
	"projeto/internal/util"
	"strings"

	"github.com/gin-gonic/gin"
	"github.com/golang-jwt/jwt/v5"
)

func AuthMiddleware(jwtSecret string) gin.HandlerFunc {
	return func(c *gin.Context) {
		// 1. Pega o cabeçalho Authorization
		authHeader := c.GetHeader(util.AUTHORIZATION)
		if authHeader == "" {
			c.JSON(http.StatusUnauthorized, gin.H{"error": "cabeçalho de autorização ausente"})
			c.Abort() // Para a execução aqui mesmo
			return
		}

		// 2. Verifica se o formato é "Bearer <TOKEN>"
		parts := strings.Split(authHeader, " ")
		if len(parts) != 2 || parts[0] != util.BEARER {
			c.JSON(http.StatusUnauthorized, gin.H{"error": "formato do token inválido"})
			c.Abort()
			return
		}

		tokenString := parts[1]
		claims := domain.CustomClaims{}
		// 3. Faz o Parse e Valida o Token usando a sua chave secreta ([]byte!)
		token, err := jwt.ParseWithClaims(tokenString, &claims, func(token *jwt.Token) (interface{}, error) {
			// Garante que o método de assinatura é HMAC
			if _, ok := token.Method.(*jwt.SigningMethodHMAC); !ok {
				return nil, jwt.ErrSignatureInvalid
			}
			return []byte(jwtSecret), nil
		})

		if err != nil || !token.Valid {
			c.JSON(http.StatusUnauthorized, gin.H{"error": "token inválido ou expirado"})
			c.Abort()
			return
		}

		c.Set(util.ID_USER, claims.UserID)

		// Continua para o próximo Handler/Rota
		c.Next()
	}
}
