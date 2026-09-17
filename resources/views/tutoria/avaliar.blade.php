@extends('layout.app')

@section('title', 'Avaliar tutor')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8 space-y-6">
        <x-formulario-cabecalho titulo="Avaliar tutores" descricao="Sua avaliação ajuda a comunidade a encontrar apoio de qualidade." />
        <x-alerta type="success" :message="session('sucesso')" />
        <x-formulario-erros />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @forelse ($mentores as $mentor)
                <article class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="font-bold text-slate-800">{{ $mentor->name }}</h2>
                            <p class="mt-1 text-sm text-ink/55">Nota {{ number_format($mentor->reputacao, 1, ',', '.') }} <span class="text-ink/40">({{ $mentor->total_avaliacoes }} avaliações)</span></p>
                        </div>
                        @if ($loop->first)
                            <span class="rounded-full bg-mint px-2 py-1 text-xs font-semibold text-forest">Mais bem avaliado</span>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('tutores.avaliacoes.armazenar') }}" class="space-y-3">
                        @csrf
                        <input type="hidden" name="avaliado_id" value="{{ $mentor->id }}">
                        <label class="block text-sm font-medium text-slate-700">Sua nota</label>
                        <select name="nota" required class="w-full px-3 py-2 rounded-lg border border-slate-300">
                            <option value="">Escolha de 1 a 5</option>
                            @for ($nota = 5; $nota >= 1; $nota--)
                                <option value="{{ $nota }}">{{ $nota }} ponto{{ $nota > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                        <textarea name="comentario" rows="2" placeholder="Comentário opcional" class="w-full px-3 py-2 rounded-lg border border-slate-300"></textarea>
                        <button class="w-full rounded-lg bg-forest px-4 py-2 text-sm font-semibold text-white hover:bg-ink">Salvar avaliação</button>
                    </form>
                </article>
            @empty
                <x-dashboard.estado-vazio message="Ainda não há tutores cadastrados." />
            @endforelse
        </div>
    </div>
@endsection
