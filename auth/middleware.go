package auth

import (
	"context"
	"net/http"
	"strings"
)

type contextKey string

const UserIDKey contextKey = "user_id"

func Middleware(next http.Handler) http.Handler {
	return http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
		authorization := r.Header.Get("Authorization")

		if authorization == "" || !strings.HasPrefix(authorization, "Bearer ") {
			w.Header().Set("Content-Type", "application/json")
			w.WriteHeader(http.StatusUnauthorized)
			w.Write([]byte(`{"erro": "Token ausente ou malformatado"}`))
			return
		}

		input := strings.TrimSpace(strings.TrimPrefix(authorization, "Bearer "))

		token, err := ValidarTokenJWT(input)
		if err != nil {
			w.Header().Set("Content-Type", "application/json")
			w.WriteHeader(http.StatusUnauthorized)
			w.Write([]byte(`{"erro": "Não autorizado"}`))
			return
		}

		claims := token.Claims.(*ClamsCustom)

		userID := claims.Id
		ctx := context.WithValue(r.Context(), UserIDKey, userID)

		next.ServeHTTP(w, r.WithContext(ctx))
	})
}
