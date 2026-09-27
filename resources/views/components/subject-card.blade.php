@props([
    'code' => '',
    'title' => '',
    'year' => '1',
    'semester' => '1',
    'materialsCount' => 0,
    'tutorsCount' => 0,
    'href' => '#'
])

<div class="bg-white rounded-2xl p-5 border border-[#dcdfd9] shadow-sm hover:shadow-md transition flex flex-col justify-between space-y-4">
    <div>
        <!-- Etiqueta do Código e Semestre -->
        <div class="flex items-center justify-between text-xs font-semibold mb-2.5">
            <span class="bg-fcGreenDark/10 text-fcGreenDark px-2.5 py-1 rounded-md uppercase tracking-wider font-bold">
                {{ $code }}
            </span>
            <span class="text-fcTextMuted">
                {{ $year }}º Ano • {{ $semester }}º Sem.
            </span>
        </div>

        <!-- Título da Cadeira -->
        <h3 class="text-base sm:text-lg font-bold text-fcGreenDark leading-snug hover:text-fcCoral transition">
            <a href="{{ $href }}">{{ $title }}</a>
        </h3>
    </div>

    <!-- Indicadores de Recursos e Tutores -->
    <div class="pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-fcTextMuted">
        <div class="flex items-center gap-3">
            <span title="Materiais disponíveis" class="flex items-center gap-1 font-medium text-fcTextDark">
                📚 <strong>{{ $materialsCount }}</strong> <span class="hidden sm:inline text-fcTextMuted">ficheiros</span>
            </span>
            <span title="Tutores disponíveis" class="flex items-center gap-1 font-medium text-fcTextDark">
                🎓 <strong>{{ $tutorsCount }}</strong> <span class="hidden sm:inline text-fcTextMuted">tutores</span>
            </span>
        </div>

        <a href="{{ $href }}" class="text-fcGreenDark font-bold hover:text-fcCoral transition flex items-center gap-1">
            Aceder →
        </a>
    </div>
</div>