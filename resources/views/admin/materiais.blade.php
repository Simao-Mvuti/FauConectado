<x-layouts.app title="Materiais | Admin | FauConectado">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#173123]/60">Administração</p>
                <h1 class="mt-2 font-serif text-3xl font-bold text-[#173123]">Materiais</h1>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-[#173123]/20 px-4 py-2 text-sm font-semibold text-[#173123] hover:bg-[#173123]/5">
                Voltar ao painel
            </a>
        </div>

        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-[#173123] text-white">
                    <tr>
                        <th class="px-4 py-3">Título</th>
                        <th class="px-4 py-3">Categoria</th>
                        <th class="px-4 py-3">Ano</th>
                        <th class="px-4 py-3">Pontuação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materiais as $materia)
                        <tr class="border-b border-gray-100">
                            <td class="px-4 py-3 font-medium text-[#173123]">{{ $materia->titulo }}</td>
                            <td class="px-4 py-3">{{ $materia->categoria ?? 'Geral' }}</td>
                            <td class="px-4 py-3">{{ $materia->ano ?? '---' }}º</td>
                            <td class="px-4 py-3">{{ number_format($materia->pontuacao ?? 0, 1) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500">Nenhum material foi encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
