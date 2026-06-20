package configuretion_test

import (
	"projeto/internal/configuretion"
	"testing"

	"github.com/joho/godotenv"
)

func TestConfigution(t *testing.T) {
	casos := []struct {
		Name       string
		Path       string
		DeveFalhar bool // Nova flag para dizer o que esperamos desse caso
	}{
		// Ajustei os caminhos assumindo que o teste roda em internal/configuretion
		{"Env Correto na Raiz", "../../.env", false},
		{"Env Inexistente", ".enve", true}, // Aqui NÓS ESPERAMOS um erro!
	}

	for _, ct := range casos {
		t.Run(ct.Name, func(t *testing.T) {
			err := godotenv.Load(ct.Path)

			// Tratamento da lógica de erro:
			if ct.DeveFalhar {
				// Se deve falhar e NÃO deu erro, temos um problema!
				if err == nil {
					t.Fatal("Esperava um erro ao carregar um arquivo inexistente, mas não deu erro.")
				}
				// Se deu erro, está correto! Podemos parar o subteste aqui com return
				return
			}

			// Se NÃO deve falhar, mas deu erro:
			if err != nil {
				t.Fatalf("Erro inesperado ao carregar as variaveis: %v", err)
			}

			// Só testamos a DatabaseConf se o env foi carregado com sucesso
			_, err = configuretion.DatabaseConf()
			if err != nil {
				t.Errorf("Erro ao ler as configurações do banco: %v", err)
			}
		})
	}
}
