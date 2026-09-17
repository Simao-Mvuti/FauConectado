@props(['event'])

<article class="flex items-center gap-3.5 rounded-xl border border-forest/10 bg-mint/45 p-3.5">
    <div class="min-w-12.5 rounded-lg bg-coral/15 p-2.5 text-center text-coral">
        <span class="block text-xs uppercase font-bold">{{ $event->data->format('d/m') }}</span>
        <span class="block text-lg font-extrabold leading-none">{{ $event->data->format('Y') }}</span>
    </div>
    <div>
        <h3 class="text-sm font-semibold text-ink">{{ $event->titulo }}</h3>
        <p class="mt-0.5 text-xs text-ink/55">{{ $event->local }}</p>
    </div>
</article>
