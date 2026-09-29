<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MateriaUploadController extends Controller
{
    public function create()
    {
        return view('materias.upload');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string', 'max:2000'],
            'categoria' => ['required', 'string', 'max:100'],
            'ano' => ['required', 'integer', 'min:1', 'max:6'],
            'semestre' => ['required', 'integer', 'min:1', 'max:2'],
            'file' => ['required', 'file', 'mimes:pdf,png,jpg,jpeg,doc,docx', 'max:10240'],
        ]);

        $path = $request->file('file')->store('materias', 'public');

        Materia::create([
            'titulo' => $validated['titulo'],
            'descricao' => $validated['descricao'] ?? null,
            'categoria' => $validated['categoria'],
            'ano' => $validated['ano'],
            'semestre' => $validated['semestre'],
            'file' => $path,
            'pontuacao' => 0,
            'votos' => 0,
            'aprovado' => false,
        ]);

        return redirect()->route('materias.index')->with('success', 'Material enviado com sucesso e pendente de aprovação.');
    }
}
