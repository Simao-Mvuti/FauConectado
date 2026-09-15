@props(['content'])

<article class="py-3 first:pt-0 last:pb-0">
    <h3 class="font-semibold text-slate-800 text-sm">{{ $content->titulo }}</h3>
    <p class="text-xs text-slate-500 mt-1">{{ $content->conteudo }}</p>
</article>
