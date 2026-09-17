<x-dashboard.painel class="space-y-5">
    <x-dashboard.cabecalho-secao title="Próximos eventos" />

    <div class="space-y-4">
        @forelse ($eventos as $evento)
            <x-dashboard.item-evento :event="$evento" />
        @empty
            <x-dashboard.estado-vazio message="Nenhum evento próximo disponível." />
        @endforelse
    </div>
</x-dashboard.painel>
