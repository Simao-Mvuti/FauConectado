<?php

namespace Tests\Feature;

use App\Models\Materia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAndTutorRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_tutor_inscricao_route_is_accessible(): void
    {
        $response = $this->get('/tutores-inscricao');

        $response->assertOk();
    }

    public function test_admin_dashboard_requires_admin_role(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $this->actingAs($user)
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_admin_dashboard_is_accessible_for_admin(): void
    {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($user)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Painel Administrativo')
            ->assertSee('Gestão Geral');
    }

    public function test_registered_user_can_be_promoted_to_admin_from_artisan(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $this->artisan('app:make-admin', [
            'email' => $user->email,
            '--force' => true,
        ])->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'is_admin' => true,
        ]);
    }

    public function test_admin_command_does_not_create_a_user_for_unknown_email(): void
    {
        $this->artisan('app:make-admin', [
            'email' => 'missing@example.com',
            '--force' => true,
        ])->assertFailed();

        $this->assertDatabaseMissing('users', [
            'email' => 'missing@example.com',
        ]);
    }

    public function test_pending_material_is_not_publicly_visible(): void
    {
        $materia = $this->createMateria('Material pendente', false);

        $this->get('/materias')
            ->assertOk()
            ->assertDontSee('Material pendente');

        $this->get(route('materias.show', $materia))
            ->assertNotFound();
    }

    public function test_admin_can_approve_material_and_publish_it(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $materia = $this->createMateria('Material revisado', false);

        $this->actingAs($admin)
            ->post(route('admin.materiais.aprovar', $materia))
            ->assertRedirect(route('admin.materiais'));

        $this->assertDatabaseHas('materias', [
            'id' => $materia->id,
            'aprovado' => true,
        ]);

        $this->get('/materias')
            ->assertOk()
            ->assertSee('Material revisado');
    }

    public function test_non_admin_cannot_approve_material(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $materia = $this->createMateria('Material protegido', false);

        $this->actingAs($user)
            ->post(route('admin.materiais.aprovar', $materia))
            ->assertForbidden();

        $this->assertDatabaseHas('materias', [
            'id' => $materia->id,
            'aprovado' => false,
        ]);
    }

    private function createMateria(string $titulo, bool $aprovado): Materia
    {
        return Materia::create([
            'titulo' => $titulo,
            'descricao' => 'Material para testes',
            'pontuacao' => 0,
            'votos' => 0,
            'categoria' => 'Matemática',
            'ano' => 1,
            'semestre' => 1,
            'file' => 'materias/teste.pdf',
            'aprovado' => $aprovado,
        ]);
    }
}
