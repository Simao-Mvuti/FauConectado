@extends('layout.app')

@section('title', 'Login')

@section('content')

    <x-alerta type="success" :message="session('sucesso')" />
    <x-alerta type="error" :message="session('erro')" />

    <div class="max-w-md mx-auto mt-10 p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">

        @include('components.cabecalho-login')
        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

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
                    class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white"
                >
            </div>

            <div class="space-y-1">

                <div class="flex items-center justify-between">

                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                        Senha
                    </label>

                    <a href="{{ route('password.request') }}"
                       class="text-xs text-indigo-600 font-medium">
                        Esqueceu a senha?
                    </a>

                </div>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white"
                >

            </div>

            <button
                type="submit"
                class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg">
                Entrar na Plataforma
            </button>

        </form>
        
        <footer class="pt-4 border-t border-slate-100 dark:border-zinc-800 text-center text-sm">

            Ainda não tem uma conta?

            <a href="{{ route('register') }}"
               class="font-semibold text-indigo-600">
                Criar Conta
            </a>

        </footer>

    </div>
@endsection