<?php

namespace App\Livewire;

use Livewire\Component;

class ApoiarIndex extends Component
{
    // Aba ativa por padrão ('repositorio', 'tutoria' ou 'apoio')
    public string $abaAtiva = 'repositorio';

    // Estado do FAQ aberto (null se nenhum estiver aberto)
    public ?int $faqAberto = null;

    /**
     * Alterna a aba ativa
     */
    public function selecionarAba(string $aba): void
    {
        $this->abaAtiva = $aba;
    }

    /**
     * Alterna a abertura do item no acordeão FAQ
     */
    public function toggleFaq(int $id): void
    {
        if ($this->faqAberto === $id) {
            $this->faqAberto = null; // Fecha se já estiver aberto
        } else {
            $this->faqAberto = $id;  // Abre o item selecionado
        }
    }

    public function render()
    {
        return view('livewire.apoiar-index');
    }
}