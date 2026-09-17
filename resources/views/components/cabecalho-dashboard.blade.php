<section class="space-y-6 rounded-2xl bg-forest p-6 text-white shadow-soft md:p-8">
    <div>
        <h1 class="font-display text-2xl font-bold tracking-tight md:text-3xl">
            Bom dia, {{ $user->name }}
        </h1>
        <p class="mt-1 text-sm text-white/65 md:text-base">
            Veja o que está acontecendo na sua vida acadêmica.
        </p>
    </div>

    <form method="GET" action="{{ route('dashboard') }}" class="relative max-w-2xl">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-forest/60">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <input type="search" name="busca" value="{{ $busca ?? '' }}" placeholder="Pesquisar conteúdos, materiais, mentores, eventos..." class="w-full rounded-xl border border-white/10 bg-white px-4 py-3 pl-11 text-sm text-ink outline-none transition focus:border-coral md:text-base">
    </form>
</section>
