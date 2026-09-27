<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class ComoFuncionaIndex extends Component
{
    // Aba ativa por padrão: 'repositorio', 'tutoria', 'apoio'
    public string $abaAtiva = 'repositorio';

    // ID do item de FAQ aberto
    public ?int $faqAberto = null;

    public function selecionarAba(string $aba): void
    {
        $this->abaAtiva = $aba;
    }

    public function toggleFaq(int $id): void
    {
        $this->faqAberto = ($this->faqAberto === $id) ? null : $id;
    }

    public function render()
    {
        return view('livewire.como-funciona');
    }
}