<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;
use App\Models\Eventos;
use App\Models\Materias;
use App\Models\SolicitacaoTutoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        /** @var User $user */
        $dataAtual = Carbon::today();
        $busca = trim((string) $request->string('busca'));

        $conteudos = Conteudo::query()
            ->where('status', 'aprovado')
            ->when($busca !== '', function ($query) use ($busca): void {
                $query->where(function ($query) use ($busca): void {
                    $query->where('titulo', 'like', "%{$busca}%")
                        ->orWhere('conteudo', 'like', "%{$busca}%")
                        ->orWhere('categoria', 'like', "%{$busca}%");
                });
            })
            ->latest()
            ->take(5)
            ->get();

        $materias = Materias::query()
            ->where('status', 'aprovado')
            ->when($busca !== '', function ($query) use ($busca): void {
                $query->where(function ($query) use ($busca): void {
                    $query->where('titulo', 'like', "%{$busca}%")
                        ->orWhere('descricao', 'like', "%{$busca}%")
                        ->orWhere('categoria', 'like', "%{$busca}%");
                });
            })
            ->withAvg('avaliacoes', 'nota')
            ->withCount('avaliacoes')
            ->latest()
            ->take(6)
            ->get();

        $eventos = Eventos::query()
            ->whereDate('data', '>=', $dataAtual)
            ->when($busca !== '', function ($query) use ($busca): void {
                $query->where(function ($query) use ($busca): void {
                    $query->where('titulo', 'like', "%{$busca}%")
                        ->orWhere('descricao', 'like', "%{$busca}%")
                        ->orWhere('local', 'like', "%{$busca}%")
                        ->orWhere('categoria', 'like', "%{$busca}%");
                });
            })
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
                'icon' => null,
                'value' => Conteudo::where('status', 'aprovado')->count(),
                'label' => 'conteúdos disponíveis',
                'card_class' => 'hover:border-forest/30',
                'icon_class' => 'bg-mint text-forest',
            ],
            [
                'icon' => null,
                'value' => Materias::where('status', 'aprovado')->count(),
                'label' => 'materiais disponíveis',
                'card_class' => 'hover:border-coral/30',
                'icon_class' => 'bg-coral/10 text-coral',
            ],
            [
                'icon' => null,
                'value' => Eventos::whereDate('data', '>=', $dataAtual)->count(),
                'label' => 'próximos eventos',
                'card_class' => 'hover:border-forest/30',
                'icon_class' => 'bg-forest/10 text-forest',
            ],
            [
                'icon' => null,
                'value' => User::where('role', 'mentor')->count(),
                'label' => 'mentores disponíveis',
                'card_class' => 'hover:border-coral/30',
                'icon_class' => 'bg-coral/10 text-coral',
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
            'busca' => $busca,
        ]);
    }
}
