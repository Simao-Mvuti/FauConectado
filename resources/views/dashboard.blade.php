@extends('layout.app')
    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. SAUDAÇÃO & PESQUISA --}}
            <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm space-y-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">
                        Bom dia, {{ $user->name }} 👋
                    </h1>
                    <p class="text-slate-500 mt-1 text-sm md:text-base">
                        Veja o que está acontecendo na sua vida acadêmica.
                    </p>
                </div>

                {{-- 2. PESQUISA --}}
                <div class="relative max-w-2xl">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input 
                        type="search" 
                        placeholder="Pesquisar conteúdos, materiais, mentores, eventos..." 
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 text-sm md:text-base"
                    >
                </div>
            </div>

            {{-- 3. NOVIDADES --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-xl">🔥</span>
                    <h2 class="text-lg font-bold text-slate-800">Novidades</h2>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Card Conteúdos --}}
                    <a href="#" class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:border-indigo-300 hover:shadow-md transition-all group">
                        <div class="flex items-center gap-3">
                            <span class="p-3 bg-indigo-50 text-indigo-600 rounded-xl text-xl group-hover:scale-110 transition-transform">📚</span>
                            <div>
                                <span class="block text-xl font-bold text-slate-800">5</span>
                                <span class="text-xs md:text-sm text-slate-500 font-medium">novos conteúdos</span>
                            </div>
                        </div>
                    </a>

                    {{-- Card Materiais --}}
                    <a href="#" class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:border-blue-300 hover:shadow-md transition-all group">
                        <div class="flex items-center gap-3">
                            <span class="p-3 bg-blue-50 text-blue-600 rounded-xl text-xl group-hover:scale-110 transition-transform">📄</span>
                            <div>
                                <span class="block text-xl font-bold text-slate-800">3</span>
                                <span class="text-xs md:text-sm text-slate-500 font-medium">novos materiais</span>
                            </div>
                        </div>
                    </a>

                    {{-- Card Eventos --}}
                    <a href="#" class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:border-amber-300 hover:shadow-md transition-all group">
                        <div class="flex items-center gap-3">
                            <span class="p-3 bg-amber-50 text-amber-600 rounded-xl text-xl group-hover:scale-110 transition-transform">📢</span>
                            <div>
                                <span class="block text-xl font-bold text-slate-800">2</span>
                                <span class="text-xs md:text-sm text-slate-500 font-medium">novos eventos</span>
                            </div>
                        </div>
                    </a>

                    {{-- Card Mentores --}}
                    <a href="#" class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:border-emerald-300 hover:shadow-md transition-all group">
                        <div class="flex items-center gap-3">
                            <span class="p-3 bg-emerald-50 text-emerald-600 rounded-xl text-xl group-hover:scale-110 transition-transform">👨‍🏫</span>
                            <div>
                                <span class="block text-xl font-bold text-slate-800">3</span>
                                <span class="text-xs md:text-sm text-slate-500 font-medium">mentores disponíveis</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            {{-- GRID PRINCIPAL (DUAS COLUNAS EM TELAS GRANDES) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- COLUNA ESQUERDA / PRINCIPAL (2 Colunas no lg) --}}
                <div class="lg:col-span-2 space-y-8">
                    
                    {{-- 4. CONTINUE ESTUDANDO --}}
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-xl">📚</span>
                                <h2 class="text-lg font-bold text-slate-800">Continue estudando</h2>
                            </div>
                            <span class="text-xs font-semibold px-2.5 py-1 bg-indigo-50 text-indigo-700 rounded-full">Ativo</span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between items-baseline">
                                <h3 class="font-semibold text-slate-800 text-base">Banco de Dados</h3>
                                <span class="text-sm font-bold text-indigo-600">80%</span>
                            </div>

                            {{-- Barra de Progresso --}}
                            <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                                <div class="bg-indigo-600 h-full rounded-full transition-all duration-500" style="width: 80%"></div>
                            </div>

                            <p class="text-xs text-slate-500">
                                Último conteúdo: <span class="font-medium text-slate-700">"Índices no MySQL"</span>
                            </p>
                        </div>

                        <div class="pt-2">
                            <a href="#" class="inline-flex items-center justify-center w-full sm:w-auto px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl text-sm transition-colors duration-150">
                                Continuar estudando
                            </a>
                        </div>
                    </div>

                    {{-- 5. CONTEÚDOS RECENTES --}}
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-xl">🔥</span>
                                <h2 class="text-lg font-bold text-slate-800">Conteúdos recentes</h2>
                            </div>
                            <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Ver todos</a>
                        </div>

                        <div class="divide-y divide-slate-100">
                            @if ($conteudos->IsEmpty())
                                <p class="text-sm text-slate-500">Nenhum conteúdo recente disponível.</p>
                            @else
                                @foreach ($conteudos as  $conteudo)
                                   @foreach ($conteudos as $conteudo)
    <div class="py-3">
        <h3 class="font-semibold text-slate-800 text-sm">{{ $conteudo->titulo }}</h3>
        <p class="text-xs text-slate-500 mt-1">{{ $conteudo->conteudo }}</p>
    </div>
@endforeach
                                @endforeach
                                
                            @endif
                        </div>
                    </div>

                </div>

                {{-- COLUNA DIREITA / LATERAL (1 Coluna no lg) --}}
                <div class="space-y-8">
                    
                    {{-- 6. PRÓXIMOS EVENTOS --}}
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-xl">📢</span>
                                <h2 class="text-lg font-bold text-slate-800">Próximos eventos</h2>
                            </div>
                            <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Ver todos</a>
                        </div>

                        <div class="space-y-4">

                            @if ($eventos->IsEmpty())
                                <p class="text-sm text-slate-500">Nenhum evento próximo disponível.</p>
                            @else
                                @foreach ($eventos as $evento)
                                    <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100 flex gap-3.5 items-center">
                                        <div class="bg-indigo-100 text-indigo-700 p-2.5 rounded-lg text-center min-w-[50px]">
                                            <span class="block text-xs uppercase font-bold">{{ $evento->data }}</span>
                                            <span class="block text-lg font-extrabold leading-none">{{ $evento->hora }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-slate-800 text-sm">{{ $evento->titulo }}</h4>
                                            <p class="text-xs text-slate-500 mt-0.5">{{ $evento->local }}</p>
                                        </div>
                                    </div>
                                @endforeach   
                            @endif
                        </div>
                </div>

            </div>

            {{-- 8. MATERIAIS RECENTES --}}
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">📄</span>
                        <h2 class="text-lg font-bold text-slate-800">Materiais recentes</h2>
                    </div>
                    <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Ver todos</a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @if ($materias->IsEmpty())
                        <p class="text-sm text-slate-500">Nenhum material recente disponível.</p>
                    @else
                        @foreach ($materias as $materia)
                            <a href="#" class="p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-white hover:border-slate-300 hover:shadow-sm transition-all flex items-start gap-3">
                                <span class="text-2xl">📕</span>
                                <div>
                                    <h4 class="font-semibold text-slate-800 text-sm">{{ $materia->titulo }}</h4>
                                    <span class="inline-block mt-1 text-xs text-slate-500 bg-slate-200/60 px-2 py-0.5 rounded">{{ $materia->categoria }}</span>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
