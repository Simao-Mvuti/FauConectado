@extends('layout.app')

@section('title', 'Candidatar-se como tutor')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
            <x-formulario-cabecalho titulo="Candidatar-se como tutor" descricao="Mostre seus conhecimentos e ajude outros estudantes." />
        <x-formulario-erros />

        @if ($candidaturaAtual && in_array($candidaturaAtual->status, ['pendente', 'aprovada'], true))
            <div class="mt-6 rounded-2xl border {{ $candidaturaAtual->status === 'aprovada' ? 'border-emerald-200 bg-emerald-50 text-emerald-800' : 'border-amber-200 bg-amber-50 text-amber-800' }} p-5">
                <p class="font-bold">Candidatura {{ $candidaturaAtual->status === 'aprovada' ? 'aprovada' : 'em análise' }}</p>
                <p class="mt-1 text-sm">{{ $candidaturaAtual->status === 'aprovada' ? 'Sua conta já pode receber solicitações de tutoria.' : 'A administração analisará seus dados. Você receberá o resultado no dashboard.' }}</p>
            </div>
        @endif

        @if (! $candidaturaAtual || $candidaturaAtual->status === 'rejeitada')
            <form action="{{ route('tutores.candidaturas.armazenar') }}" method="POST" class="mt-6 space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            <x-campo-formulario nome="area" rotulo="Área de conhecimento" placeholder="Ex.: Matemática, Design ou Programação" />
            <x-campo-formulario nome="disponibilidade" rotulo="Disponibilidade" placeholder="Ex.: Terças e quintas, das 18h às 20h" />
            <x-campo-formulario nome="experiencia" rotulo="Experiência e conhecimentos" tipo="textarea" placeholder="Conte sobre sua experiência na área..." />
            <x-botoes-formulario cancelar="dashboard" texto="Enviar candidatura" />
            </form>
        @endif
    </div>
@endsection
