@props([
    'nome',
    'rotulo',
    'tipo' => 'text',
    'placeholder' => '',
    'ajuda' => null,
])

<div class="space-y-1">
    <label for="{{ $nome }}" class="block text-sm font-medium text-slate-700">{{ $rotulo }}</label>

    @if ($tipo === 'textarea')
        <textarea id="{{ $nome }}" name="{{ $nome }}" rows="5" placeholder="{{ $placeholder }}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old($nome) }}</textarea>
    @else
        <input id="{{ $nome }}" name="{{ $nome }}" type="{{ $tipo }}" value="{{ old($nome) }}" placeholder="{{ $placeholder }}" @required($tipo !== 'file') class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
    @endif

    @if ($ajuda)
        <p class="text-xs text-slate-500">{{ $ajuda }}</p>
    @endif
</div>
