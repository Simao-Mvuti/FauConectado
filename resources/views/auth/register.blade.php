@extends('layout.app')

@section('title', 'Cadastro')

@section('content')

<x-alerta type="success" :message="session('sucesso')" />
<x-alerta type="error" :message="session('erro')" />

<div class="w-full max-w-md mx-auto mt-10 space-y-6 bg-white dark:bg-zinc-900 p-8 rounded-2xl shadow-xl border border-slate-100 dark:border-zinc-800">

    @include('components.cabecalho-login')

    <form action="{{ route('register.post') }}" method="POST" class="space-y-4">

        @csrf

        {{-- Nome --}}
        <div class="space-y-1">

            <label
                for="name"
                class="block text-sm font-medium text-slate-700 dark:text-zinc-300"
            >
                Nome completo
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Seu nome completo"
                required
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
            >

        </div>

        {{-- E-mail --}}
        <div class="space-y-1">

            <label
                for="email"
                class="block text-sm font-medium text-slate-700 dark:text-zinc-300"
            >
                E-mail acadêmico
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="estudante@faculdade.edu"
                required
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
            >

        </div>

        <div class="rounded-lg border border-indigo-100 bg-indigo-50 px-4 py-3 text-sm text-indigo-800">
            Você começará como mentorando. Depois do cadastro, poderá enviar uma candidatura para se tornar mentor.
        </div>

        {{-- Senha --}}
        <div class="space-y-1">

            <label
                for="password"
                class="block text-sm font-medium text-slate-700 dark:text-zinc-300"
            >
                Senha
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Mínimo de 6 caracteres"
                required
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
            >

        </div>

        {{-- Confirmar senha --}}
        <div class="space-y-1">

            <label
                for="password_confirmation"
                class="block text-sm font-medium text-slate-700 dark:text-zinc-300"
            >
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

        {{-- Botão --}}
        <button
            type="submit"
            class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900 transition-all cursor-pointer"
        >
            Cadastrar
        </button>

    </form>

    {{-- Login --}}
    <div class="pt-4 border-t border-slate-100 dark:border-zinc-800 text-center text-sm text-slate-600 dark:text-zinc-400">

        Já tem uma conta?

        <a
            href="{{ route('login') }}"
            class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 transition-colors"
        >
            Fazer Login
        </a>

    </div>

</div>

@endsection
