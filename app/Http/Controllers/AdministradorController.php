<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;
use App\Models\Materias;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index()
    {
        return view('administracao.painel', [
            'conteudosPendentes' => Conteudo::with('autor')->where('status', 'pendente')->latest()->get(),
            'materiaisPendentes' => Materias::with('autor')->where('status', 'pendente')->latest()->get(),
            'totalPendentes' => Conteudo::where('status', 'pendente')->count() + Materias::where('status', 'pendente')->count(),
        ]);
    }

    public function aprovarConteudo(Conteudo $conteudo)
    {
        $conteudo->update([
            'status' => 'aprovado',
            'moderado_por' => request()->user()->id,
            'moderado_em' => now(),
            'motivo_rejeicao' => null,
        ]);

        return back()->with('sucesso', 'Conteúdo aprovado e publicado.');
    }

    public function rejeitarConteudo(Request $request, Conteudo $conteudo)
    {
        $dados = $request->validate([
            'motivo_rejeicao' => ['required', 'string', 'max:1000'],
        ]);

        $conteudo->update([
            'status' => 'rejeitado',
            'moderado_por' => $request->user()->id,
            'moderado_em' => now(),
            'motivo_rejeicao' => $dados['motivo_rejeicao'],
        ]);

        return back()->with('sucesso', 'Conteúdo rejeitado com justificativa.');
    }

    public function aprovarMaterial(Materias $materia)
    {
        $materia->update([
            'status' => 'aprovado',
            'moderado_por' => request()->user()->id,
            'moderado_em' => now(),
            'motivo_rejeicao' => null,
        ]);

        return back()->with('sucesso', 'Material aprovado e publicado.');
    }

    public function rejeitarMaterial(Request $request, Materias $materia)
    {
        $dados = $request->validate([
            'motivo_rejeicao' => ['required', 'string', 'max:1000'],
        ]);

        $materia->update([
            'status' => 'rejeitado',
            'moderado_por' => $request->user()->id,
            'moderado_em' => now(),
            'motivo_rejeicao' => $dados['motivo_rejeicao'],
        ]);

        return back()->with('sucesso', 'Material rejeitado com justificativa.');
    }
}
