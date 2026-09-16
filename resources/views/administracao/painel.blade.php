@extends('layout.app')

@section('title', 'Administração')

@section('content')
    <div class="min-h-screen bg-slate-50">
        <div class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">
            <header class="rounded-3xl bg-slate-900 px-6 py-7 text-white shadow-xl shadow-slate-200 sm:px-8">
                <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <div class="max-w-2xl space-y-3">
                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-indigo-300">Área restrita</p>
                        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">Central de administração</h1>
                        <p class="text-sm leading-6 text-slate-300 sm:text-base">Modere publicações e mantenha os registros da comunidade organizados em um só lugar.</p>
                    </div>
                    <span class="inline-flex w-fit items-center gap-2 rounded-full bg-white/10 px-3 py-2 text-sm font-semibold text-slate-200">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        {{ auth()->user()->name }}
                    </span>
                </div>
            </header>

            @if (session('sucesso'))
                <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('sucesso') }}</div>
            @endif
            @if ($errors->any())
                <div role="alert" class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">{{ $errors->first() }}</div>
            @endif

            <section aria-label="Resumo da administração" class="grid grid-cols-2 gap-3 lg:grid-cols-6">
                @foreach ([['#pendencias', '⏳', $totalPendentes, 'pendentes', 'border-amber-200 bg-amber-50 text-amber-900'], ['#candidaturas', '🎓', $totalCandidaturasPendentes, 'candidaturas', 'border-emerald-200 bg-emerald-50 text-emerald-900'], ['#conteudos', '📚', $totalConteudos, 'conteúdos', 'border-indigo-100 bg-white text-slate-900'], ['#materiais', '📄', $totalMateriais, 'materiais', 'border-indigo-100 bg-white text-slate-900'], ['#eventos', '📅', $totalEventos, 'eventos', 'border-indigo-100 bg-white text-slate-900'], ['#usuarios', '👥', $totalUsuarios, 'usuários', 'border-indigo-100 bg-white text-slate-900']] as [$url, $icon, $value, $label, $classes])
                    <a href="{{ $url }}" class="rounded-2xl border p-4 transition hover:-translate-y-0.5 hover:shadow-md {{ $classes }}">
                        <span class="text-2xl" aria-hidden="true">{{ $icon }}</span>
                        <strong class="mt-3 block text-2xl">{{ $value }}</strong>
                        <span class="text-xs font-semibold opacity-75">{{ $label }}</span>
                    </a>
                @endforeach
            </section>

            <nav class="flex flex-wrap gap-2 rounded-2xl border border-slate-200 bg-white p-2 shadow-sm" aria-label="Navegação rápida">
                @foreach (['pendencias' => 'Pendências', 'candidaturas' => 'Candidaturas', 'conteudos' => 'Conteúdos', 'materiais' => 'Materiais', 'eventos' => 'Eventos', 'usuarios' => 'Usuários'] as $anchor => $label)
                    <a href="#{{ $anchor }}" class="rounded-xl px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-900">{{ $label }}</a>
                @endforeach
            </nav>

        <section id="pendencias" class="scroll-mt-24 space-y-4">
            <div class="flex items-end justify-between gap-4">
                <div><p class="text-sm font-semibold text-indigo-600">Ação recomendada</p><h2 class="text-xl font-bold text-slate-900">Itens aguardando revisão</h2></div>
                <span class="rounded-full bg-amber-100 px-3 py-1 text-sm font-bold text-amber-800">{{ $totalPendentes }}</span>
            </div>
            <p class="text-sm text-slate-500">As pendências aparecem nas listas abaixo com as ações de aprovar e rejeitar.</p>
        </section>

        <section id="candidaturas" class="scroll-mt-24 space-y-4">
            <div class="flex items-end justify-between gap-4">
                <div><p class="text-sm font-semibold text-emerald-600">Comunidade</p><h2 class="text-xl font-bold text-slate-900">Candidaturas a mentor</h2></div>
                <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-bold text-emerald-800">{{ $totalCandidaturasPendentes }} pendentes</span>
            </div>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                @forelse ($candidaturasPendentes as $candidatura)
                    <article class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div><h3 class="font-bold text-slate-900">{{ $candidatura->candidato->name ?? 'Usuário removido' }}</h3><p class="text-sm text-slate-500">{{ $candidatura->candidato->email ?? '' }} · {{ $candidatura->area }}</p></div>
                            <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-800">Pendente</span>
                        </div>
                        <p class="mt-4 text-sm leading-6 text-slate-600">{{ $candidatura->experiencia }}</p>
                        <p class="mt-3 text-xs font-semibold text-slate-500">Disponibilidade: {{ $candidatura->disponibilidade }}</p>
                        <div class="mt-4 flex flex-wrap gap-2 border-t border-slate-100 pt-4">
                            <form method="POST" action="{{ route('administracao.candidaturas.aprovar', $candidatura) }}">@csrf<button type="submit" class="rounded-lg bg-emerald-600 px-3 py-2 text-sm font-bold text-white hover:bg-emerald-700">Aprovar mentor</button></form>
                            <form method="POST" action="{{ route('administracao.candidaturas.rejeitar', $candidatura) }}" onsubmit="return confirm('Rejeitar esta candidatura?')">@csrf<button type="submit" class="rounded-lg border border-rose-200 px-3 py-2 text-sm font-bold text-rose-700 hover:bg-rose-50">Rejeitar</button></form>
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-5 py-8 text-sm text-slate-500">Nenhuma candidatura aguardando análise.</div>
                @endforelse
            </div>
        </section>

        <section id="conteudos" class="scroll-mt-24 space-y-4">
            <div class="flex items-end justify-between gap-4"><div><p class="text-sm font-semibold text-indigo-600">Biblioteca</p><h2 class="text-xl font-bold text-slate-900">Conteúdos</h2></div><span class="text-sm font-semibold text-slate-500">{{ $totalConteudos }} registros</span></div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @forelse ($conteudos as $conteudo)
                    <article class="flex flex-col justify-between gap-5 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-indigo-200 hover:shadow-md">
                        <div>
                            <div class="flex justify-between gap-3">
                                <h2 class="font-bold text-slate-800">{{ $conteudo->titulo }}</h2>
                                <span class="text-xs font-semibold {{ $conteudo->status === 'pendente' ? 'text-amber-700 bg-amber-50' : ($conteudo->status === 'aprovado' ? 'text-emerald-700 bg-emerald-50' : 'text-rose-700 bg-rose-50') }} px-2 py-1 rounded-full">{{ ucfirst($conteudo->status) }}</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">{{ $conteudo->categoria }} · por {{ $conteudo->autor->name ?? 'usuário removido' }}</p>
                                <p class="line-clamp-4 whitespace-pre-line text-sm leading-6 text-slate-600">{{ $conteudo->conteudo }}</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 border-t border-slate-100 pt-4">
                            @if ($conteudo->status === 'pendente')
                                <form method="POST" action="{{ route('administracao.conteudos.aprovar', $conteudo) }}">
                                @csrf
                                <button type="submit" class="rounded-lg bg-emerald-600 px-3 py-2 text-sm font-bold text-white hover:bg-emerald-700">Aprovar</button>
                                </form>
                                <form method="POST" action="{{ route('administracao.conteudos.rejeitar', $conteudo) }}" class="flex flex-1 gap-2 min-w-64">
                                @csrf
                                <input name="motivo_rejeicao" required placeholder="Motivo da rejeição" class="min-w-0 flex-1 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                                <button type="submit" class="rounded-lg bg-rose-600 px-3 py-2 text-sm font-bold text-white hover:bg-rose-700">Rejeitar</button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('administracao.conteudos.excluir', $conteudo) }}" onsubmit="return confirm('Excluir este conteúdo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-lg border border-rose-200 px-3 py-2 text-sm font-bold text-rose-700 hover:bg-rose-50">Excluir</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <x-dashboard.estado-vazio message="Nenhum conteúdo cadastrado." />
                @endforelse
            </div>
            {{ $conteudos->fragment('conteudos')->links() }}
        </section>

        <section id="materiais" class="scroll-mt-24 space-y-4">
            <div class="flex items-end justify-between gap-4"><div><p class="text-sm font-semibold text-indigo-600">Arquivos</p><h2 class="text-xl font-bold text-slate-900">Materiais</h2></div><span class="text-sm font-semibold text-slate-500">{{ $totalMateriais }} registros</span></div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @forelse ($materiais as $materia)
                    <article class="flex flex-col justify-between gap-5 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-indigo-200 hover:shadow-md">
                        <div>
                            <div class="flex justify-between gap-3">
                                <h2 class="font-bold text-slate-800">{{ $materia->titulo }}</h2>
                                <span class="text-xs font-semibold {{ $materia->status === 'pendente' ? 'text-amber-700 bg-amber-50' : ($materia->status === 'aprovado' ? 'text-emerald-700 bg-emerald-50' : 'text-rose-700 bg-rose-50') }} px-2 py-1 rounded-full">{{ ucfirst($materia->status) }}</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">{{ $materia->categoria }} · por {{ $materia->autor->name ?? 'usuário removido' }}</p>
                            <p class="text-sm leading-6 text-slate-600">{{ $materia->descricao }}</p>
                            <p class="text-xs font-semibold text-indigo-600">Arquivo: {{ $materia->arquivo ? basename($materia->arquivo) : 'Sem arquivo' }}</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 border-t border-slate-100 pt-4">
                            @if ($materia->status === 'pendente')
                                <form method="POST" action="{{ route('administracao.materiais.aprovar', $materia) }}">
                                @csrf
                                <button type="submit" class="rounded-lg bg-emerald-600 px-3 py-2 text-sm font-bold text-white hover:bg-emerald-700">Aprovar</button>
                                </form>
                                <form method="POST" action="{{ route('administracao.materiais.rejeitar', $materia) }}" class="flex flex-1 gap-2 min-w-64">
                                @csrf
                                <input name="motivo_rejeicao" required placeholder="Motivo da rejeição" class="min-w-0 flex-1 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                                <button type="submit" class="rounded-lg bg-rose-600 px-3 py-2 text-sm font-bold text-white hover:bg-rose-700">Rejeitar</button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('administracao.materiais.excluir', $materia) }}" onsubmit="return confirm('Excluir este material?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-lg border border-rose-200 px-3 py-2 text-sm font-bold text-rose-700 hover:bg-rose-50">Excluir</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <x-dashboard.estado-vazio message="Nenhum material cadastrado." />
                @endforelse
            </div>
            {{ $materiais->fragment('materiais')->links() }}
        </section>

        <section id="eventos" class="scroll-mt-24 space-y-4">
            <div class="flex items-end justify-between gap-4"><div><p class="text-sm font-semibold text-indigo-600">Agenda</p><h2 class="text-xl font-bold text-slate-900">Eventos</h2></div><span class="text-sm font-semibold text-slate-500">{{ $totalEventos }} registros</span></div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @forelse ($eventos as $evento)
                    <article class="flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-indigo-200 hover:shadow-md">
                        <div>
                            <h2 class="font-bold text-slate-800">{{ $evento->titulo }}</h2>
                            <p class="text-xs text-slate-500 mt-1">{{ $evento->categoria }} · {{ $evento->data?->format('d/m/Y') }} · por {{ $evento->user->name ?? 'usuário removido' }}</p>
                            <p class="line-clamp-2 text-sm leading-6 text-slate-600">{{ $evento->descricao }}</p>
                        </div>
                        <form method="POST" action="{{ route('administracao.eventos.excluir', $evento) }}" onsubmit="return confirm('Excluir este evento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg border border-rose-200 px-3 py-2 text-sm font-bold text-rose-700 hover:bg-rose-50">Excluir</button>
                        </form>
                    </article>
                @empty
                    <x-dashboard.estado-vazio message="Nenhum evento cadastrado." />
                @endforelse
            </div>
            {{ $eventos->fragment('eventos')->links() }}
        </section>

        <section id="usuarios" class="scroll-mt-24 space-y-4">
            <div class="flex items-end justify-between gap-4"><div><p class="text-sm font-semibold text-indigo-600">Acessos</p><h2 class="text-xl font-bold text-slate-900">Usuários</h2></div><span class="text-sm font-semibold text-slate-500">{{ $totalUsuarios }} registros</span></div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @forelse ($usuarios as $usuario)
                    <article class="flex items-center justify-between gap-4 border-b border-slate-100 bg-white p-4 first:rounded-t-2xl last:rounded-b-2xl last:border-b-0">
                        <div>
                            <h2 class="font-bold text-slate-800">{{ $usuario->name }}</h2>
                            <p class="text-sm text-slate-500">{{ $usuario->email }} · {{ $usuario->role === 'admin' ? 'Administrador' : 'Usuário' }}</p>
                        </div>
                        @if (!auth()->user()->is($usuario))
                            <form method="POST" action="{{ route('administracao.usuarios.excluir', $usuario) }}" onsubmit="return confirm('Excluir este usuário e os dados associados?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-lg border border-rose-200 px-3 py-2 text-sm font-bold text-rose-700 hover:bg-rose-50">Excluir usuário</button>
                            </form>
                        @endif
                    </article>
                @empty
                    <x-dashboard.estado-vazio message="Nenhum usuário cadastrado." />
                @endforelse
            </div>
            {{ $usuarios->fragment('usuarios')->links() }}
        </section>
        </div>
    </div>
@endsection
