<?php

namespace App\Livewire;

use App\Models\Materia;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class MateriaShow extends Component
{
    public Materia $materia;

    public function mount($id)
    {
        $this->materia = Materia::findOrFail($id);
    }

    public function download()
    {
        // Verifica se o ficheiro existe no disco antes de baixar
        if (Storage::disk('public')->exists($this->materia->file)) {
            return Storage::disk('public')->download($this->materia->file);
        }

        // Se o ficheiro não for encontrado no storage, envia uma mensagem de erro flash
        session()->flash('error', 'O ficheiro solicitado não foi encontrado no servidor.');
    }

    public function render()
    {
        return view('livewire.materia-show');
    }
}