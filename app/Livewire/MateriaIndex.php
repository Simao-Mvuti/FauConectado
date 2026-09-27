<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title; // 1. Importar o Atributo Title
use App\Models\Materia;

#[Layout('components.layouts.app')]
#[Title('Matérias & Cadeiras | FauConectado')]
class MateriaIndex extends Component
{
    public $search = '';
    public $ano = '';
    public $semestre = '';

    public function render()
    {
        $materias = Materia::query()
            ->when($this->search, function ($query) {
                $query->where('nome', 'like', '%' . $this->search . '%')
                      ->orWhere('codigo', 'like', '%' . $this->search . '%');
            })
            ->when($this->ano, function ($query) {
                $query->where('ano', $this->ano);
            })
            ->when($this->semestre, function ($query) {
                $query->where('semestre', $this->semestre);
            })
            ->get();

        // 3. Retornar a view limpa
        return view('livewire.materia-index', [
            'materias' => $materias
        ]);
    }
}