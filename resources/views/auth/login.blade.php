<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
      
    </head>
    
     <body class="bg-slate-50 dark:bg-zinc-950 text-slate-800 dark:text-zinc-100 flex min-h-screen flex-col items-center justify-center p-4 sm:p-6 lg:p-8 font-sans antialiased">

    <!-- Container Principal do Form -->
    <div class="w-full max-w-md space-y-6 bg-white dark:bg-zinc-900 p-8 rounded-2xl shadow-xl border border-slate-100 dark:border-zinc-800">
        
        <!-- Cabeçalho (Logo / Título) -->
        <header class="text-center space-y-2">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-600 text-white font-bold text-xl shadow-md mb-2">
                FC
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                FauConectado
            </h1>
            <p class="text-sm text-slate-500 dark:text-zinc-400">
                Acesse sua conta na plataforma de mentoria
            </p>
        </header>

        <!-- Formulário de Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf <!-- Token de segurança do Laravel -->

            <!-- Campo de Email -->
            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                    E-mail acadêmico
                </label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    placeholder="estudante@faculdade.edu" 
                    required 
                    class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                >
            </div>

            <!-- Campo de Senha -->
            <div class="space-y-1">
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                        Senha
                    </label>
                    <a href="{{ route('resetPassword') }}" class="text-xs text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 font-medium">
                        Esqueceu a senha?
                    </a>
                </div>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="••••••••" 
                    required 
                    class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                >
            </div>

            <!-- Botão de Entrar -->
            <button 
                type="submit" 
                class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900 transition-all cursor-pointer"
            >
                Entrar na Plataforma
            </button>
        </form>

        <!-- Rodapé / Link de Cadastro -->
        <footer class="pt-4 border-t border-slate-100 dark:border-zinc-800 text-center text-sm text-slate-600 dark:text-zinc-400">
        Ainda não tem uma conta? 
            <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 transition-colors">
                Criar Conta
            </a>
        </footer>

    </div>

</body>
</html>
