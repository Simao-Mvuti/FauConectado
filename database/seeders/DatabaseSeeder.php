<?php

namespace Database\Seeders;

use App\Models\Avaliacao;
use App\Models\AvaliacaoMaterial;
use App\Models\Conteudo;
use App\Models\Eventos;
use App\Models\Materias;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $administrador = User::updateOrCreate(['email' => env('ADMIN_EMAIL', 'admin@fauconectado.local')], [
            'name' => env('ADMIN_NAME', 'Administrador FauConectado'),
            'role' => 'admin',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'Admin@12345')),
        ]);

        $aluno = User::updateOrCreate(['email' => 'aluno@fauconectado.local'], [
            'name' => 'Test User',
            'role' => 'mentee',
            'password' => Hash::make('password'),
        ]);

        $mentorBanco = User::updateOrCreate(['email' => 'mentor.banco@fauconectado.local'], [
            'name' => 'Ana Souza',
            'role' => 'mentor',
            'password' => Hash::make('password'),
        ]);

        $mentorProgramacao = User::updateOrCreate(['email' => 'mentor.programacao@fauconectado.local'], [
            'name' => 'Bruno Lima',
            'role' => 'mentor',
            'password' => Hash::make('password'),
        ]);

        Conteudo::updateOrCreate(
            ['user_id' => $mentorBanco->id, 'titulo' => 'Índices no MySQL'],
            [
                'conteudo' => 'Aprenda como índices melhoram consultas e quais cuidados tomar ao criá-los.',
                'categoria' => 'Banco de dados',
                'status' => 'aprovado',
                'moderado_por' => $administrador->id,
                'moderado_em' => now(),
            ],
        );

        Conteudo::updateOrCreate(
            ['user_id' => $mentorProgramacao->id, 'titulo' => 'Primeiros passos com PHP'],
            [
                'conteudo' => 'Uma introdução prática às variáveis, funções e estruturas de controle em PHP.',
                'categoria' => 'Programação',
                'status' => 'aprovado',
                'moderado_por' => $administrador->id,
                'moderado_em' => now(),
            ],
        );

        $materialBanco = Materias::updateOrCreate(
            ['user_id' => $mentorBanco->id, 'titulo' => 'Resumo de banco de dados'],
            [
                'descricao' => 'Material de revisão sobre tabelas, relacionamentos e consultas SQL.',
                'categoria' => 'Banco de dados',
                'arquivo' => 'materiais/resumo-banco.pdf',
                'status' => 'aprovado',
                'moderado_por' => $administrador->id,
                'moderado_em' => now(),
            ],
        );

        $materialProgramacao = Materias::updateOrCreate(
            ['user_id' => $mentorProgramacao->id, 'titulo' => 'Guia de lógica de programação'],
            [
                'descricao' => 'Exercícios e conceitos para desenvolver raciocínio lógico.',
                'categoria' => 'Programação',
                'arquivo' => 'materiais/guia-logica.pdf',
                'status' => 'aprovado',
                'moderado_por' => $administrador->id,
                'moderado_em' => now(),
            ],
        );

        Storage::disk('public')->put('materiais/resumo-banco.pdf', "%PDF-1.4\nFauConectado - material de demonstração\n%%EOF");
        Storage::disk('public')->put('materiais/guia-logica.pdf', "%PDF-1.4\nFauConectado - material de demonstração\n%%EOF");

        Eventos::updateOrCreate(
            ['user_id' => $administrador->id, 'titulo' => 'Plantão de dúvidas de programação'],
            [
                'descricao' => 'Encontro aberto para tirar dúvidas sobre os conteúdos da plataforma.',
                'data' => now()->addDays(7)->toDateString(),
                'local' => 'Sala virtual FauConectado',
                'categoria' => 'Mentoria',
                'link' => null,
            ],
        );

        Avaliacao::updateOrCreate(
            ['avaliador_id' => $aluno->id, 'avaliado_id' => $mentorBanco->id],
            ['nota' => 5, 'comentario' => 'Explica com clareza e sempre traz exemplos práticos.'],
        );

        AvaliacaoMaterial::updateOrCreate(
            ['avaliador_id' => $aluno->id, 'materia_id' => $materialBanco->id],
            ['nota' => 5, 'comentario' => 'Resumo direto e fácil de consultar.'],
        );

        AvaliacaoMaterial::updateOrCreate(
            ['avaliador_id' => $aluno->id, 'materia_id' => $materialProgramacao->id],
            ['nota' => 4, 'comentario' => 'Bom material para começar a praticar.'],
        );

        Avaliacao::updateOrCreate(
            ['avaliador_id' => $aluno->id, 'avaliado_id' => $mentorProgramacao->id],
            ['nota' => 4, 'comentario' => 'Boa didática e materiais úteis para praticar.'],
        );
    }
}
