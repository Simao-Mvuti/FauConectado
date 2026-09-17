@props(['class' => ''])

<section {{ $attributes->merge(['class' => "rounded-2xl border border-forest/10 bg-white p-6 shadow-soft $class"]) }}>
    {{ $slot }}
</section>
