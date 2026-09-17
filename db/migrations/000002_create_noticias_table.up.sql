CREATE noticias(
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(60),
    descricao TEXT NOT NULL,
    categoria TEXT NOT NULL
);