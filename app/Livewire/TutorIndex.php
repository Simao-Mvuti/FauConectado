<?php

namespace App\Livewire;

use Livewire\Component;

class TutorIndex extends Component
{
    public function render()
    {
        return view('livewire.tutor-index');
    }

    public function inscrever()
    {
        return redirect()->route('tutor.inscricao');
    }
}
