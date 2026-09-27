<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-6 sm:space-y-8">
        
        <!-- Cabeçalho -->
        <div class="space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-fcGreenDark/5 border border-fcGreenDark/10 text-[10px] sm:text-xs font-bold tracking-widest text-fcGreenDark uppercase">
                <span class="w-1.5 h-1.5 rounded-full bg-fcCoral"></span>
                EXPLORAR REPOSITÓRIO ACADÉMICO
            </div>
            
            <h1 class="text-2xl sm:text-4xl font-serif font-bold text-fcGreenDark">
                Cadeiras & Disciplinas
            </h1>
            <p class="text-xs sm:text-sm text-fcTextMuted max-w-2xl leading-relaxed">
                Escolha uma cadeira para ver os apontamentos partilhados ou entrar em contacto direto com os tutores inscritos.
            </p>
        </div>

        <!-- Barra de Pesquisa e Filtros Reativos (Livewire) -->
        <div class="bg-white p-3 sm:p-4 rounded-2xl border border-[#dcdfd9] shadow-sm flex flex-col md:flex-row gap-3">
            
            <!-- Campo de Pesquisa -->
            <div class="relative flex-grow">
                <input 
                    wire:model.live="search"
                    type="text" 
                    placeholder="Pesquisar cadeira (ex: Algoritmos, Gestão, Estatística)..." 
                    class="w-full bg-fcBgLight border border-gray-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-fcGreenDark focus:ring-1 focus:ring-fcGreenDark transition"
                >
            </div>

            <!-- Filtro por Ano -->
            <div class="flex gap-2">
                <select wire:model.live="ano" class="w-1/2 md:w-auto bg-fcBgLight border border-gray-200 rounded-xl px-3 py-2.5 text-xs sm:text-sm text-fcTextDark focus:outline-none focus:border-fcGreenDark">
                    <option value="">Todos os Anos</option>
                    <option value="1">1º Ano</option>
                    <option value="2">2º Ano</option>
                    <option value="3">3º Ano</option>
                    <option value="4">4º Ano</option>
                </select>

                <!-- Filtro por Semestre -->
                <select wire:model.live="semestre" class="w-1/2 md:w-auto bg-fcBgLight border border-gray-200 rounded-xl px-3 py-2.5 text-xs sm:text-sm text-fcTextDark focus:outline-none focus:border-fcGreenDark">
                    <option value="">Semestre</option>
                    <option value="1">1º Semestre</option>
                    <option value="2">2º Semestre</option>
                </select>
            </div>
        </div>

        <!-- Grelha Dinâmica de Cartões -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @forelse($materias as $materia)
                <x-subject-card 
                    :code="$materia->codigo"
                    :title="$materia->nome"
                    :year="$materia->ano"
                    :semester="$materia->semestre"
                    :materialsCount="$materia->materiais_count ?? 0"
                    :tutorsCount="$materia->tutores_count ?? 0"
                    :href="route('materia.show', $materia->id)"
                />
            @empty
                <div class="col-span-full text-center py-8 text-fcTextMuted text-sm">
                    Nenhuma cadeira encontrada com os filtros selecionados.
                </div>
            @endforelse
        </div>

    </div>
</div>