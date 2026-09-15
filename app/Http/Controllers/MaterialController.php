<?php

namespace App\Http\Controllers;

use App\Models\AvaliacaoMaterial;
use App\Models\Materias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function criar()
    {
        return view('materiais.criar');
    }

    public function armazenar(Request $request)
    {
        $dados = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'categoria' => ['required', 'string', 'max:100'],
            'arquivo' => ['required', 'file', 'max:10240', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip'],
        ]);

        $dados['arquivo'] = $request->file('arquivo')->store('materiais', 'public');
        $dados['status'] = 'pendente';
        $request->user()->materiais()->create($dados);

        return redirect()->route('dashboard')->with('sucesso', 'Material cadastrado com sucesso.');
    }

    public function baixar(Materias $materia)
    {
        abort_unless($materia->status === 'aprovado' && $materia->arquivo, 404);
        abort_unless(Storage::disk('public')->exists($materia->arquivo), 404);

        return response()->download(Storage::disk('public')->path($materia->arquivo), basename($materia->arquivo));
    }

    public function avaliar(Request $request, Materias $materia)
    {
        abort_unless($materia->status === 'aprovado', 404);

        $dados = $request->validate([
            'nota' => ['required', 'integer', 'min:1', 'max:5'],
            'comentario' => ['nullable', 'string', 'max:1000'],
        ]);

        abort_if($materia->user_id === $request->user()->id, 422, 'Você não pode avaliar o próprio material.');

        AvaliacaoMaterial::updateOrCreate(
            [
                'avaliador_id' => $request->user()->id,
                'materia_id' => $materia->id,
            ],
            [
                'nota' => $dados['nota'],
                'comentario' => $dados['comentario'] ?? null,
            ],
        );

        return back()->with('sucesso', 'Avaliação do material registrada.');
    }
}
