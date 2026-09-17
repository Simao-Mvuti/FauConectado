@props(['ultimoConteudo', 'totalConteudos'])

<x-dashboard.painel class="space-y-4">
    <div class="flex items-center justify-between">
        <x-dashboard.cabecalho-secao title="Resumo de estudos" :link="null" />
        <span class="rounded-full bg-mint px-2.5 py-1 text-xs font-semibold text-forest">{{ $totalConteudos }} disponíveis</span>
    </div>

    @if ($ultimoConteudo)
        <div class="space-y-2">
            <p class="text-xs uppercase tracking-wide font-semibold text-slate-400">Conteúdo mais recente</p>
            <h3 class="font-semibold text-slate-800 text-base">{{ $ultimoConteudo->titulo }}</h3>
            <p class="text-xs text-slate-500">Categoria: <span class="font-medium text-slate-700">{{ $ultimoConteudo->categoria }}</span></p>
            <p class="text-xs text-slate-500">Publicado em {{ $ultimoConteudo->created_at->format('d/m/Y') }}</p>
        </div>
    @else
        <x-dashboard.estado-vazio message="Ainda não há conteúdos cadastrados." />
    @endif
</x-dashboard.painel>
