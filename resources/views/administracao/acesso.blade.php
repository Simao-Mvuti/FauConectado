@extends('layout.app')

@section('title', 'Acesso administrativo')

@section('content')
    <div class="flex min-h-[70vh] items-center justify-center px-4 py-12">
        <div class="w-full max-w-md rounded-2xl border border-forest/10 bg-white p-6 shadow-soft sm:p-8">
            <div class="mb-8 space-y-3">
                <span class="block h-8 w-1 rounded-full bg-coral" aria-hidden="true"></span>
                <h1 class="font-display text-3xl font-bold text-ink">Acesso administrativo</h1>
                <p class="text-sm leading-6 text-ink/60">Use a chave definida no ambiente de produção para abrir a central de gestão.</p>
            </div>

            @if ($errors->any())
                <div role="alert" class="mb-5 rounded-xl border border-coral/20 bg-coral/10 px-4 py-3 text-sm text-ink">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('administracao.autenticar') }}" class="space-y-5">
                @csrf
                <div class="space-y-2">
                    <label for="chave" class="block text-sm font-semibold text-ink">Chave administrativa</label>
                    <input id="chave" name="chave" type="password" required autofocus class="w-full rounded-xl border border-forest/20 bg-white px-4 py-3 text-ink outline-none focus:border-coral focus:ring-2 focus:ring-coral/20">
                </div>
                <button type="submit" class="w-full rounded-xl bg-forest px-5 py-3 text-sm font-semibold text-white transition hover:bg-ink focus:outline-none focus:ring-2 focus:ring-coral focus:ring-offset-2">Entrar na central</button>
            </form>
        </div>
    </div>
@endsection
