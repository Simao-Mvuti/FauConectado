@extends('layout.app')

@section('title', 'Administração')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8 space-y-8">
        <x-formulario-cabecalho titulo="Central de moderação" descricao="Revise publicações antes que apareçam para toda a comunidade." icone="🛡️" />
        <x-alerta type="success" :message="session('sucesso')" />
        <x-formulario-erros />

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <x-dashboard.cartao-estatistica
                icon="⏳"
                :value="$totalPendentes"
                label="itens aguardando revisão"
                card-class="hover:border-amber-300"
                icon-class="bg-amber-50 text-amber-600"
            />
        </div>

        <section class="space-y-4">
            <x-dashboard.cabecalho-secao title="Conteúdos pendentes" icon="📚" :link="null" />
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @forelse ($conteudosPendentes as $conteudo)
                    <article class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4">
                        <div>
                            <div class="flex justify-between gap-3">
                                <h2 class="font-bold text-slate-800">{{ $conteudo->titulo }}</h2>
                                <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-2 py-1 rounded-full">Pendente</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">{{ $conteudo->categoria }} · por {{ $conteudo->autor->name ?? 'usuário removido' }}</p>
                            <p class="text-sm text-slate-600 mt-3 whitespace-pre-line">{{ $conteudo->conteudo }}</p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <form method="POST" action="{{ route('administracao.conteudos.aprovar', $conteudo) }}">
                                @csrf
                                <button class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700">Aprovar</button>
                            </form>
                            <form method="POST" action="{{ route('administracao.conteudos.rejeitar', $conteudo) }}" class="flex flex-1 gap-2 min-w-64">
                                @csrf
                                <input name="motivo_rejeicao" required placeholder="Motivo da rejeição" class="min-w-0 flex-1 px-3 py-2 rounded-lg border border-slate-300 text-sm">
                                <button class="px-4 py-2 rounded-lg bg-rose-600 text-white text-sm font-semibold hover:bg-rose-700">Rejeitar</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <x-dashboard.estado-vazio message="Nenhum conteúdo aguardando revisão." />
                @endforelse
            </div>
        </section>

        <section class="space-y-4">
            <x-dashboard.cabecalho-secao title="Materiais pendentes" icon="📄" :link="null" />
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @forelse ($materiaisPendentes as $materia)
                    <article class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4">
                        <div>
                            <div class="flex justify-between gap-3">
                                <h2 class="font-bold text-slate-800">{{ $materia->titulo }}</h2>
                                <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-2 py-1 rounded-full">Pendente</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">{{ $materia->categoria }} · por {{ $materia->autor->name ?? 'usuário removido' }}</p>
                            <p class="text-sm text-slate-600 mt-3">{{ $materia->descricao }}</p>
                            <p class="text-xs text-indigo-600 mt-2">Arquivo: {{ basename($materia->arquivo) }}</p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <form method="POST" action="{{ route('administracao.materiais.aprovar', $materia) }}">
                                @csrf
                                <button class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700">Aprovar</button>
                            </form>
                            <form method="POST" action="{{ route('administracao.materiais.rejeitar', $materia) }}" class="flex flex-1 gap-2 min-w-64">
                                @csrf
                                <input name="motivo_rejeicao" required placeholder="Motivo da rejeição" class="min-w-0 flex-1 px-3 py-2 rounded-lg border border-slate-300 text-sm">
                                <button class="px-4 py-2 rounded-lg bg-rose-600 text-white text-sm font-semibold hover:bg-rose-700">Rejeitar</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <x-dashboard.estado-vazio message="Nenhum material aguardando revisão." />
                @endforelse
            </div>
        </section>
    </div>
@endsection
