@extends('layout.app')

@section('title', 'Solicitar tutor')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <x-formulario-cabecalho titulo="Solicitar tutor" descricao="Conte o que você precisa aprender e encontre apoio." icone="🎓" />
        <x-formulario-erros />

        <form action="{{ route('tutores.solicitacoes.armazenar') }}" method="POST" class="mt-6 space-y-5 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            @csrf
            <div class="space-y-1">
                <label for="mentor_id" class="block text-sm font-medium text-slate-700">Tutor de preferência <span class="font-normal text-slate-400">(opcional)</span></label>
                <select id="mentor_id" name="mentor_id" class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white text-slate-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">Qualquer tutor disponível</option>
                    @foreach ($mentores as $mentor)
                        <option value="{{ $mentor->id }}" @selected(old('mentor_id') == $mentor->id)>{{ $mentor->name }} · ⭐ {{ number_format($mentor->reputacao, 1, ',', '.') }} ({{ $mentor->total_avaliacoes }})</option>
                    @endforeach
                </select>
            </div>
            <x-campo-formulario nome="assunto" rotulo="Assunto" placeholder="Ex.: Preciso de ajuda em PHP" />
            <x-campo-formulario nome="descricao" rotulo="Descreva sua necessidade" tipo="textarea" placeholder="Explique o que deseja aprender..." />
            <x-botoes-formulario cancelar="dashboard" texto="Enviar solicitação" />
        </form>
    </div>
@endsection
