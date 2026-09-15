<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Avaliacao;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TutoriaController extends Controller
{
    public function solicitar()
    {
        $mentores = User::query()
            ->where('role', 'mentor')
            ->withAvg('avaliacoesRecebidas', 'nota')
            ->withCount('avaliacoesRecebidas')
            ->orderByDesc('avaliacoes_recebidas_avg_nota')
            ->orderByDesc('avaliacoes_recebidas_count')
            ->orderBy('name')
            ->get();

        return view('tutoria.solicitar', compact('mentores'));
    }

    public function armazenarSolicitacao(Request $request)
    {
        $dados = $request->validate([
            'mentor_id' => ['nullable', 'exists:users,id'],
            'assunto' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
        ]);

        $dados['status'] = 'pendente';
        $request->user()->solicitacoesTutoria()->create($dados);

        return redirect()->route('dashboard')->with('sucesso', 'Solicitação de tutor enviada.');
    }

    public function candidatar()
    {
        return view('tutoria.candidatar');
    }

    public function armazenarCandidatura(Request $request)
    {
        $dados = $request->validate([
            'area' => ['required', 'string', 'max:255'],
            'experiencia' => ['required', 'string'],
            'disponibilidade' => ['required', 'string', 'max:255'],
        ]);

        $dados['status'] = 'pendente';
        $request->user()->candidaturasTutor()->create($dados);

        return redirect()->route('dashboard')->with('sucesso', 'Candidatura enviada para análise.');
    }

    public function avaliar()
    {
        $mentores = User::query()
            ->where('role', 'mentor')
            ->withAvg('avaliacoesRecebidas', 'nota')
            ->withCount('avaliacoesRecebidas')
            ->orderByDesc('avaliacoes_recebidas_avg_nota')
            ->orderBy('name')
            ->get();

        return view('tutoria.avaliar', compact('mentores'));
    }

    public function armazenarAvaliacao(Request $request)
    {
        $dados = $request->validate([
            'avaliado_id' => [
                'required',
                Rule::exists('users', 'id')->where(fn ($consulta) => $consulta->where('role', 'mentor')),
            ],
            'nota' => ['required', 'integer', 'min:1', 'max:5'],
            'comentario' => ['nullable', 'string', 'max:1000'],
        ]);

        abort_if((int) $dados['avaliado_id'] === $request->user()->id, 422, 'Você não pode avaliar a si mesmo.');

        Avaliacao::updateOrCreate(
            [
                'avaliador_id' => $request->user()->id,
                'avaliado_id' => $dados['avaliado_id'],
            ],
            [
                'nota' => $dados['nota'],
                'comentario' => $dados['comentario'] ?? null,
            ],
        );

        return back()->with('sucesso', 'Avaliação registrada. A reputação foi atualizada.');
    }
}
