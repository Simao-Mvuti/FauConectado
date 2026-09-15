<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function criar()
    {
        return view('eventos.criar');
    }

    public function armazenar(Request $request)
    {
        $dados = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'data' => ['required', 'date', 'after_or_equal:today'],
            'local' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:100'],
            'link' => ['nullable', 'url', 'max:255'],
        ]);

        $request->user()->eventos()->create($dados);

        return redirect()->route('dashboard')->with('sucesso', 'Evento criado com sucesso.');
    }
}
