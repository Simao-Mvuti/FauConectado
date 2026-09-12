<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
      
    </head>
    
    <body class="bg-slate-50 dark:bg-zinc-950 text-slate-800 dark:text-zinc-100 flex min-h-screen flex-col items-center justify-center p-4 sm:p-6 lg:p-8 font-sans antialiased">

    <!-- Container Principal -->
    <div class="w-full max-w-md space-y-6 bg-white dark:bg-zinc-900 p-8 rounded-2xl shadow-xl border border-slate-100 dark:border-zinc-800">
        
        <!-- Cabeçalho -->
        <div class="text-center space-y-2">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-600 text-white font-bold text-xl shadow-md mb-2">
                FC
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                Crie sua conta
            </h1>
            <p class="text-sm text-slate-500 dark:text-zinc-400">
                Junte-se à comunidade de mentoria da faculdade
            </p>
        </div>

        <!-- Formulário de Cadastro -->
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nome Completo -->
            <div class="space-y-1">
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                    Nome completo
                </label>
                <input 
                    type="text" 
                    id="name"
                    name="name" 
                    placeholder="Seu nome completo" 
                    required 
                    class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                >
            </div>

            <!-- E-mail Acadêmico -->
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

            <!-- Papel na Plataforma (Mentor ou Aluno) -->
            <div class="space-y-1">
                <label for="role" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                    Eu quero ser
                </label>
                <select 
                    id="role" 
                    name="role" 
                    required
                    class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                >
                    <option value="" disabled selected>Selecione um perfil...</option>
                    <option value="mentee">Mentorando (Aluno em busca de ajuda)</option>
                    <option value="mentor">Mentor (Aluno/Professor orientador)</option>
                </select>
            </div>

            <!-- Senha -->
            <div class="space-y-1">
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                    Senha
                </label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="Mínimo de 8 caracteres" 
                    required 
                    class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                >
            </div>

            <!-- Confirmar Senha -->
            <div class="space-y-1">
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                    Confirmar senha
                </label>
                <input 
                    type="password" 
                    id="password_confirmation"
                    name="password_confirmation" 
                    placeholder="Repita a sua senha" 
                    required 
                    class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                >
            </div>

            <!-- Botão Cadastrar -->
            <button 
                type="submit" 
                class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900 transition-all cursor-pointer mt-2"
            >
                Cadastrar
            </button>
        </form>

        <!-- Link para Login -->
        <div class="pt-4 border-t border-slate-100 dark:border-zinc-800 text-center text-sm text-slate-600 dark:text-zinc-400">
            Já tem uma conta? 
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 transition-colors">
                Fazer Login
            </a>
        </div>

    </div>

</body>
</html>
