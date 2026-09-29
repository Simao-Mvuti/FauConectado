<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MateriaUploadAndTutorDbTest extends TestCase
{
    use RefreshDatabase;

    public function test_tutores_page_uses_database_users(): void
    {
        $tutor = User::factory()->create([
            'name' => 'Ana Tutor',
            'is_admin' => false,
        ]);

        $response = $this->get('/tutores');

        $response->assertOk()->assertSee($tutor->name);
    }

    public function test_users_can_submit_material_for_approval(): void
    {
        Storage::fake('public');

        $response = $this->post('/materias/upload', [
            'titulo' => 'Resumo de Álgebra',
            'descricao' => 'Resumo para revisão',
            'categoria' => 'Matemática',
            'ano' => 1,
            'semestre' => 1,
            'file' => UploadedFile::fake()->create('resumo.pdf', 200, 'application/pdf'),
        ]);

        $response->assertRedirect(route('materias.index'));
        $this->assertDatabaseHas('materias', [
            'titulo' => 'Resumo de Álgebra',
            'categoria' => 'Matemática',
            'aprovado' => false,
        ]);
    }
}
