package handler

import (
	"net/http"
	"text/template"
	"uinotify/internal/model"
	"uinotify/internal/service"
)

type TelasHandler struct {
	Service *service.InformacoesService
}

func (handler TelasHandler) DashboardAdm(w http.ResponseWriter, r *http.Request) {

}

func (handler *TelasHandler) Home(w http.ResponseWriter, r *http.Request) {
	noticias, err := handler.Service.BuscarNoticias()
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
	}

	tmpl := template.Must(template.ParseFiles("templentes/home.html"))
	inscricoes := ""
	desporto := ""
	biblioteca := ""
	mentoria := ""

	if len(noticias) > 4 {
		inscricoes = noticias[0].Descricao
		desporto = noticias[1].Descricao
		biblioteca = noticias[2].Descricao
		mentoria = noticias[3].Descricao
	}

	page := model.HomePage{

		DataAtual: "Sábado, 18 Julho 2026",
		Local:     "Luanda, Angola",

		Inscricoes: inscricoes,
		Desporto:   desporto,
		Biblioteca: biblioteca,
		Mentoria:   mentoria,

		Destaques: noticias,
	}

	err = tmpl.Execute(w, page)

	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
	}

}
