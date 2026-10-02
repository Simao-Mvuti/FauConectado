<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'code' => '',
    'title' => '',
    'year' => '1',
    'semester' => '1',
    'materialsCount' => 0,
    'tutorsCount' => 0,
    'href' => '#'
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'code' => '',
    'title' => '',
    'year' => '1',
    'semester' => '1',
    'materialsCount' => 0,
    'tutorsCount' => 0,
    'href' => '#'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="bg-white rounded-2xl p-5 border border-[#dcdfd9] shadow-sm hover:shadow-md transition flex flex-col justify-between space-y-4">
    <div>
        <!-- Etiqueta do Código/ID e Semestre -->
        <div class="flex items-center justify-between text-xs font-semibold mb-2.5">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($code): ?>
                <span class="bg-fcGreenDark/10 text-fcGreenDark px-2.5 py-1 rounded-md uppercase tracking-wider font-bold">
                    <?php echo e($code); ?>

                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <span class="text-fcTextMuted">
                <?php echo e($year); ?>º Ano • <?php echo e($semester); ?>º Sem.
            </span>
        </div>

        <!-- Título do Material/Cadeira -->
        <h3 class="text-base sm:text-lg font-bold text-fcGreenDark leading-snug hover:text-fcCoral transition">
            <a href="<?php echo e($href); ?>"><?php echo e($title); ?></a>
        </h3>
    </div>

    <!-- Indicadores de Recursos e Tutores/Pontuação -->
    <div class="pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-fcTextMuted">
        <div class="flex items-center gap-3">
            <span title="Ficheiros / Votos" class="flex items-center gap-1 font-medium text-fcTextDark">
                📚 <strong><?php echo e($materialsCount); ?></strong> <span class="hidden sm:inline text-fcTextMuted">ficheiros</span>
            </span>
            <span title="Tutores / Avaliação" class="flex items-center gap-1 font-medium text-fcTextDark">
                🎓 <strong><?php echo e($tutorsCount); ?></strong> <span class="hidden sm:inline text-fcTextMuted">tutores</span>
            </span>
        </div>

        <a href="<?php echo e($href); ?>" class="text-fcGreenDark font-bold hover:text-fcCoral transition flex items-center gap-1">
            Aceder →
        </a>
    </div>
</div><?php /**PATH /home/simao/Desktop/FauConectado/resources/views/components/subject-card.blade.php ENDPATH**/ ?>