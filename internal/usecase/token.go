package usecase

import (
	"projeto/internal/configuretion"
	"projeto/internal/domain"
	"time"

	"github.com/golang-jwt/jwt/v5"
)

func GerarToken(userID uint, email string) (string, error) {
	claims := domain.CustomClaims{
		UserID: userID,
		Email:  email,
		RegisteredClaims: jwt.RegisteredClaims{
			ExpiresAt: jwt.NewNumericDate(time.Now().Add(2 * time.Hour)),
			IssuedAt:  jwt.NewNumericDate(time.Now()),
		},
	}

	token := jwt.NewWithClaims(jwt.SigningMethodHS256, claims)
	return token.SignedString([]byte(configuretion.JWT_KEY))
}

// ValidarToken checa se o token está expirado ou é inválido
func ValidarToken(tokenString string) (*domain.CustomClaims, error) {
	token, err := jwt.ParseWithClaims(tokenString, &domain.CustomClaims{}, func(token *jwt.Token) (interface{}, error) {
		return configuretion.JWT_KEY, nil
	})

	if err != nil {
		return nil, err
	}

	claims, ok := token.Claims.(*domain.CustomClaims)
	if !ok || !token.Valid {
		return nil, domain.InvalidedToken
	}

	return claims, nil
}
