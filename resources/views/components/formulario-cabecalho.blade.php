@props(['titulo', 'descricao', 'icone' => null])

<div class="space-y-2">
    <div class="flex items-center gap-3">
        <span class="h-8 w-1 rounded-full bg-coral" aria-hidden="true"></span>
        <h1 class="font-display text-2xl font-bold tracking-tight text-ink">{{ $titulo }}</h1>
    </div>
    <p class="text-ink/60">{{ $descricao }}</p>
</div>
