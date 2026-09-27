@props([
    'variant' => 'primary',
    'href' => null
])

@php
    $baseClasses = "rounded-full font-semibold inline-flex items-center justify-center gap-2 transition shadow-sm text-center";
    
    $variants = [
        'primary' => 'bg-fcGreenDark text-white hover:bg-[#0b1d15]',
        'outline' => 'bg-white border border-[#dcdfd9] text-fcTextDark hover:bg-gray-50',
        'coral'   => 'bg-fcCoral text-white hover:bg-[#c94530]',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif