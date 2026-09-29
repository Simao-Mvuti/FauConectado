<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class TutorIndex extends Component
{
    public function render()
    {
        $tutores = User::query()
            ->where('is_admin', false)
            ->latest()
            ->get();

        return view('livewire.tutor-index', [
            'tutores' => $tutores,
        ]);
    }

    public function inscrever()
    {
        return view('tutores.inscricao');
    }
}
