@props([
    'title',
    'icon' => null,
    'link' => '#',
    'linkLabel' => 'Ver todos',
])

<div class="flex items-center justify-between">
    <div class="flex items-center gap-2">
        @if ($icon)
            <span class="text-xl" aria-hidden="true">{{ $icon }}</span>
        @endif
        <h2 class="text-lg font-bold text-slate-800">{{ $title }}</h2>
    </div>

    @if ($link)
        <a href="{{ $link }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">
            {{ $linkLabel }}
        </a>
    @endif
</div>
