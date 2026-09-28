<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{
    public function run(): void
    {
        $materias = [
            [
                'titulo' => 'Exame Resolvido de Algoritmos 2023',
                'descricao' => 'Resolução completa da época normal com apontamentos e diagramas.',
                'pontuacao' => 4.8,
                'votos' => 15,
                'categoria' => 'Informática',
                'ano' => 1,
                'semestre' => 1,
                'file' => 'materiais/exame_algoritmos_2023.pdf',
            ],
            [
                'titulo' => 'Sebenta Completa de Análise Matemática I',
                'descricao' => 'Resumo teórico com exercícios práticos resolvidos passo a passo.',
                'pontuacao' => 4.9,
                'votos' => 32,
                'categoria' => 'Matemática',
                'ano' => 1,
                'semestre' => 1,
                'file' => 'materiais/sebenta_analise_1.pdf',
            ],
            [
                'titulo' => 'Guia Prático de Programação Orientada a Objetos',
                'descricao' => 'Exemplos em Java e diagramas UML explicados.',
                'pontuacao' => 4.6,
                'votos' => 10,
                'categoria' => 'Informática',
                'ano' => 1,
                'semestre' => 2,
                'file' => 'materiais/poo_guia.pdf',
            ],
            [
                'titulo' => 'Resumo do Modelo ER e SQL - Bases de Dados',
                'descricao' => 'Ficheiro em formato de imagem/PDF com esquemas concisos para revisão.',
                'pontuacao' => 4.7,
                'votos' => 22,
                'categoria' => 'Bases de Dados',
                'ano' => 2,
                'semestre' => 1,
                'file' => 'materiais/sql_resumo.png',
            ],
            [
                'titulo' => 'Formulário de Estatística e Probabilidades',
                'descricao' => 'Tabela de fórmulas essenciais para testes e exames.',
                'pontuacao' => 4.3,
                'votos' => 8,
                'categoria' => 'Matemática',
                'ano' => 2,
                'semestre' => 2,
                'file' => 'materiais/formulario_estatistica.pdf',
            ],
            [
                'titulo' => 'Apontamentos de Engenharia de Software',
                'descricao' => 'Notas sobre metodologias ágeis (Scrum, Kanban) e ciclo de vida.',
                'pontuacao' => 4.5,
                'votos' => 18,
                'categoria' => 'Informática',
                'ano' => 3,
                'semestre' => 1,
                'file' => 'materiais/engenharia_software.pdf',
            ],
        ];

        foreach ($materias as $materia) {
            Materia::updateOrCreate(
                ['titulo' => $materia['titulo']],
                $materia
            );
        }
    }
}