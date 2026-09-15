@props(['material'])

<article class="p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-white hover:border-slate-300 hover:shadow-sm transition-all space-y-3">
    <div class="flex items-start gap-3">
        <span class="text-2xl" aria-hidden="true">📕</span>
        <div class="min-w-0">
            <h3 class="font-semibold text-slate-800 text-sm truncate">{{ $material->titulo }}</h3>
            <span class="inline-block mt-1 text-xs text-slate-500 bg-slate-200/60 px-2 py-0.5 rounded">{{ $material->categoria }}</span>
            <p class="text-xs text-amber-600 mt-2">⭐ {{ number_format($material->reputacao, 1, ',', '.') }} <span class="text-slate-400">({{ $material->total_avaliacoes }})</span></p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        @if ($material->arquivo)
            <a href="{{ route('materiais.baixar', $material) }}" class="inline-flex flex-1 justify-center items-center px-3 py-2 rounded-lg bg-indigo-600 text-white text-xs font-semibold hover:bg-indigo-700">
                Baixar arquivo
            </a>
        @else
            <span class="flex-1 text-xs text-slate-400">Arquivo indisponível</span>
        @endif
    </div>

    <form method="POST" action="{{ route('materiais.avaliar', $material) }}" class="flex items-center gap-2">
        @csrf
        <label for="nota-material-{{ $material->id }}" class="sr-only">Nota</label>
        <select id="nota-material-{{ $material->id }}" name="nota" required class="min-w-0 flex-1 px-2 py-2 rounded-lg border border-slate-300 bg-white text-xs">
            <option value="">Avaliar</option>
            @for ($nota = 5; $nota >= 1; $nota--)
                <option value="{{ $nota }}">{{ $nota }} estrela{{ $nota > 1 ? 's' : '' }}</option>
            @endfor
        </select>
        <button type="submit" class="px-3 py-2 rounded-lg border border-indigo-200 text-indigo-700 text-xs font-semibold hover:bg-indigo-50">Enviar</button>
    </form>
</article>
