 <nav class="bg-white dark:bg-zinc-900 border-b border-slate-200 dark:border-zinc-800 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Logo e Links Primários -->
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white font-bold flex items-center justify-center text-lg shadow-md">
                            FC
                        </div>
                        <span class="font-bold text-xl text-slate-900 dark:text-white tracking-tight">FauConectado</span>
                    </a>
                    
                    <div class="hidden md:flex items-center gap-1">
                        <a href="#" class="px-3 py-2 rounded-lg text-sm font-semibold bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400">
                            <i class="fa-solid fa-chart-pie mr-2"></i>Dashboard
                        </a>
                        <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-600 dark:text-zinc-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-zinc-800 transition-all">
                            <i class="fa-solid fa-calendar-days mr-2"></i>Minhas Mentorias
                        </a>
                        <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-600 dark:text-zinc-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-zinc-800 transition-all">
                            <i class="fa-solid fa-user-group mr-2"></i>Buscar Mentores
                        </a>
                        <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-600 dark:text-zinc-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-zinc-800 transition-all">
                            <i class="fa-solid fa-comments mr-2"></i>Mensagens
                        </a>
                    </div>
                </div>

                <!-- Notificações e Perfil -->
                <div class="flex items-center gap-3">
                    <!-- Botão Notificação -->
                    <button type="button" class="relative p-2 rounded-lg text-slate-500 hover:text-slate-700 dark:text-zinc-400 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-zinc-800 transition-all">
                        <i class="fa-regular fa-bell text-xl"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-indigo-600 rounded-full ring-2 ring-white dark:ring-zinc-900"></span>
                    </button>

                    <div class="h-6 w-px bg-slate-200 dark:bg-zinc-800"></div>

                    <!-- Perfil do Usuário -->
                    <div class="flex items-center gap-3 pl-1">
                        <img class="w-9 h-9 rounded-full object-cover border border-slate-200 dark:border-zinc-700" src="https://ui-avatars.com/api/?name=Simao+Mvuti&background=4f46e5&color=fff" alt="Avatar">
                        <div class="hidden sm:block text-left">
                            <div class="text-sm font-semibold text-slate-900 dark:text-white leading-none">Simão Mvuti</div>
                            <span class="inline-block mt-0.5 text-xs font-medium text-indigo-600 dark:text-indigo-400">
                                {{ auth()->user()->role ?? 'Mentor' }}
                            </span>
                        </div>
                     <form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button type="submit" class="p-2 rounded-lg text-slate-500 hover:text-slate-700 dark:text-zinc-400 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-zinc-800 transition-all cursor-pointer">
        <span class="text-slate-900 dark:text-white font-medium">Sair</span> 
    </button>
</form>
                    </div>
                </div>

            </div>
        </div>
    </nav>
