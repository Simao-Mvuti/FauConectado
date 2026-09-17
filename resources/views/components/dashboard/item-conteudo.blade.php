@props(['content'])

<article class="py-3 first:pt-0 last:pb-0">
    <h3 class="text-sm font-semibold text-ink">{{ $content->titulo }}</h3>
    <p class="mt-1 text-xs text-ink/55">{{ $content->conteudo }}</p>
</article>
