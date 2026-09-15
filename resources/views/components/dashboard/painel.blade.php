@props(['class' => ''])

<section {{ $attributes->merge(['class' => "bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm $class"]) }}>
    {{ $slot }}
</section>
