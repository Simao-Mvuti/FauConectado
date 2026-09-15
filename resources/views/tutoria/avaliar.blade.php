@extends('layout.app')

@section('title', 'Avaliar tutor')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8 space-y-6">
        <x-formulario-cabecalho titulo="Avaliar tutores" descricao="Sua avaliação ajuda a comunidade a encontrar apoio de qualidade." icone="⭐" />
        <x-alerta type="success" :message="session('sucesso')" />
        <x-formulario-erros />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @forelse ($mentores as $mentor)
                <article class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="font-bold text-slate-800">{{ $mentor->name }}</h2>
                            <p class="text-sm text-amber-600 mt-1">⭐ {{ number_format($mentor->reputacao, 1, ',', '.') }} <span class="text-slate-400">({{ $mentor->total_avaliacoes }} avaliações)</span></p>
                        </div>
                        @if ($loop->first)
                            <span class="text-xs font-semibold text-indigo-700 bg-indigo-50 px-2 py-1 rounded-full">Mais bem avaliado</span>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('tutores.avaliacoes.armazenar') }}" class="space-y-3">
                        @csrf
                        <input type="hidden" name="avaliado_id" value="{{ $mentor->id }}">
                        <label class="block text-sm font-medium text-slate-700">Sua nota</label>
                        <select name="nota" required class="w-full px-3 py-2 rounded-lg border border-slate-300">
                            <option value="">Escolha de 1 a 5</option>
                            @for ($nota = 5; $nota >= 1; $nota--)
                                <option value="{{ $nota }}">{{ $nota }} estrela{{ $nota > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                        <textarea name="comentario" rows="2" placeholder="Comentário opcional" class="w-full px-3 py-2 rounded-lg border border-slate-300"></textarea>
                        <button class="w-full px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700">Salvar avaliação</button>
                    </form>
                </article>
            @empty
                <x-dashboard.estado-vazio message="Ainda não há tutores cadastrados." />
            @endforelse
        </div>
    </div>
@endsection
