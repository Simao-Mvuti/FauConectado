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
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-600/10 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 font-bold text-xl mb-2">
                🔒
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                Recuperar Senha
            </h1>
            <p class="text-sm text-slate-500 dark:text-zinc-400">
                Digite o seu e-mail cadastrado e enviaremos as instruções para redefinir sua senha.
            </p>
        </div>

        <!-- Formulário de Recuperação -->
        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Campo de Email -->
            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                    E-mail cadastrado
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

            <!-- Botão de Enviar Link -->
            <button 
                type="submit" 
                class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900 transition-all cursor-pointer"
            >
                Enviar link de recuperação
            </button>
        </form>

        <!-- Voltar para Login -->
        <div class="pt-4 border-t border-slate-100 dark:border-zinc-800 text-center text-sm">
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 text-slate-600 dark:text-zinc-400 hover:text-slate-900 dark:hover:text-white font-medium transition-colors">
                ← Voltar para o Login
            </a>
        </div>

    </div>

</body>
</html>
