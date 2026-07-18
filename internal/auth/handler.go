package auth

import (
	"fmt"
	"net/http"
	"strconv"
	"text/template"
	"uinotify/internal/model"
)

type AuthHandler struct {
	Service    *authService
	Myvalidate *Validater
	Templates  *template.Template
}

func (handler *AuthHandler) CriarUsuario(w http.ResponseWriter, r *http.Request) {
	if err := r.ParseForm(); err != nil {
		handler.renderFormErro(w, model.FormAssinatura{
			Erro: "Erro no formulário. Tenta novamente.",
		})
		return
	}

	form := model.FormAssinatura{
		Nome:  r.FormValue("nome"),
		Email: r.FormValue("email"),
		Curso: r.FormValue("curso"),
		Ano:   r.FormValue("ano"),
	}

	ano, err := strconv.Atoi(form.Ano)
	if err != nil {
		form.Erro = "Ano inválido."
		handler.renderFormErro(w, form)
		return
	}

	usuario := UsuarioCriacao{
		Ano:   uint(ano),
		Nome:  form.Nome,
		Email: form.Email,
		Curso: form.Curso,
	}

	if err := handler.Myvalidate.Validate.Struct(usuario); err != nil {
		form.Erro = "Verifica os dados preenchidos e tenta novamente."
		handler.renderFormErro(w, form)
		return
	}

	if err := handler.Service.criarConta(&usuario); err != nil {
		form.Erro = "Erro Interno"
		handler.renderFormErro(w, form)
		return
	}

	fmt.Fprint(w, `<p class="font-serif italic text-base text-gold">Assinatura confirmada. Bem-vindo ao Correio.</p>`)
}

func (handler *AuthHandler) renderFormErro(w http.ResponseWriter, form model.FormAssinatura) {
	w.WriteHeader(http.StatusOK)
	if err := handler.Templates.ExecuteTemplate(w, "form-assinatura", form); err != nil {
		http.Error(w, "Erro interno", http.StatusInternalServerError)
	}
}
