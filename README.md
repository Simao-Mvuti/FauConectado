# 🎓 FauConectado

> **Uma plataforma acadêmica para descobrir conhecimento, materiais, oportunidades e pessoas que podem ajudar.**

O **FauConectado** não deve ser apenas um sistema de mentoria.

A ideia principal é criar um **ponto de encontro acadêmico da faculdade**: um lugar onde o estudante entra para estudar, descobrir algo novo, encontrar materiais, acompanhar oportunidades e, quando precisar, encontrar alguém que possa ajudá-lo.

---

# 🎯 Visão do projeto

O estudante deve pensar:

> **"Quando eu precisar aprender alguma coisa ou descobrir algo relacionado à faculdade, vou ao FauConectado."**

O sistema deve resolver principalmente quatro problemas:

1. 📚 **Não saber onde encontrar conhecimento**
2. 📄 **Dificuldade para encontrar materiais acadêmicos**
3. 👨‍🏫 **Dificuldade para encontrar pessoas que possam ajudar**
4. 📢 **Perder oportunidades e eventos importantes**

---

# ⭐ A principal aposta

## Conteúdo novo cria hábito.

Um sistema que só oferece mentoria será utilizado principalmente quando o estudante tiver um problema específico.

O FauConectado deve ser diferente.

O estudante deve ter um motivo para voltar frequentemente:

### Segunda-feira

```text
🔥 Novos conteúdos

"Como resolver sistemas lineares"

"Resumo — Gestão Financeira"

"Exercícios resolvidos de Programação"

"Novo material de Redes"

"Workshop de Excel sábado"
```

### Quarta-feira

O estudante entra novamente e pensa:

> "Ah, apareceu coisa nova."

Esse é o comportamento que queremos criar.

---

# 🏠 Página inicial

A página inicial deve funcionar como um **painel acadêmico**.

```text
FauConectado

🔎 Pesquisar...

📚 Conteúdos
📄 Materiais
👨‍🏫 Mentores
📅 Eventos

────────────────────────

🔥 Conteúdos recentes

[SQL]
5 JOINs que todo estudante deveria conhecer

por João
2 min de leitura


[Programação]
Arrays em PHP

por Maria
5 min de leitura


[Matemática]
Derivadas — resumo

por Carlos
3 min de leitura
```

Para um estudante autenticado:

```text
Bom dia, estudante 👋

📚 Continue estudando

Banco de Dados

████████░░ 80%


🔥 Recomendado para você

"Índices no MySQL"
5 min


📢 Próximos eventos

Workshop de Laravel
Sábado — 10:00


🆕 Novos materiais

+3 materiais publicados hoje
```

---

# 📚 1. Conteúdos

Esta é uma das partes mais importantes do FauConectado.

O sistema deve permitir encontrar conhecimento de forma simples.

### Exemplos

- Como estudar Cálculo I
- Introdução a Redes
- Como fazer um relatório científico
- 5 erros comuns em SQL
- Resumos de disciplinas
- Tutoriais
- Explicações de conceitos
- Exercícios resolvidos

### Quem pode criar conteúdo?

Dependendo das regras da faculdade:

- 👨‍🎓 Estudantes
- 👨‍🏫 Professores
- 👤 Administradores

Exemplo:

```text
📚 5 JOINs que todo estudante deveria conhecer

Categoria: Banco de Dados
Autor: João
Tempo de leitura: 2 minutos

[conteúdo]

👍 12
🔖 Guardar
```

---

# 📄 2. Materiais

Uma biblioteca acadêmica organizada.

### Pode conter:

- PDFs
- Sebentas
- Slides
- Exercícios
- Provas antigas
- Trabalhos de referência
- Guias de estudo
- Outros documentos acadêmicos

Exemplo:

```text
📄 Banco de Dados II — Sebenta

Disciplina: Banco de Dados
Ano: 3º
Tipo: Sebenta
Publicado por: Professor X

[Baixar]
```

---

# 👨‍🏫 3. Mentores

A mentoria continua existindo, mas deixa de ser o centro absoluto do sistema.

O objetivo é conectar estudantes que precisam de ajuda com pessoas que dominam determinado assunto.

Exemplo:

```text
Preciso de ajuda em Banco de Dados

[🔎 Procurar mentor]

────────────────

👨‍🏫 João Manuel

Banco de Dados
SQL
MySQL

⭐ 4.8

[Ver perfil]
```

### Fluxo principal

```text
Estudante
   ↓
Encontra conteúdo
   ↓
Ainda tem dificuldade
   ↓
Procura mentor
   ↓
Envia pedido
   ↓
Mentor aceita
   ↓
Mentoria
```

---

# 📢 4. Oportunidades

Uma área para coisas que o estudante não deveria perder.

### Exemplos

- Estágios
- Bolsas
- Eventos
- Workshops
- Palestras
- Competições
- Feiras
- Cursos
- Oportunidades acadêmicas

Exemplo:

```text
📢 Workshop de Excel

Data: Sábado
Hora: 10:00
Local: Faculdade

[Ver detalhes]
```

---

# 🔥 5. Novidades

Esta área é responsável por criar o motivo para voltar.

Mostrar:

- Conteúdos publicados recentemente
- Novos materiais
- Novos eventos
- Novas oportunidades
- Atualizações importantes

Exemplo:

```text
🔥 Novidades

+5 novos conteúdos
+3 novos materiais
+2 eventos
+1 oportunidade
```

---

# 🔎 6. Pesquisa

A pesquisa é uma funcionalidade **fundamental**.

O estudante deve conseguir procurar uma coisa e encontrar diferentes tipos de informação.

Exemplo:

```text
🔎 normalização banco de dados
```

Resultado:

```text
📚 CONTEÚDOS

Normalização: 1FN, 2FN e 3FN


📄 MATERIAIS

Exercícios de Normalização


👨‍🏫 MENTORES

3 mentores de Banco de Dados
```

A pesquisa transforma o FauConectado em uma espécie de:

> **"Google acadêmico interno da faculdade."**

---

# 🔄 O grande ciclo do FauConectado

O projeto deve funcionar como um ciclo:

```text
              📚 CONTEÚDO
                   ↓
              estudante lê
                   ↓
              tem dúvida
                   ↓
             👨‍🏫 procura ajuda
                   ↓
                MENTOR
                   ↓
                aprende
                   ↓
          compartilha conhecimento
                   ↓
              📚 CONTEÚDO
                   ↓
                  ...
```

Quanto mais pessoas utilizarem, maior deve ficar a base de conhecimento.

---

# 🧱 Estrutura principal do sistema

```text
FauConectado
│
├── 🏠 Dashboard
│
├── 📚 Conteúdos
│   ├── Listar
│   ├── Visualizar
│   ├── Criar
│   └── Editar
│
├── 📄 Materiais
│   ├── Listar
│   ├── Visualizar
│   ├── Download
│   └── Publicar
│
├── 👨‍🏫 Mentores
│   ├── Procurar
│   ├── Perfil
│   └── Pedir mentoria
│
├── 📢 Oportunidades
│   ├── Eventos
│   ├── Bolsas
│   ├── Estágios
│   └── Competições
│
├── 🔎 Pesquisa
│
├── 🔥 Novidades
│
└── 👤 Perfil
```

---

# 🛠️ Stack

### Backend

- PHP
- Laravel
- Eloquent ORM
- MySQL

### Frontend

- Blade
- Tailwind CSS
- JavaScript quando necessário

### Futuramente

- React, caso exista uma necessidade real para interfaces mais interativas.

**Não adicionar tecnologia apenas porque é moderna.**

A prioridade é entregar o sistema.

---

# 🧠 Ordem de desenvolvimento

Quando eu estiver perdido, **seguir esta ordem**.

## Fase 1 — Fundação ✅

- [x] Laravel
- [x] MySQL
- [x] Tailwind
- [x] Blade
- [x] Layout
- [x] Componentes
- [x] Cadastro
- [x] Login
- [x] Logout
- [x] Middleware de autenticação
- [x] Flash messages

---

# Fase 2 — Modelo de dados 🚧

Criar as entidades principais.

### User

```text
users
├── id
├── name
├── email
├── password
├── role
└── timestamps
```

### Content

```text
contents
├── id
├── user_id
├── title
├── body
├── category
└── timestamps
```

### Material

```text
materials
├── id
├── user_id
├── title
├── description
├── file_path
├── category
└── timestamps
```

### Opportunity

```text
opportunities
├── id
├── user_id
├── title
├── description
├── type
├── date
└── timestamps
```

### Mentor Request

```text
mentor_requests
├── id
├── mentee_id
├── mentor_id
├── message
├── status
└── timestamps
```

### Mentorship

```text
mentorships
├── id
├── mentor_id
├── mentee_id
├── status
└── timestamps
```

---

# Fase 3 — Conteúdos ⭐

Esta é a primeira grande funcionalidade.

Implementar:

- [ ] Listar conteúdos
- [ ] Ver conteúdo
- [ ] Criar conteúdo
- [ ] Editar conteúdo
- [ ] Apagar conteúdo
- [ ] Categorias
- [ ] Autor
- [ ] Data de publicação

Objetivo:

> **Qualquer estudante autorizado deve conseguir encontrar e consumir conhecimento.**

---

# Fase 4 — Materiais 📄

Implementar:

- [ ] Upload de PDF
- [ ] Listagem
- [ ] Download
- [ ] Categorias
- [ ] Disciplina
- [ ] Autor
- [ ] Controle de acesso

---

# Fase 5 — Pesquisa 🔎

Implementar pesquisa inicialmente simples.

Pesquisar por:

- título
- conteúdo
- categoria
- disciplina

Depois evoluir.

---

# Fase 6 — Mentores 👨‍🏫

Implementar:

- [ ] Perfil de mentor
- [ ] Disciplinas dominadas
- [ ] Pesquisa de mentores
- [ ] Pedido de mentoria
- [ ] Aceitar pedido
- [ ] Rejeitar pedido
- [ ] Minhas mentorias

Regra importante:

> Um estudante não deve conseguir enviar vários pedidos pendentes para o mesmo mentor.

---

# Fase 7 — Oportunidades 📢

Implementar:

- [ ] Criar oportunidade
- [ ] Listar oportunidades
- [ ] Ver detalhes
- [ ] Data
- [ ] Categoria
- [ ] Eventos próximos

---

# Fase 8 — Dashboard 🔥

Depois que os dados existirem, construir o dashboard real.

Mostrar:

```text
Bom dia 👋

🔥 Novidades

📚 5 novos conteúdos
📄 3 novos materiais
📢 2 novos eventos


📚 Continue estudando

Banco de Dados


👨‍🏫 Mentores

3 disponíveis


📅 Próximos eventos

Workshop de Laravel
```

---

# 🚫 O que NÃO fazer agora

Quando surgir vontade de adicionar alguma tecnologia nova, lembrar:

### ❌ Não começar React agora

Blade + Tailwind são suficientes para o MVP.

### ❌ Não criar uma API separada

Primeiro fazer o sistema funcionar.

### ❌ Não criar microserviços

Laravel monolítico é suficiente.

### ❌ Não adicionar IA só porque parece interessante

O problema principal é **conhecimento acadêmico**, não inteligência artificial.

### ❌ Não começar pelo chat

Chat é secundário.

### ❌ Não gastar semanas com animações

Primeiro:

> **funciona → é útil → fica bonito.**

### ❌ Não tentar construir tudo de uma vez

Uma funcionalidade completa vale mais que dez telas vazias.

---

# 🥇 Prioridade do MVP

Se houver pouco tempo:

```text
1. 📚 Conteúdos
2. 📄 Materiais
3. 🔎 Pesquisa
4. 📢 Oportunidades
5. 👨‍🏫 Mentores
6. 🔥 Dashboard
```

A ordem pode mudar conforme o desenvolvimento, mas **Conteúdo + Material + Pesquisa** são o coração do produto.

---

# 💡 Regra de ouro

Antes de implementar uma funcionalidade, perguntar:

> **"Isso ajuda o estudante a aprender, encontrar alguma coisa, encontrar alguém ou descobrir uma oportunidade?"**

Se a resposta for **não**, provavelmente pode esperar.

---

# 🚀 O objetivo final

O FauConectado deve chegar a este ponto:

```text
Estudante entra
      ↓
Vê novidades
      ↓
Encontra algo interessante
      ↓
Estuda
      ↓
Procura outro conteúdo
      ↓
Baixa um material
      ↓
Descobre um evento
      ↓
Tem uma dúvida
      ↓
Encontra um mentor
      ↓
Resolve a dúvida
      ↓
Aprende
      ↓
Compartilha conhecimento
      ↓
Outro estudante encontra
```

## 🎯 Missão

> **Construir uma plataforma acadêmica que torne mais fácil aprender, compartilhar conhecimento, encontrar materiais, descobrir oportunidades e encontrar ajuda dentro da faculdade.**

Não estamos construindo apenas um CRUD.

Estamos construindo uma **infraestrutura digital de conhecimento para estudantes**.

---

# 📍 Onde estou agora?

Sempre que voltar ao projeto depois de alguns dias, responder estas perguntas:

### 1. O que já funciona?

Consultar o checklist acima.

### 2. Qual é a próxima funcionalidade?

Seguir a próxima fase incompleta.

### 3. Estou fazendo uma coisa que não está no objetivo?

Se sim, parar e voltar para o roadmap.

### 4. Estou preocupado com tecnologia?

Lembrar:

> **Laravel + MySQL + Blade + Tailwind já são suficientes para construir o MVP.**

### 5. Estou perdido no código?

Voltar para o fluxo:

```text
Database
   ↓
Model
   ↓
Controller
   ↓
Route
   ↓
Blade
```

E construir **uma funcionalidade de cada vez**.

---

# 🏁 Frase do projeto

> **FauConectado — conhecimento, oportunidades e pessoas para ajudar você a avançar na faculdade.**
