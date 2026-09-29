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

        @if (session('success'))
            <div class="mb-4 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-[#173123] text-white">
                    <tr>
                        <th class="px-4 py-3">Título</th>
                        <th class="px-4 py-3">Categoria</th>
                        <th class="px-4 py-3">Ano</th>
                        <th class="px-4 py-3">Pontuação</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materiais as $materia)
                        <tr class="border-b border-gray-100">
                            <td class="px-4 py-3 font-medium text-[#173123]">{{ $materia->titulo }}</td>
                            <td class="px-4 py-3">{{ $materia->categoria ?? 'Geral' }}</td>
                            <td class="px-4 py-3">{{ $materia->ano ?? '---' }}º</td>
                            <td class="px-4 py-3">{{ number_format($materia->pontuacao ?? 0, 1) }}</td>
                            <td class="px-4 py-3">
                                @if ($materia->aprovado)
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Aprovado</span>
                                @else
                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">Pendente</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @unless ($materia->aprovado)
                                    <form method="POST" action="{{ route('admin.materiais.aprovar', $materia) }}">
                                        @csrf
                                        <button type="submit" class="rounded-full bg-[#173123] px-3 py-2 text-xs font-semibold text-white hover:bg-[#12281d]">
                                            Aprovar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400">Publicado</span>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">Nenhum material foi encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
