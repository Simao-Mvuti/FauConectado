## 2. Endpoints esperados

### Leitura pública

- `GET /api/cadeiras/`
  - filtros: `ano`, `semestre`, `search`
- `GET /api/materiais/`
  - filtros: `cadeira`, `tipo`, `search`, `ordenar=avaliacao`
- `GET /api/materiais/<id>/`
- `GET /api/mentores/`
  - filtros: `area`, `ordenar=avaliacao`
- `GET /api/mentores/<id>/`
- `GET /api/eventos/`
  - filtros: `tipo`, `data_de`, `data_ate`
- `GET /api/eventos/<id>/`

### Submissões públicas

Estas rotas recebem dados de visitantes e criam registos com estado `pendente`:

- `POST /api/materiais/submeter/`
  - `cadeira_id`, `titulo`, `descricao`, `tipo`, `ficheiro`, `autor_nome`, `autor_email`
- `POST /api/mentores/candidatar/`
  - `nome`, `email`, `curso`, `ano`, `area`, `descricao`, `requisitos`, `dias_disponiveis`, `contacto_publico`
- `POST /api/eventos/submeter/`
  - `titulo`, `tipo`, `descricao`, `data`, `hora`, `local`, `link_externo`, `organizador_nome`, `organizador_email`
- `POST /api/avaliacoes/`
  - `alvo_tipo`, `alvo_id`, `nota`, `comentario`, `autor_nome`, `autor_email`

## 3. Área administrativa

O painel de administração deve permitir:

- listar submissões pendentes;
- pré-visualizar ficheiros antes da aprovação;
- aprovar ou rejeitar materiais, mentores e eventos;
- informar o motivo da rejeição;
- editar e remover conteúdo publicado;
- moderar avaliações;
- destacar ou ocultar materiais/eventos;
- consultar filtros por estado, data e categoria.

## 4. Regras de ficheiros

- aceitar apenas extensões necessárias, por exemplo `pdf`, `doc`, `docx`, `ppt`, `pptx` e `zip`;
- definir tamanho máximo por ficheiro;
- guardar os ficheiros fora da pasta pública quando possível;
- gerar nome interno único;
- validar o tipo MIME real;
- impedir execução de ficheiros enviados;
- disponibilizar download apenas para materiais aprovados.

## 5. Resposta esperada das APIs

As respostas devem devolver os campos já prontos para os cartões, por exemplo:

```json
{
  "id": 12,
  "nome": "Programação Web e Multimédia",
  "ano": 4,
  "semestre": 1,
  "avaliacao_media": 4.9,
  "total_avaliacoes": 42,
  "total_materiais": 8
}
```

Para listas, usar paginação:

```json
{
  "count": 51,
  "next": null,
  "previous": null,
  "results": []
}
```

## 6. Integração com os templates

Substituir os dados mockados nos componentes:

- `core/templates/core/components/materias-catalogo.html`
- `core/templates/core/components/mentores-catalogo.html`
- `core/templates/core/components/eventos-catalogo.html`
- `core/templates/core/components/contribuir.html`

Também será necessário ligar as páginas às views e URLs:

- `core/pages/materias.html`
- `core/pages/mentores.html`
- `core/pages/eventos.html`
- `core/pages/cadeiras.html`

Os formulários usam atualmente `action="#"` apenas como placeholder.

## 7. Variáveis de contexto dos templates

As views podem enviar os seguintes nomes diretamente para os templates:

### Home

- `materia_destaque`: material aprovado em destaque;
- `total_materiais`: total de materiais aprovados;
- `total_mentores`: total de mentores aprovados;
- `cadeiras_destaque`: lista de cadeiras com `id`, `nome`, `ano` e `total_materiais`;
- `cadeiras`: lista completa de cadeiras para o formulário de submissão.

### Página de matérias

- `materiais`: queryset/lista de materiais aprovados;
- `anos_disponiveis`: lista de anos disponíveis para o filtro.

Cada material deve expor `titulo`, `descricao`, `tipo`, `extensao`, `avaliacao_media`, `ficheiro` e `cadeira.nome`/`cadeira.ano`.

### Página de mentores

- `mentores`: queryset/lista de mentores aprovados;
- `areas_mentor`: lista de pares `(valor, etiqueta)` para o filtro.

Cada mentor deve expor `nome`, `curso`, `ano`, `area`, `dias_disponiveis`, `requisitos`, `contacto_publico`, `email`, `avaliacao_media` e `total_avaliacoes`.

### Página de eventos

- `eventos`: queryset/lista de eventos aprovados;
- `tipos_evento`: lista de pares `(valor, etiqueta)` para o filtro.

Cada evento deve expor `titulo`, `tipo`, `descricao`, `data`, `hora`, `local` e `link_externo`.

### Página de cadeiras

- `cadeiras`: queryset/lista de todas as cadeiras;
- `anos_disponiveis`: lista com os anos existentes.

Os filtros das páginas de matérias, mentores, eventos e cadeiras são enviados por query string (`q`, `ano`, `semestre`, `area`, `tipo`, `data_de` e `ordenar`).
