<x-dashboard.painel class="space-y-5">
    <x-dashboard.cabecalho-secao title="Materiais recentes" icon="📄" />

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        @forelse ($materias as $materia)
            <x-dashboard.item-material :material="$materia" />
        @empty
            <x-dashboard.estado-vazio message="Nenhum material recente disponível." />
        @endforelse
    </div>
</x-dashboard.painel>
