<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;
use App\Models\Eventos;
use App\Models\Materias;
use App\Models\SolicitacaoTutoria;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        /** @var User $user */
        $dataAtual = Carbon::today();

        $conteudos = Conteudo::query()
            ->where('status', 'aprovado')
            ->latest()
            ->take(5)
            ->get();

        $materias = Materias::query()
            ->where('status', 'aprovado')
            ->withAvg('avaliacoes', 'nota')
            ->withCount('avaliacoes')
            ->latest()
            ->take(6)
            ->get();

        $eventos = Eventos::query()
            ->whereDate('data', '>=', $dataAtual)
            ->orderBy('data')
            ->take(5)
            ->get();

        $solicitacoesEnviadas = $user->solicitacoesTutoria()
            ->with('mentor:id,name')
            ->latest()
            ->take(5)
            ->get();

        $solicitacoesDisponiveis = $user->role === 'mentor'
          ? SolicitacaoTutoria::query()
              ->with('solicitante:id,name')
              ->where('status', 'pendente')
              ->where(function ($query) use ($user): void {
                  $query->whereNull('mentor_id')->orWhere('mentor_id', $user->id);
              })
              ->latest()
              ->take(5)
              ->get()
          : collect();

        $candidaturaTutor = $user->candidaturasTutor()->latest()->first();

        $estatisticas = [
            [
                'icon' => '📚',
                'value' => Conteudo::where('status', 'aprovado')->count(),
                'label' => 'conteúdos disponíveis',
                'card_class' => 'hover:border-indigo-300',
                'icon_class' => 'bg-indigo-50 text-indigo-600',
            ],
            [
                'icon' => '📄',
                'value' => Materias::where('status', 'aprovado')->count(),
                'label' => 'materiais disponíveis',
                'card_class' => 'hover:border-blue-300',
                'icon_class' => 'bg-blue-50 text-blue-600',
            ],
            [
                'icon' => '📢',
                'value' => Eventos::whereDate('data', '>=', $dataAtual)->count(),
                'label' => 'próximos eventos',
                'card_class' => 'hover:border-amber-300',
                'icon_class' => 'bg-amber-50 text-amber-600',
            ],
            [
                'icon' => '👨‍🏫',
                'value' => User::where('role', 'mentor')->count(),
                'label' => 'mentores disponíveis',
                'card_class' => 'hover:border-emerald-300',
                'icon_class' => 'bg-emerald-50 text-emerald-600',
            ],
        ];

        return view('dashboard', [
            'user' => $user,
            'conteudos' => $conteudos,
            'materias' => $materias,
            'eventos' => $eventos,
            'estatisticas' => $estatisticas,
            'ultimoConteudo' => $conteudos->first(),
            'solicitacoesEnviadas' => $solicitacoesEnviadas,
            'solicitacoesDisponiveis' => $solicitacoesDisponiveis,
            'candidaturaTutor' => $candidaturaTutor,
        ]);
    }
}
