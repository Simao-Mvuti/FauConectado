@extends('layout.app')

@section('title', 'Adicionar material')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <x-formulario-cabecalho titulo="Adicionar material" descricao="Envie um arquivo útil para os estudos da comunidade." />
        <x-formulario-erros />

        <form action="{{ route('materiais.armazenar') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-5 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            @csrf
            <x-campo-formulario nome="titulo" rotulo="Título" placeholder="Ex.: Guia de lógica de programação" />
            <x-campo-formulario nome="categoria" rotulo="Categoria" placeholder="Ex.: Programação" />
            <x-campo-formulario nome="descricao" rotulo="Descrição" tipo="textarea" placeholder="Explique o que o material contém..." />
            <x-campo-formulario nome="arquivo" rotulo="Arquivo" tipo="file" ajuda="PDF, Word, PowerPoint, Excel ou ZIP. Máximo de 10 MB." />
            <x-botoes-formulario cancelar="dashboard" texto="Salvar material" />
        </form>
    </div>
@endsection
