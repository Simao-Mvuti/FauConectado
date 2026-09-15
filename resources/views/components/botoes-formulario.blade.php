@props(['cancelar' => 'dashboard', 'texto' => 'Salvar'])

<div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">
    <a href="{{ route($cancelar) }}" class="inline-flex justify-center items-center px-5 py-3 rounded-xl border border-slate-300 text-sm font-semibold text-slate-600 hover:bg-slate-50">Cancelar</a>
    <button type="submit" class="inline-flex justify-center items-center px-5 py-3 rounded-xl bg-indigo-600 text-sm font-semibold text-white hover:bg-indigo-700">{{ $texto }}</button>
</div>
