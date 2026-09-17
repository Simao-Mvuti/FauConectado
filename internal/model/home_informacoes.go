package model

type FormAssinatura struct {
	Erro  string
	Nome  string
	Email string
	Curso string
	Ano   string
}

type HomePage struct {
	DataAtual string
	Local     string

	Inscricoes string
	Desporto   string
	Biblioteca string
	Mentoria   string

	Destaques []Noticia
	Form      FormAssinatura
}

type Noticia struct {
	Categoria string
	Titulo    string
	Descricao string
}
