package configuretion

import (
	"fmt"
	"os"
)

func DatabaseConf() (string, error) {
	dsn := os.Getenv("DATABASE_URL")
	if dsn == "" {
		return dsn, fmt.Errorf("Variáveris de ambiente vázios")
	}

	return dsn, nil
}
