<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\SolicitacaoTutoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TutoriaController extends Controller
{
    public function solicitar(Request $request)
    {
        $mentores = User::query()
            ->where('role', 'mentor')
            ->whereKeyNot($request->user()->id)
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
            'mentor_id' => [
                'nullable',
                Rule::exists('users', 'id')->where(fn ($consulta) => $consulta
                    ->where('role', 'mentor')
                    ->whereKeyNot($request->user()->id)),
            ],
            'assunto' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:5000'],
        ]);

        $solicitacaoExistente = $request->user()->solicitacoesTutoria()
            ->where('status', 'pendente')
            ->exists();

        if ($solicitacaoExistente) {
            return back()->withInput()->withErrors(['solicitacao' => 'Você já possui uma solicitação pendente. Aguarde o atendimento antes de enviar outra.']);
        }

        $dados['status'] = 'pendente';
        $request->user()->solicitacoesTutoria()->create($dados);

        return redirect()->route('dashboard')->with('sucesso', 'Solicitação de tutor enviada.');
    }

    public function candidatar()
    {
        return view('tutoria.candidatar', [
            'candidaturaAtual' => request()->user()->candidaturasTutor()->latest()->first(),
        ]);
    }

    public function armazenarCandidatura(Request $request)
    {
        if ($request->user()->role === 'mentor') {
            return back()->withErrors(['candidatura' => 'Você já está cadastrado como mentor.']);
        }

        if ($request->user()->candidaturasTutor()->where('status', 'pendente')->exists()) {
            return back()->withInput()->withErrors(['candidatura' => 'Sua candidatura já está aguardando análise.']);
        }

        $dados = $request->validate([
            'area' => ['required', 'string', 'max:255'],
            'experiencia' => ['required', 'string', 'max:5000'],
            'disponibilidade' => ['required', 'string', 'max:255'],
        ]);

        $dados['status'] = 'pendente';
        $request->user()->candidaturasTutor()->create($dados);

        return redirect()->route('dashboard')->with('sucesso', 'Candidatura enviada para análise.');
    }

    public function avaliar(Request $request)
    {
        $mentores = User::query()
            ->where('role', 'mentor')
            ->whereKeyNot($request->user()->id)
            ->withAvg('avaliacoesRecebidas', 'nota')
            ->withCount('avaliacoesRecebidas')
            ->orderByDesc('avaliacoes_recebidas_avg_nota')
            ->orderBy('name')
            ->get();

        return view('tutoria.avaliar', compact('mentores'));
    }

    public function assumirSolicitacao(Request $request, SolicitacaoTutoria $solicitacao)
    {
        abort_unless($request->user()->role === 'mentor', 403);
        abort_if($solicitacao->user_id === $request->user()->id, 422, 'Você não pode assumir sua própria solicitação.');

        if ($solicitacao->mentor_id && $solicitacao->mentor_id !== $request->user()->id) {
            abort(403, 'Esta solicitação foi direcionada a outro mentor.');
        }

        $assumida = SolicitacaoTutoria::query()
            ->whereKey($solicitacao->id)
            ->where('status', 'pendente')
            ->where(function ($query) use ($request): void {
                $query->whereNull('mentor_id')->orWhere('mentor_id', $request->user()->id);
            })
            ->update([
                'mentor_id' => $request->user()->id,
            'status' => 'aceita',
            ]);

        abort_unless($assumida, 409, 'Esta solicitação acabou de ser assumida por outro mentor.');

        return back()->with('sucesso', 'Solicitação assumida. Entre em contato com o estudante para combinar o atendimento.');
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
