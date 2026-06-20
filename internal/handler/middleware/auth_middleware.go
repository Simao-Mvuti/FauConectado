package middleware

import (
	"net/http"
	"strings"

	"github.com/gin-gonic/gin"
	"github.com/golang-jwt/jwt/v5"
)

func AuthMiddleware(jwtSecret string) gin.HandlerFunc {
	return func(c *gin.Context) {
		// 1. Pega o cabeçalho Authorization
		authHeader := c.GetHeader("Authorization")
		if authHeader == "" {
			c.JSON(http.StatusUnauthorized, gin.H{"error": "cabeçalho de autorização ausente"})
			c.Abort() // Para a execução aqui mesmo
			return
		}

		// 2. Verifica se o formato é "Bearer <TOKEN>"
		parts := strings.Split(authHeader, " ")
		if len(parts) != 2 || parts[0] != "Bearer" {
			c.JSON(http.StatusUnauthorized, gin.H{"error": "formato do token inválido"})
			c.Abort()
			return
		}

		tokenString := parts[1]

		// 3. Faz o Parse e Valida o Token usando a sua chave secreta ([]byte!)
		token, err := jwt.Parse(tokenString, func(token *jwt.Token) (interface{}, error) {
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

		// 4. Se o token for válido, extrai os claims (ex: user_id)
		if claims, ok := token.Claims.(jwt.MapClaims); ok {
			// Salva o ID do usuário no contexto do Gin para os próximos Handlers usarem
			c.Set("userID", claims["sub"])
		}

		// Continua para o próximo Handler/Rota
		c.Next()
	}
}
