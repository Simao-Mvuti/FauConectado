@props([
    'icon',
    'value',
    'label',
    'cardClass' => '',
    'iconClass' => '',
    'url' => '#',
])

<a href="{{ $url }}" class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm {{ $cardClass }} hover:shadow-md transition-all group">
    <div class="flex items-center gap-3">
        <span class="p-3 {{ $iconClass }} rounded-xl text-xl group-hover:scale-110 transition-transform" aria-hidden="true">{{ $icon }}</span>
        <div>
            <span class="block text-xl font-bold text-slate-800">{{ $value }}</span>
            <span class="text-xs md:text-sm text-slate-500 font-medium">{{ $label }}</span>
        </div>
    </div>
</a>
