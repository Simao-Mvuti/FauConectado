@props([
    'title',
    'icon' => null,
    'link' => '#',
    'linkLabel' => 'Ver todos',
])

<div class="flex items-center justify-between">
    <div class="flex items-center gap-3">
        <span class="h-6 w-1 rounded-full bg-coral" aria-hidden="true"></span>
        <h2 class="font-display text-lg font-bold text-ink">{{ $title }}</h2>
    </div>

    @if ($link)
        <a href="{{ $link }}" class="text-sm font-semibold text-coral hover:text-forest">
            {{ $linkLabel }}
        </a>
    @endif
</div>
