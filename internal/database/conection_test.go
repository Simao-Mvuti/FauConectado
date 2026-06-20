package database_test

import (
	"projeto/internal/configuretion"
	"projeto/internal/database"
	"testing"

	"github.com/joho/godotenv"
)

func TestConection_error(t *testing.T) {
	if err := godotenv.Load("../../.env"); err != nil {
		t.Fatalf("Erro ao carregar .env: %v", err)
	}

	dsn, err := configuretion.DatabaseConf()
	if err != nil {
		t.Fatalf("Erro ao buscar DSN válido: %v", err)
	}

	casos := []struct {
		Nome       string
		DSN        string
		DeveFalhar bool
	}{
		{"DSN válido ", dsn, false},
		{"DSN inválido", "siiffofofkffyhfu", true},
	}

	for _, tc := range casos {
		t.Run(tc.Nome, func(t *testing.T) {
			// Agora recebemos o db E o err da sua função alterada
			db, err := database.Conection(tc.DSN)

			if tc.DeveFalhar {
				// Se esperávamos que falhasse, ou o err precisa existir ou o db precisa ser nil
				if err == nil && db != nil {
					t.Errorf("Esperávamos uma falha para o DSN inválido, mas a função não retornou erro.")
					if db != nil {
						db.Close()
					}
				}
				return // Cenário de erro testado com sucesso, finaliza este subteste!
			}

			// --- Cenário de Sucesso (Deve Funcionar) ---
			if err != nil {
				t.Fatalf("Não esperava erro aqui, mas obtive: %v", err)
			}
			if db == nil {
				t.Fatalf("Esperávamos um objeto sql.DB, mas retornou nil")
			}

			defer db.Close()

			err = db.Ping()
			if err != nil {
				t.Errorf("O banco de dados falhou ao responder o Ping: %v", err)
			}
		})
	}
}
