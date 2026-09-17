@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-paper py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <x-cabecalho-dashboard :user="$user" />

            @if ($candidaturaTutor || $solicitacoesEnviadas->isNotEmpty() || $solicitacoesDisponiveis->isNotEmpty())
                <section class="grid grid-cols-1 gap-5 lg:grid-cols-2" aria-labelledby="tutoria-dashboard-titulo">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-semibold text-coral">Acompanhamento</p>
                            <h2 id="tutoria-dashboard-titulo" class="font-display text-xl font-bold text-ink">Minha tutoria</h2>
                        </div>
                        @if ($candidaturaTutor)
                            <div class="rounded-2xl border border-forest/10 bg-white p-5 shadow-soft">
                                <div class="flex items-start justify-between gap-4">
                                    <div><p class="text-xs font-semibold uppercase tracking-wider text-ink/45">Candidatura a mentor</p><p class="mt-1 font-bold text-ink">{{ $candidaturaTutor->area }}</p></div>
                                    <span class="rounded-full bg-mint px-3 py-1 text-xs font-bold text-forest">{{ ucfirst($candidaturaTutor->status) }}</span>
                                </div>
                                <p class="mt-3 text-sm text-ink/60">{{ $candidaturaTutor->status === 'pendente' ? 'A administração ainda está analisando seus dados.' : ($candidaturaTutor->status === 'aprovada' ? 'Você já pode receber solicitações de tutoria.' : 'Você pode enviar uma nova candidatura após revisar seus dados.') }}</p>
                            </div>
                        @endif
                        @forelse ($solicitacoesEnviadas as $solicitacao)
                            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                                <div class="flex items-start justify-between gap-4"><h3 class="font-bold text-slate-900">{{ $solicitacao->assunto }}</h3><span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-700">{{ ucfirst($solicitacao->status) }}</span></div>
                                <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ $solicitacao->descricao }}</p>
                                <p class="mt-3 text-xs text-slate-500">{{ $solicitacao->mentor ? 'Mentor: '.$solicitacao->mentor->name : 'Aguardando um mentor disponível' }}</p>
                            </div>
                        @empty
                            @if (! $candidaturaTutor)
                                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-5 text-sm text-slate-500">Você ainda não enviou uma solicitação de tutoria.</div>
                            @endif
                        @endforelse
                    </div>

                    @if ($user->role === 'mentor')
                        <div class="space-y-4">
                            <div><p class="text-sm font-semibold text-forest">Para atender</p><h2 class="font-display text-xl font-bold text-ink">Solicitações disponíveis</h2></div>
                            @forelse ($solicitacoesDisponiveis as $solicitacao)
                                <article class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                                    <h3 class="font-bold text-slate-900">{{ $solicitacao->assunto }}</h3>
                                    <p class="mt-2 line-clamp-3 text-sm leading-6 text-slate-600">{{ $solicitacao->descricao }}</p>
                                    <p class="mt-3 text-xs text-slate-500">Solicitado por {{ $solicitacao->solicitante->name ?? 'usuário' }}</p>
                                    <form method="POST" action="{{ route('tutores.solicitacoes.assumir', $solicitacao) }}" class="mt-4">
                                        @csrf
                                        <button type="submit" class="w-full rounded-lg bg-coral px-4 py-2 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-ink focus:outline-none focus:ring-2 focus:ring-coral focus:ring-offset-2">Assumir solicitação</button>
                                    </form>
                                </article>
                            @empty
                                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-5 text-sm text-slate-500">Não há solicitações compatíveis no momento.</div>
                            @endforelse
                        </div>
                    @endif
                </section>
            @endif

            <x-estatisticas-dashboard :stats="$estatisticas" />

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <x-progresso-estudo-dashboard
                        :ultimo-conteudo="$ultimoConteudo"
                        :total-conteudos="$estatisticas[0]['value']"
                    />
                    <x-conteudos-recentes-dashboard :conteudos="$conteudos" />
                </div>

                <div class="space-y-8">
                    <x-proximos-eventos-dashboard :eventos="$eventos" />
                </div>
            </div>

            <x-materiais-recentes-dashboard :materias="$materias" />
        </div>
    </div>
@endsection
