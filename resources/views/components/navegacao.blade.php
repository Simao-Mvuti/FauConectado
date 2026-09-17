<nav class="sticky top-0 z-30 border-b border-forest/10 bg-paper/90 backdrop-blur-md">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex min-h-16 items-center justify-between gap-4 py-3">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-forest font-bold text-lg text-white shadow-lg shadow-forest/20">FC</span>
                <span class="hidden font-display text-xl font-bold tracking-tight text-forest sm:inline">FauConectado</span>
            </a>

            <div class="hidden lg:flex items-center gap-1 text-sm">
                <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 font-semibold {{ request()->routeIs('dashboard') ? 'bg-mint text-forest' : 'text-ink/65 hover:bg-white hover:text-forest' }}">Painel</a>
                <a href="{{ route('conteudos.criar') }}" class="rounded-lg px-3 py-2 font-medium text-ink/65 hover:bg-white hover:text-forest">Publicar conteúdo</a>
                <a href="{{ route('materiais.criar') }}" class="rounded-lg px-3 py-2 font-medium text-ink/65 hover:bg-white hover:text-forest">Materiais</a>
                <a href="{{ route('eventos.criar') }}" class="rounded-lg px-3 py-2 font-medium text-ink/65 hover:bg-white hover:text-forest">Criar evento</a>
                <a href="{{ route('tutores.solicitar') }}" class="rounded-lg px-3 py-2 font-medium text-ink/65 hover:bg-white hover:text-forest">Solicitar tutor</a>
                <a href="{{ route('tutores.candidatar') }}" class="rounded-lg px-3 py-2 font-medium text-ink/65 hover:bg-white hover:text-forest">Ser tutor</a>
                <a href="{{ route('tutores.avaliar') }}" class="rounded-lg px-3 py-2 font-medium text-ink/65 hover:bg-white hover:text-forest">Avaliar tutor</a>
                @if (auth()->user()?->eAdministrador())
                    <a href="{{ route('administracao.painel') }}" class="rounded-lg px-3 py-2 font-semibold text-coral hover:bg-coral/10">Administração</a>
                @endif
            </div>

            <details class="relative lg:hidden">
                <summary class="flex cursor-pointer list-none items-center gap-2 rounded-lg border border-forest/15 bg-white px-3 py-2 text-sm font-semibold text-forest">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Menu
                </summary>
                <div class="absolute right-0 top-12 z-40 grid w-64 gap-1 rounded-xl border border-forest/10 bg-white p-2 shadow-soft">
                    <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 text-sm font-semibold text-forest hover:bg-mint">Painel</a>
                    <a href="{{ route('conteudos.criar') }}" class="rounded-lg px-3 py-2 text-sm text-ink/70 hover:bg-mint">Publicar conteúdo</a>
                    <a href="{{ route('materiais.criar') }}" class="rounded-lg px-3 py-2 text-sm text-ink/70 hover:bg-mint">Materiais</a>
                    <a href="{{ route('eventos.criar') }}" class="rounded-lg px-3 py-2 text-sm text-ink/70 hover:bg-mint">Criar evento</a>
                    <a href="{{ route('tutores.solicitar') }}" class="rounded-lg px-3 py-2 text-sm text-ink/70 hover:bg-mint">Solicitar tutor</a>
                    <a href="{{ route('tutores.candidatar') }}" class="rounded-lg px-3 py-2 text-sm text-ink/70 hover:bg-mint">Ser tutor</a>
                    <a href="{{ route('tutores.avaliar') }}" class="rounded-lg px-3 py-2 text-sm text-ink/70 hover:bg-mint">Avaliar tutor</a>
                    @if (auth()->user()?->eAdministrador())
                        <a href="{{ route('administracao.painel') }}" class="rounded-lg px-3 py-2 text-sm font-semibold text-coral hover:bg-coral/10">Administração</a>
                    @endif
                </div>
            </details>

            <div class="flex items-center gap-3">
                <span class="hidden text-sm font-medium text-ink/65 md:block">{{ auth()->user()?->name ?? 'Visitante' }}</span>
                <span class="hidden rounded-full bg-mint px-3 py-1 text-xs font-bold text-forest sm:block">Acesso público</span>
            </div>
        </div>
    </div>
</nav>
