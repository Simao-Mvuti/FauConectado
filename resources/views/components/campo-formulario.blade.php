@props([
    'nome',
    'rotulo',
    'tipo' => 'text',
    'placeholder' => '',
    'ajuda' => null,
])

<div class="space-y-1">
    <label for="{{ $nome }}" class="block text-sm font-medium text-ink">{{ $rotulo }}</label>

    @if ($tipo === 'textarea')
        <textarea id="{{ $nome }}" name="{{ $nome }}" rows="5" placeholder="{{ $placeholder }}" required class="w-full rounded-xl border border-forest/20 bg-white px-4 py-3 text-ink placeholder-ink/40 outline-none focus:border-coral focus:ring-2 focus:ring-coral/20">{{ old($nome) }}</textarea>
    @else
        <input id="{{ $nome }}" name="{{ $nome }}" type="{{ $tipo }}" value="{{ old($nome) }}" placeholder="{{ $placeholder }}" @required($tipo !== 'file') class="w-full rounded-xl border border-forest/20 bg-white px-4 py-3 text-ink placeholder-ink/40 outline-none focus:border-coral focus:ring-2 focus:ring-coral/20">
    @endif

    @if ($ajuda)
        <p class="text-xs text-ink/50">{{ $ajuda }}</p>
    @endif
</div>
