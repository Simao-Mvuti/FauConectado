@extends('layout.app')

@section('title', 'Criar evento')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <x-formulario-cabecalho titulo="Criar evento" descricao="Divulgue uma atividade acadêmica para a comunidade." icone="📢" />
        <x-formulario-erros />

        <form action="{{ route('eventos.armazenar') }}" method="POST" class="mt-6 space-y-5 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            @csrf
            <x-campo-formulario nome="titulo" rotulo="Título" placeholder="Ex.: Workshop de banco de dados" />
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <x-campo-formulario nome="data" rotulo="Data" tipo="date" />
                <x-campo-formulario nome="categoria" rotulo="Categoria" placeholder="Ex.: Workshop" />
            </div>
            <x-campo-formulario nome="local" rotulo="Local" placeholder="Ex.: Sala 12 ou link online" />
            <x-campo-formulario nome="link" rotulo="Link opcional" tipo="url" placeholder="https://..." />
            <x-campo-formulario nome="descricao" rotulo="Descrição" tipo="textarea" placeholder="Descreva o evento..." />
            <x-botoes-formulario cancelar="dashboard" texto="Criar evento" />
        </form>
    </div>
@endsection
