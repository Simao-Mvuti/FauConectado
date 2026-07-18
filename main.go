package main

import (
	"context"
	"log"
	"net/http"
	"os"
	"text/template"
	"uinotify/internal/auth"
	"uinotify/internal/handler"
	"uinotify/internal/repository"
	"uinotify/internal/service"

	"github.com/go-playground/validator/v10"
	"github.com/joho/godotenv"
)

func main() {
	if err := godotenv.Load(".env"); err != nil {
		log.Fatal(err)
	}

	dsn := os.Getenv("DSN")
	db := auth.NovoBanco(dsn)
	defer db.Close(context.Background())
	tmpl := template.Must(template.ParseGlob("templentes/*.html"))

	mux := http.NewServeMux()
	validate := validator.New()
	myvalidate := auth.Validater{Validate: validate}

	authrepository := auth.NovoAuthRepository(db)
	authservice := auth.NovoAuthService(authrepository)
	authHandler := auth.AuthHandler{Service: authservice, Myvalidate: &myvalidate, Templates: tmpl}

	inforepository := repository.InformacoesRepository{DB: db}
	infservice := service.InformacoesService{Repo: &inforepository}
	viewHandler := handler.TelasHandler{Service: &infservice}

	mux.HandleFunc("GET /home", viewHandler.Home)
	mux.HandleFunc("GET /dashboard", viewHandler.DashboardAdm)
	mux.HandleFunc("POST /usuarios", authHandler.CriarUsuario)
	http.ListenAndServe(":8080", mux)
}

/*
3. Criar avisos

Admin publica:

título
mensagem
público alvo
4. Notificação

Enviar:

email
histórico no sistema
5. Dashboard

Mostrar:

Estudantes cadastrados: 500

Avisos enviados: 35

Emails enviados hoje: 1200
Tecnologias

Eu manteria:

Backend
Go
net/http
html/template
Banco
PostgreSQL
Cache
Redis
Frontend

Nada pesado:

HTML
Tailwind CSS
HTMX
Infraestrutura
Docker Compose
Nginx

Linux
Uma coisa que deixaria o projeto mais impressionante

Adicionar preferências inteligentes.

Exemplo:

Um estudante de Informática de Gestão recebe:

Banco de Dados
Programação
Redes
Estágios

Mas um estudante de Contabilidade recebe:

Contabilidade
Auditoria
Finanças

*/
