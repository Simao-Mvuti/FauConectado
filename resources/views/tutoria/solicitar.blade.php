@extends('layout.app')

@section('title', 'Solicitar tutor')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <x-formulario-cabecalho titulo="Solicitar tutor" descricao="Conte o que você precisa aprender e encontre apoio." />
        <x-formulario-erros />

        <div class="mt-6 rounded-2xl border border-forest/15 bg-mint p-4 text-sm text-forest">
            Escolha um mentor específico ou envie para qualquer mentor disponível. Você poderá acompanhar o estado da solicitação no dashboard.
        </div>

        <form action="{{ route('tutores.solicitacoes.armazenar') }}" method="POST" class="mt-4 space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            <div class="space-y-1">
                <label for="mentor_id" class="block text-sm font-medium text-slate-700">Tutor de preferência <span class="font-normal text-slate-400">(opcional)</span></label>
                <select id="mentor_id" name="mentor_id" class="w-full rounded-xl border border-forest/20 bg-white px-4 py-3 text-ink outline-none focus:border-coral focus:ring-2 focus:ring-coral/20">
                    <option value="">Qualquer tutor disponível</option>
                    @foreach ($mentores as $mentor)
                        <option value="{{ $mentor->id }}" @selected(old('mentor_id') == $mentor->id)>{{ $mentor->name }} · Nota {{ number_format($mentor->reputacao, 1, ',', '.') }} ({{ $mentor->total_avaliacoes }} avaliações)</option>
                    @endforeach
                </select>
            </div>
            <x-campo-formulario nome="assunto" rotulo="Assunto" placeholder="Ex.: Preciso de ajuda em PHP" />
            <x-campo-formulario nome="descricao" rotulo="Descreva sua necessidade" tipo="textarea" placeholder="Explique o que deseja aprender..." />
            <x-botoes-formulario cancelar="dashboard" texto="Enviar solicitação" />
        </form>
    </div>
@endsection
