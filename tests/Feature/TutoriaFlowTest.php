<?php

namespace Tests\Feature;

use App\Models\CandidaturaTutor;
use App\Models\SolicitacaoTutoria;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TutoriaFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_administrator_approving_a_candidate_promotes_the_user_to_mentor(): void
    {
        $candidato = User::factory()->create(['role' => 'user']);
        $administrador = User::factory()->create(['role' => 'admin']);
        /** @var User $candidato */
        /** @var User $administrador */
        $this->actingAs($candidato)->post(route('tutores.candidaturas.armazenar'), [
            'area' => 'Programação',
            'experiencia' => 'Experiência com PHP e Laravel.',
            'disponibilidade' => 'Terças à noite',
        ])->assertRedirect(route('dashboard'));

        $candidatura = CandidaturaTutor::query()->firstOrFail();

        $this->actingAs($administrador)->post(route('administracao.candidaturas.aprovar', $candidatura))
            ->assertRedirect();

        $this->assertDatabaseHas('candidaturas_tutor', [
            'id' => $candidatura->id,
            'status' => 'aprovada',
        ]);
        $this->assertSame('mentor', $candidato->refresh()->role);
    }

    public function test_only_a_mentor_can_assume_a_tutoring_request(): void
    {
        $aluno = User::factory()->create(['role' => 'user']);
        $mentor = User::factory()->create(['role' => 'mentor']);
        /** @var User $aluno */
        /** @var User $mentor */
        $this->actingAs($aluno)->post(route('tutores.solicitacoes.armazenar'), [
            'assunto' => 'Dúvidas de banco de dados',
            'descricao' => 'Preciso de ajuda com relacionamentos.',
        ])->assertRedirect(route('dashboard'));

        $solicitacao = SolicitacaoTutoria::query()->firstOrFail();

        $this->actingAs($aluno)->post(route('tutores.solicitacoes.assumir', $solicitacao))
            ->assertForbidden();

        $this->actingAs($mentor)->post(route('tutores.solicitacoes.assumir', $solicitacao))
            ->assertRedirect();

        $this->assertDatabaseHas('solicitacoes_tutoria', [
            'id' => $solicitacao->id,
            'mentor_id' => $mentor->id,
            'status' => 'aceita',
        ]);
    }
}
