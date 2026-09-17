@props([
    'icon',
    'value',
    'label',
    'cardClass' => '',
    'iconClass' => '',
    'url' => '#',
])

<a href="{{ $url }}" class="rounded-2xl border border-forest/10 bg-white p-5 shadow-sm {{ $cardClass }} group transition hover:-translate-y-0.5 hover:shadow-soft">
    <div class="flex items-center gap-3">
        <span class="h-10 w-1 rounded-full {{ $iconClass }}" aria-hidden="true"></span>
        <div>
            <span class="block text-xl font-bold text-ink">{{ $value }}</span>
            <span class="text-xs font-medium text-ink/55 md:text-sm">{{ $label }}</span>
        </div>
    </div>
</a>
