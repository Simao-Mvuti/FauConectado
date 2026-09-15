<section class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm space-y-6">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">
            Bom dia, {{ $user->name }}
        </h1>
        <p class="text-slate-500 mt-1 text-sm md:text-base">
            Veja o que está acontecendo na sua vida acadêmica.
        </p>
    </div>

    <div class="relative max-w-2xl">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <input type="search" placeholder="Pesquisar conteúdos, materiais, mentores, eventos..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 text-sm md:text-base">
    </div>
</section>
