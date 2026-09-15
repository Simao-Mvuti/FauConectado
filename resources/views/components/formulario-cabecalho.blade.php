@props(['titulo', 'descricao', 'icone' => null])

<div class="space-y-2">
    <div class="flex items-center gap-3">
        @if ($icone)
            <span class="text-3xl" aria-hidden="true">{{ $icone }}</span>
        @endif
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">{{ $titulo }}</h1>
    </div>
    <p class="text-slate-500">{{ $descricao }}</p>
</div>
