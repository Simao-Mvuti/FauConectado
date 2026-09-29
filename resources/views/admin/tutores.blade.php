<x-layouts.app title="Tutores | Admin | FauConectado">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#173123]/60">Administração</p>
                <h1 class="mt-2 font-serif text-3xl font-bold text-[#173123]">Tutores</h1>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-[#173123]/20 px-4 py-2 text-sm font-semibold text-[#173123] hover:bg-[#173123]/5">
                Voltar ao painel
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse($tutores as $tutor)
                <div class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#173123] text-lg font-bold text-white">
                            {{ strtoupper(substr($tutor->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-[#173123]">{{ $tutor->name }}</p>
                            <p class="text-sm text-gray-500">{{ $tutor->email }}</p>
                        </div>
                    </div>
                    <div class="mt-4 rounded-2xl bg-[#f7f9f7] p-3 text-sm text-gray-600">
                        Membro da comunidade de apoio académico.
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-gray-300 bg-white p-10 text-center text-gray-500">
                    Nenhum tutor disponível.
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
