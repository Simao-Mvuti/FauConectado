@props(['event'])

<article class="p-3.5 bg-slate-50 rounded-xl border border-slate-100 flex gap-3.5 items-center">
    <div class="bg-indigo-100 text-indigo-700 p-2.5 rounded-lg text-center min-w-12.5">
        <span class="block text-xs uppercase font-bold">{{ $event->data->format('d/m') }}</span>
        <span class="block text-lg font-extrabold leading-none">{{ $event->data->format('Y') }}</span>
    </div>
    <div>
        <h3 class="font-semibold text-slate-800 text-sm">{{ $event->titulo }}</h3>
        <p class="text-xs text-slate-500 mt-0.5">{{ $event->local }}</p>
    </div>
</article>
