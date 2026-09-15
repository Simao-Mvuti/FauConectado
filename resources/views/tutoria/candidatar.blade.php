@extends('layout.app')

@section('title', 'Candidatar-se como tutor')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <x-formulario-cabecalho titulo="Candidatar-se como tutor" descricao="Mostre seus conhecimentos e ajude outros estudantes." icone="👨‍🏫" />
        <x-formulario-erros />

        <form action="{{ route('tutores.candidaturas.armazenar') }}" method="POST" class="mt-6 space-y-5 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            @csrf
            <x-campo-formulario nome="area" rotulo="Área de conhecimento" placeholder="Ex.: Matemática, Design ou Programação" />
            <x-campo-formulario nome="disponibilidade" rotulo="Disponibilidade" placeholder="Ex.: Terças e quintas, das 18h às 20h" />
            <x-campo-formulario nome="experiencia" rotulo="Experiência e conhecimentos" tipo="textarea" placeholder="Conte sobre sua experiência na área..." />
            <x-botoes-formulario cancelar="dashboard" texto="Enviar candidatura" />
        </form>
    </div>
@endsection
