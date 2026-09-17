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
	auth.InitDB(dsn)
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
