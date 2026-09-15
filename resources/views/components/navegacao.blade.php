<nav class="bg-white border-b border-slate-200 sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between min-h-16 gap-4 py-3">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 shrink-0">
                <span class="w-10 h-10 rounded-xl bg-indigo-600 text-white font-bold flex items-center justify-center text-lg shadow-md">FC</span>
                <span class="hidden sm:inline font-bold text-xl text-slate-900 tracking-tight">FauConectado</span>
            </a>

            <div class="hidden lg:flex items-center gap-1 text-sm">
                <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg font-semibold {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-100' }}">Painel</a>
                <a href="{{ route('conteudos.criar') }}" class="px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100">Publicar conteúdo</a>
                <a href="{{ route('materiais.criar') }}" class="px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100">Materiais</a>
                <a href="{{ route('eventos.criar') }}" class="px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100">Criar evento</a>
                <a href="{{ route('tutores.solicitar') }}" class="px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100">Solicitar tutor</a>
                <a href="{{ route('tutores.candidatar') }}" class="px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100">Ser tutor</a>
                <a href="{{ route('tutores.avaliar') }}" class="px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100">Avaliar tutor</a>
                @if (auth()->user()->eAdministrador())
                    <a href="{{ route('administracao.painel') }}" class="px-3 py-2 rounded-lg font-semibold text-rose-600 hover:bg-rose-50">Administração</a>
                @endif
            </div>

            <div class="flex items-center gap-3">
                <span class="hidden md:block text-sm text-slate-600">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-900">Sair</button>
                </form>
            </div>
        </div>
    </div>
</nav>
