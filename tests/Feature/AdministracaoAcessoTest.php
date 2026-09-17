<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdministracaoAcessoTest extends TestCase
{
    use RefreshDatabase;

    public function test_administrative_access_screen_is_public(): void
    {
        $response = $this->get(route('administracao.acesso'));

        $response->assertOk()->assertViewIs('administracao.acesso');
    }

    public function test_invalid_administrative_key_is_rejected(): void
    {
        config(['app.admin_access_key' => 'correct-key']);

        $response = $this->from(route('administracao.acesso'))
            ->post(route('administracao.autenticar'), ['chave' => 'wrong-key']);

        $response->assertRedirect(route('administracao.acesso'))
            ->assertSessionHasErrors('chave');
        $this->assertGuest();
    }

    public function test_valid_administrative_key_authenticates_an_admin(): void
    {
        config(['app.admin_access_key' => 'correct-key']);
        User::factory()->create(['role' => 'admin']);

        $response = $this->post(route('administracao.autenticar'), ['chave' => 'correct-key']);

        $response->assertRedirect(route('administracao.painel'));
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs(User::query()->where('role', 'admin')->first());
    }

    public function test_admin_can_update_a_users_role(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $usuario = User::factory()->create(['role' => 'mentee']);
        $this->actingAs($admin);

        $response = $this->post(route('administracao.usuarios.papel', $usuario), ['role' => 'mentor']);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['id' => $usuario->id, 'role' => 'mentor']);
    }

    public function test_admin_cannot_change_their_own_role(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->post(route('administracao.usuarios.papel', $admin), ['role' => 'mentor']);

        $response->assertStatus(422);
        $this->assertDatabaseHas('users', ['id' => $admin->id, 'role' => 'admin']);
    }
}
