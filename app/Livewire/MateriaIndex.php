<?php

namespace App\Livewire;

use App\Models\Materia;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

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
            ->where('aprovado', true)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('titulo', 'like', '%'.$this->search.'%')
                        ->orWhere('categoria', 'like', '%'.$this->search.'%');
                });
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
            'materias' => $materias,
        ]);
    }
}
