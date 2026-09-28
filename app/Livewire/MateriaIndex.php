<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Materia;

#[Layout('components.layouts.app')]
#[Title('Materiais & Ficheiros | FauConectado')]
class MateriaIndex extends Component
{
    public $search = '';
    public $ano = '';
    public $semestre = '';

    public function render()
    {
        $materias = Materia::query()
            ->when($this->search, function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                      ->orWhere('categoria', 'like', '%' . $this->search . '%');
            })
            ->when($this->ano, function ($query) {
                $query->where('ano', $this->ano);
            })
            ->when($this->semestre, function ($query) {
                $query->where('semestre', $this->semestre);
            })
            ->latest()
            ->get();

        return view('livewire.materia-index', [
            'materias' => $materias
        ]);
    }
}