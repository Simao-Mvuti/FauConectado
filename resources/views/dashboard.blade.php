<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
      
   
    <script>
        tailwind.config = {
            darkMode: 'media',
            theme: {
                extend: {
                    colors: {
                        indigo: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                        }
                    }
                }
            }
        }
    </script>
     </head>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full text-slate-800 dark:text-zinc-100 antialiased flex flex-col">

    <!-- Navbar Superior -->
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
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- Banner de Boas-Vindas -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-600 to-indigo-800 p-6 sm:p-8 text-white shadow-lg">
            <div class="relative z-10 max-w-2xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white/10 backdrop-blur-md text-indigo-100 mb-3 border border-white/20">
                    <i class="fa-solid fa-sparkles text-amber-300"></i> Semestre Letivo 2026.2
                </span>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
                    Bem-vindo de volta, {{ auth()->user()->name ?? 'Simão' }}! 👋
                </h1>
                <p class="mt-2 text-indigo-100 text-sm sm:text-base leading-relaxed">
                    Sua próxima sessão de mentoria é hoje às <strong class="text-white font-semibold">15:30</strong>. Não se esqueça de revisar os tópicos de estudo.
                </p>
                
                <div class="mt-5 flex flex-wrap gap-3">
                    <a href="#" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-white text-indigo-600 hover:bg-indigo-50 font-semibold text-sm shadow-sm transition-all">
                        <i class="fa-solid fa-plus mr-2"></i> Solicitar Mentoria
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-indigo-700/60 hover:bg-indigo-700 text-white font-semibold text-sm border border-white/20 transition-all">
                        <i class="fa-regular fa-calendar-plus mr-2"></i> Agendar Horário
                    </a>
                </div>
            </div>

            <!-- Círculos decorativos no fundo -->
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute right-40 -top-10 w-48 h-48 bg-indigo-400/20 rounded-full blur-xl pointer-events-none"></div>
        </div>

        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-zinc-900 p-5 rounded-2xl border border-slate-200/80 dark:border-zinc-800 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-zinc-400 uppercase tracking-wider">Mentorias Ativas</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">4</h3>
                    <span class="inline-flex items-center text-xs font-medium text-emerald-600 dark:text-emerald-400 mt-1">
                        <i class="fa-solid fa-arrow-up mr-1"></i> +1 este mês
                    </span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-zinc-900 p-5 rounded-2xl border border-slate-200/80 dark:border-zinc-800 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-zinc-400 uppercase tracking-wider">Horas Concluídas</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">18h</h3>
                    <span class="inline-flex items-center text-xs font-medium text-emerald-600 dark:text-emerald-400 mt-1">
                        <i class="fa-solid fa-clock mr-1"></i> Total acumulado
                    </span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-stopwatch"></i>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-zinc-900 p-5 rounded-2xl border border-slate-200/80 dark:border-zinc-800 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-zinc-400 uppercase tracking-wider">Próximas Sessões</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">2</h3>
                    <span class="inline-flex items-center text-xs font-medium text-indigo-600 dark:text-indigo-400 mt-1">
                        <i class="fa-regular fa-calendar mr-1"></i> Esta semana
                    </span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-video"></i>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white dark:bg-zinc-900 p-5 rounded-2xl border border-slate-200/80 dark:border-zinc-800 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-zinc-400 uppercase tracking-wider">Avaliação Média</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">4.9 / 5</h3>
                    <span class="inline-flex items-center text-xs font-medium text-amber-500 mt-1">
                        <i class="fa-solid fa-star mr-1"></i> 12 avaliações
                    </span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-500 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
        </div>

        <!-- Seção Principal de Conteúdo Grid 2/3 e 1/3 -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Coluna Principal (2/3): Próximas Sessões & Atividades -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Lista de Próximas Sessões -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200/80 dark:border-zinc-800 p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white">Próximas Sessões</h2>
                            <p class="text-xs text-slate-500 dark:text-zinc-400">Sua agenda de encontros marcados</p>
                        </div>
                        <a href="#" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">Ver todas</a>
                    </div>

                    <div class="space-y-4">
                        <!-- Item de Sessão 1 -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 rounded-xl bg-slate-50 dark:bg-zinc-800/50 border border-slate-100 dark:border-zinc-800/80 gap-4">
                            <div class="flex items-center gap-3.5">
                                <img class="w-11 h-11 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Carlos+Eduardo&background=0D9488&color=fff" alt="Carlos">
                                <div>
                                    <h4 class="font-semibold text-slate-900 dark:text-white text-sm">Estruturas de Dados e Algoritmos</h4>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">Mentor: Prof. Carlos Eduardo</p>
                                    <div class="flex items-center gap-2 mt-1 text-xs text-indigo-600 dark:text-indigo-400 font-medium">
                                        <span><i class="fa-regular fa-clock mr-1"></i> Hoje, 15:30 (45 min)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full sm:w-auto flex items-center gap-2">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">Confirmada</span>
                                <a href="#" class="px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-sm transition-all ml-auto sm:ml-0">
                                    Entrar na Sala
                                </a>
                            </div>
                        </div>

                        <!-- Item de Sessão 2 -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 rounded-xl bg-slate-50 dark:bg-zinc-800/50 border border-slate-100 dark:border-zinc-800/80 gap-4">
                            <div class="flex items-center gap-3.5">
                                <img class="w-11 h-11 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Ana+Silva&background=D97706&color=fff" alt="Ana">
                                <div>
                                    <h4 class="font-semibold text-slate-900 dark:text-white text-sm">Desenvolvimento Web com Laravel</h4>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">Mentorando: Ana Silva</p>
                                    <div class="flex items-center gap-2 mt-1 text-xs text-slate-500 dark:text-zinc-400">
                                        <span><i class="fa-regular fa-clock mr-1"></i> Amanhã, 10:00 (1h)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full sm:w-auto flex items-center gap-2">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800">Pendente</span>
                                <a href="#" class="px-3 py-1.5 rounded-lg border border-slate-300 dark:border-zinc-700 text-slate-700 dark:text-zinc-300 text-xs font-semibold hover:bg-slate-100 dark:hover:bg-zinc-800 transition-all ml-auto sm:ml-0">
                                    Detalhes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tópicos Recomendados / Recursos -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200/80 dark:border-zinc-800 p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Áreas de Conhecimento em Alta</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl border border-slate-200 dark:border-zinc-800 hover:border-indigo-500 dark:hover:border-indigo-500 transition-all cursor-pointer group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-lg">
                                    <i class="fa-solid fa-code"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-sm text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">Programação & Web</h3>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">14 Mentores disponíveis</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl border border-slate-200 dark:border-zinc-800 hover:border-indigo-500 dark:hover:border-indigo-500 transition-all cursor-pointer group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center text-lg">
                                    <i class="fa-solid fa-database"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-sm text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">Banco de Dados</h3>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">8 Mentores disponíveis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Coluna Lateral (1/3): Solicitações Pendentes & Mentores Recomendados -->
            <div class="space-y-8">

                <!-- Solicitações Pendentes -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200/80 dark:border-zinc-800 p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Solicitações de Mentoria</h2>
                    <p class="text-xs text-slate-500 dark:text-zinc-400 mb-4">Pedidos aguardando sua aprovação</p>

                    <div class="space-y-4">
                        <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-zinc-800/50 border border-slate-100 dark:border-zinc-800">
                            <div class="flex items-center gap-3">
                                <img class="w-10 h-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Lucas+Mendes&background=2563EB&color=fff" alt="Lucas">
                                <div>
                                    <h4 class="font-semibold text-sm text-slate-900 dark:text-white">Lucas Mendes</h4>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">Engenharia de Software • 3º Ano</p>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-slate-600 dark:text-zinc-300 italic">
                                "Gostaria de tirar dúvidas sobre arquitetura de software no Laravel..."
                            </p>
                            <div class="mt-3 flex gap-2">
                                <button type="button" class="flex-1 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-xs font-semibold transition-all">
                                    Aceitar
                                </button>
                                <button type="button" class="flex-1 py-1.5 bg-slate-200 dark:bg-zinc-700 hover:bg-slate-300 dark:hover:bg-zinc-600 text-slate-700 dark:text-zinc-200 rounded-lg text-xs font-semibold transition-all">
                                    Recusar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mentores em Destaque -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200/80 dark:border-zinc-800 p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Mentores em Destaque</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img class="w-10 h-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Mariana+Costa&background=E11D48&color=fff" alt="Mariana">
                                <div>
                                    <h4 class="font-semibold text-sm text-slate-900 dark:text-white">Profª. Mariana Costa</h4>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">Inteligência Artificial</p>
                                </div>
                            </div>
                            <button type="button" class="text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 p-2 rounded-lg text-sm transition-all">
                                <i class="fa-regular fa-paper-plane"></i>
                            </button>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img class="w-10 h-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Felipe+Rocha&background=059669&color=fff" alt="Felipe">
                                <div>
                                    <h4 class="font-semibold text-sm text-slate-900 dark:text-white">Felipe Rocha</h4>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">DevOps & Cloud</p>
                                </div>
                            </div>
                            <button type="button" class="text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 p-2 rounded-lg text-sm transition-all">
                                <i class="fa-regular fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <!-- Rodapé -->
    <footer class="mt-auto bg-white dark:bg-zinc-900 border-t border-slate-200 dark:border-zinc-800 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500 dark:text-zinc-400">
            <p>© 2026 FauConectado - Plataforma Acadêmica de Mentoria.</p>
            <div class="flex gap-4">
                <a href="#" class="hover:underline">Termos de Uso</a>
                <a href="#" class="hover:underline">Privacidade</a>
                <a href="#" class="hover:underline">Suporte</a>
            </div>
        </div>
    </footer>

</body>


</body>
</html>
