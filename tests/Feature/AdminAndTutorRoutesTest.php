<?php

namespace Tests\Feature;

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
}
