<x-layouts.app title="Admin | FauConectado">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#173123]/60">Administração</p>
                <h1 class="mt-2 font-serif text-3xl font-bold text-[#173123]">Painel Administrativo</h1>
            </div>

            <div class="inline-flex items-center gap-2 rounded-full bg-[#173123] px-4 py-2 text-sm font-medium text-white shadow-sm">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                Gestão Geral
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Utilizadores</p>
                <p class="mt-3 text-3xl font-bold text-[#173123]">{{ $stats['usuarios'] }}</p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Materiais</p>
                <p class="mt-3 text-3xl font-bold text-[#173123]">{{ $stats['materiais'] }}</p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Administradores</p>
                <p class="mt-3 text-3xl font-bold text-[#173123]">{{ $stats['administradores'] }}</p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Tutores</p>
                <p class="mt-3 text-3xl font-bold text-[#173123]">{{ $stats['tutores'] }}</p>
            </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-[1.5fr_1fr]">
            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="font-serif text-2xl font-bold text-[#173123]">Materiais recentes</h2>
                    <a href="{{ route('admin.materiais') }}" class="text-sm font-semibold text-[#173123] hover:underline">Ver tudo</a>
                </div>

                <div class="space-y-3">
                    @forelse($recentMaterials as $materia)
                        <div class="flex items-center justify-between rounded-2xl bg-[#f7f9f7] p-4">
                            <div>
                                <p class="font-semibold text-[#173123]">{{ $materia->titulo }}</p>
                                <p class="text-sm text-gray-500">{{ $materia->categoria ?? 'Sem categoria' }}</p>
                            </div>
                            <span class="rounded-full bg-[#173123]/5 px-3 py-1 text-xs font-semibold text-[#173123]">
                                {{ $materia->ano ?? '---' }}º
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Ainda não existem materiais registados.</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="font-serif text-2xl font-bold text-[#173123]">Tutores</h2>
                    <a href="{{ route('admin.tutores') }}" class="text-sm font-semibold text-[#173123] hover:underline">Ver lista</a>
                </div>

                <div class="space-y-3">
                    @forelse($pendingTutors as $user)
                        <div class="rounded-2xl bg-[#f7f9f7] p-4">
                            <p class="font-semibold text-[#173123]">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Nenhum tutor registado.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
