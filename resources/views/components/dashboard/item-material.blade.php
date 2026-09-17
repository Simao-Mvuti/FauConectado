@props(['material'])

<article class="space-y-3 rounded-xl border border-forest/10 bg-mint/35 p-4 transition-all hover:border-forest/30 hover:bg-white hover:shadow-sm">
    <div class="flex items-start gap-3">
        <span class="text-2xl" aria-hidden="true">📕</span>
        <div class="min-w-0">
            <h3 class="truncate text-sm font-semibold text-ink">{{ $material->titulo }}</h3>
            <span class="mt-1 inline-block rounded bg-white/70 px-2 py-0.5 text-xs text-ink/55">{{ $material->categoria }}</span>
            <p class="mt-2 text-xs text-ink/55">Nota {{ number_format($material->reputacao, 1, ',', '.') }} <span class="text-ink/40">({{ $material->total_avaliacoes }} avaliações)</span></p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        @if ($material->arquivo)
            <a href="{{ route('materiais.baixar', $material) }}" class="inline-flex flex-1 items-center justify-center rounded-lg bg-forest px-3 py-2 text-xs font-semibold text-white hover:bg-ink">
                Baixar arquivo
            </a>
        @else
            <span class="flex-1 text-xs text-ink/40">Arquivo indisponível</span>
        @endif
    </div>

    <form method="POST" action="{{ route('materiais.avaliar', $material) }}" class="flex items-center gap-2">
        @csrf
        <label for="nota-material-{{ $material->id }}" class="sr-only">Nota</label>
        <select id="nota-material-{{ $material->id }}" name="nota" required class="min-w-0 flex-1 rounded-lg border border-forest/20 bg-white px-2 py-2 text-xs">
            <option value="">Avaliar</option>
            @for ($nota = 5; $nota >= 1; $nota--)
                <option value="{{ $nota }}">{{ $nota }} estrela{{ $nota > 1 ? 's' : '' }}</option>
            @endfor
        </select>
        <button type="submit" class="rounded-lg border border-coral/30 px-3 py-2 text-xs font-semibold text-coral hover:bg-coral/10">Enviar</button>
    </form>
</article>
