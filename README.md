# 🎓 Nome do Projeto

> Uma plataforma desenvolvida para apoiar estudantes e melhorar a experiência acadêmica dentro da comunidade universitária.

**Status:** 🚧 Em desenvolvimento

---

## 📌 Sobre o projeto

Este projeto nasceu de uma ideia simples: **criar uma solução útil para estudantes da faculdade**, centralizando recursos e serviços que atualmente podem estar espalhados por diferentes canais ou depender de comunicação informal.

Mais do que um projeto acadêmico, queremos transformar esta ideia em uma **solução real, utilizável e evolutiva**, construída com base nas necessidades dos próprios estudantes.

O objetivo é começar com uma versão simples e funcional e, ao longo do desenvolvimento, adicionar novas funcionalidades de acordo com o feedback dos estudantes.

---

## 🎯 Objetivos

O projeto pretende:

- 🎓 Facilitar o acesso a recursos acadêmicos.
- 🔎 Ajudar estudantes a encontrar pessoas, materiais e serviços úteis.
- 🤝 Incentivar a colaboração entre estudantes.
- 📚 Centralizar materiais e informações importantes.
- 💡 Criar espaço para iniciativas e projetos acadêmicos.
- 🚀 Desenvolver uma solução que possa continuar existindo depois da apresentação do projeto.

---

## 🧩 O que estamos construindo?

A plataforma será desenvolvida de forma modular. Algumas das funcionalidades planejadas incluem:

### 👨‍🎓 Perfil do estudante

Cada estudante poderá possuir um perfil com informações relevantes para a comunidade acadêmica.

### 📚 Materiais acadêmicos

Área para disponibilização e organização de materiais de estudo, documentos e outros recursos.

### 🧑🏽‍🏫 Procura de tutores

Uma funcionalidade para ajudar estudantes a encontrar colegas ou pessoas que possam ajudá-los em determinadas disciplinas ou áreas.

A ideia é permitir pesquisas por:

- Disciplina;
- Curso;
- Área de conhecimento;
- Disponibilidade;
- Outros critérios relevantes.

### 🔎 Procura de pessoas e oportunidades

Pretendemos facilitar a descoberta de estudantes com interesses, conhecimentos ou projetos semelhantes.

Isso poderá ajudar na formação de equipes para trabalhos, projetos acadêmicos e outras iniciativas.

### 🛍️ Marketplace acadêmico

Espaço onde estudantes poderão divulgar produtos ou serviços que possam ser úteis para outros estudantes.

### 📢 Divulgação de projetos

Possibilidade de apresentar projetos acadêmicos, iniciativas e trabalhos desenvolvidos pelos estudantes.

---

## 🗺️ Visão do projeto

A nossa visão não é simplesmente criar mais um site.

Queremos construir uma **comunidade digital acadêmica**, onde um estudante possa encontrar:

> 📚 conhecimento
> 🤝 pessoas
> 💡 oportunidades
> 🛠️ projetos
> 🎓 apoio acadêmico

Tudo em um único lugar.

---

## 🏗️ Estado atual

O projeto ainda está em desenvolvimento.

### ✅ Já planejado

- [x] Definição da ideia inicial
- [x] Definição dos principais objetivos
- [ ] Estrutura inicial da aplicação
- [ ] Sistema de autenticação
- [ ] Perfis de estudantes
- [ ] Materiais acadêmicos
- [ ] Sistema de procura de tutores
- [ ] Projetos acadêmicos
- [ ] Marketplace
- [ ] Sistema de administração

> ⚠️ A lista será atualizada conforme o desenvolvimento avançar.

---

## 🛠️ Tecnologias

Atualmente estamos utilizando:

- **PHP**
- **Laravel**
- **MySQL**
- **Blade**
- **Tailwind CSS**
- **JavaScript**

A escolha das tecnologias poderá evoluir conforme as necessidades do projeto.

---

## 🏛️ Arquitetura

O projeto está sendo desenvolvido utilizando o framework **Laravel**, buscando manter uma estrutura organizada e fácil de evoluir.

A aplicação seguirá uma arquitetura que separa responsabilidades entre:

- Rotas
- Controllers
- Models
- Views
- Banco de dados
- Autenticação
- Regras de negócio

O objetivo é que novos estudantes possam entrar no projeto e compreender facilmente onde cada parte da aplicação está localizada.

---

## 🚀 Instalação

### Pré-requisitos

Antes de começar, você precisa ter instalado:

- PHP 8.2+
- Composer
- MySQL
- Node.js
- npm
- Git

### 1. Clone o repositório

```bash
git clone https://github.com/Simao-Mvuti/FauConectado.git
cd https://github.com/Simao-Mvuti/FauConectado.git
```

### 2. Instale as dependências

```bash
composer install
```

```bash
npm install
```

### 3. Configure o ambiente

Copie o arquivo `.env.example`:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

Configure no `.env` as informações do banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 4. Execute as migrations

```bash
php artisan migrate
```

### 5. Inicie o servidor

```bash
php artisan serve
```

Em outro terminal:

```bash
npm run dev
```

Depois acesse:

```text
http://127.0.0.1:8000
```

---

## 🤝 Como contribuir

Este é um projeto acadêmico, mas queremos que ele seja construído de forma colaborativa.

Se você é estudante e tem uma ideia, encontrou um problema ou gostaria de ajudar no desenvolvimento, sua contribuição é bem-vinda.

### Você pode contribuir com:

- 💡 Novas ideias;
- 🐛 Correção de bugs;
- 🎨 Melhorias na interface;
- 💻 Desenvolvimento de funcionalidades;
- 📚 Documentação;
- 🔐 Segurança;
- 🧪 Testes;
- 📝 Sugestões baseadas na experiência dos estudantes.

### Fluxo de contribuição

1. Faça um **fork** do projeto.
2. Crie uma branch para sua alteração:

```bash
git checkout -b minha-feature
```

3. Faça suas alterações.
4. Faça o commit:

```bash
git commit -m "feat: adiciona nova funcionalidade"
```

5. Envie sua branch:

```bash
git push origin minha-feature
```

6. Abra um **Pull Request** explicando sua contribuição.

Antes de desenvolver uma funcionalidade grande, recomendamos abrir uma **Issue** para discutirmos a ideia primeiro.

---

## 💬 Sugestões e feedback

O projeto será desenvolvido com base nas necessidades reais dos estudantes.

Se você perceber um problema que poderia ser resolvido pela plataforma, queremos ouvir sua opinião.

Você pode contribuir através de:

- Issues;
- Pull Requests;
- Discussões;
- Feedback direto da comunidade acadêmica.

**Uma boa ideia pode começar como uma simples Issue.**

---

## 🧭 Roadmap

### Fase 1 — Fundação

- [ ] Estrutura do projeto
- [ ] Banco de dados
- [ ] Autenticação
- [ ] Cadastro de estudantes
- [ ] Sistema de perfis

### Fase 2 — Recursos acadêmicos

- [ ] Materiais acadêmicos
- [ ] Procura de tutores
- [ ] Pesquisa de estudantes
- [ ] Projetos acadêmicos

### Fase 3 — Comunidade

- [ ] Marketplace
- [ ] Divulgação de oportunidades
- [ ] Interação entre estudantes
- [ ] Sistema de notificações

### Fase 4 — Evolução

- [ ] Melhorias de segurança
- [ ] Testes automatizados
- [ ] Otimização
- [ ] Deploy
- [ ] Feedback dos utilizadores
- [ ] Novas funcionalidades

---

## 🔐 Segurança

A segurança é uma das preocupações do projeto.

Informações pessoais dos estudantes devem ser tratadas com cuidado e funcionalidades que envolvam dados pessoais deverão considerar:

- Autenticação;
- Autorização;
- Privacidade;
- Validação de dados;
- Proteção contra acessos indevidos.

Funcionalidades que envolvam informações pessoais poderão possuir opções de visibilidade e controle por parte do utilizador.

---

## 🎓 Contexto acadêmico

Este projeto está sendo desenvolvido no contexto acadêmico, mas existe uma intenção maior:

**aprender construindo algo que possa realmente ser utilizado.**

Por isso, o projeto será desenvolvido de forma incremental, começando por uma versão funcional e evoluindo conforme recebemos feedback.

---

## 👥 Equipe

Projeto desenvolvido por estudantes interessados em tecnologia, inovação e melhoria da experiência acadêmica.

### Desenvolvedores

- **Simão Mvuti** — Desenvolvimento / Backend / Arquitetura
- **Contribuidores** — Em aberto

Quer participar?
Veja a seção [Como contribuir](#-como-contribuir).

---

## 📄 Licença

Este projeto ainda não possui uma licença definida.

A licença será definida antes da primeira versão pública.
