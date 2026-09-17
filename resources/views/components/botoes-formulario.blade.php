@props(['cancelar' => 'dashboard', 'texto' => 'Salvar'])

<div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">
    <a href="{{ route($cancelar) }}" class="inline-flex items-center justify-center rounded-xl border border-forest/20 px-5 py-3 text-sm font-semibold text-forest hover:bg-mint">Cancelar</a>
    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-forest px-5 py-3 text-sm font-semibold text-white hover:bg-ink">{{ $texto }}</button>
</div>
