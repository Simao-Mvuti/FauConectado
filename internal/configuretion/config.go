package configuretion

import (
	"os"
	"projeto/internal/domain"
)

var JWT_KEY = ""

func DatabaseConf() (string, error) {
	dsn := os.Getenv("DATABASE_URL")
	if dsn == "" {
		return dsn, domain.ErorConfigureVariabel
	}

	return dsn, nil
}

func JWTKeyConf() error {
	jwt_key := os.Getenv("JWT_KEY")
	if jwt_key == "" {
		return domain.ErorConfigureVariabel
	}

	JWT_KEY = jwt_key
	return nil
}
