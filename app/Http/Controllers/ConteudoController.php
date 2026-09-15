<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConteudoController extends Controller
{
    public function criar()
    {
        return view('conteudos.criar');
    }

    public function armazenar(Request $request)
    {
        $dados = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:100'],
            'conteudo' => ['required', 'string'],
        ]);

        $dados['status'] = 'pendente';

        $request->user()->conteudos()->create($dados);

        return redirect()->route('dashboard')->with('sucesso', 'Conteúdo publicado com sucesso.');
    }
}
