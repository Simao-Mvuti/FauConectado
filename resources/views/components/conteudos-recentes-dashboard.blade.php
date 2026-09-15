<x-dashboard.painel class="space-y-5">
    <x-dashboard.cabecalho-secao title="Conteúdos recentes" icon="🔥" />

    <div class="divide-y divide-slate-100">
        @forelse ($conteudos as $conteudo)
            <x-dashboard.item-conteudo :content="$conteudo" />
        @empty
            <x-dashboard.estado-vazio message="Nenhum conteúdo recente disponível." />
        @endforelse
    </div>
</x-dashboard.painel>
