@extends('layout.app')

@section('title', 'Publicar conteúdo')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <x-formulario-cabecalho titulo="Publicar conteúdo" descricao="Compartilhe conhecimento com a comunidade acadêmica." />
        <x-formulario-erros />

        <form action="{{ route('conteudos.armazenar') }}" method="POST" class="mt-6 space-y-5 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            @csrf
            <x-campo-formulario nome="titulo" rotulo="Título" placeholder="Ex.: Introdução a banco de dados" />
            <x-campo-formulario nome="categoria" rotulo="Categoria" placeholder="Ex.: Tecnologia" />
            <x-campo-formulario nome="conteudo" rotulo="Conteúdo" tipo="textarea" placeholder="Escreva o conteúdo que deseja publicar..." />
            <x-botoes-formulario cancelar="dashboard" texto="Publicar conteúdo" />
        </form>
    </div>
@endsection
