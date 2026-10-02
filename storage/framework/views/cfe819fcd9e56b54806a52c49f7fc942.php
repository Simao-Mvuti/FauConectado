<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['icon', 'title', 'description']));

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

foreach (array_filter((['icon', 'title', 'description']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-start gap-3 sm:gap-4 hover:bg-white/10 transition">
    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-white/10 text-white flex items-center justify-center font-bold text-base sm:text-lg shrink-0">
        <?php echo e($icon); ?>

    </div>
    <div>
        <h4 class="font-bold text-xs sm:text-sm text-white"><?php echo e($title); ?></h4>
        <p class="text-xs text-white/70 mt-0.5 leading-relaxed"><?php echo e($description); ?></p>
    </div>
</div><?php /**PATH /home/simao/Desktop/FauConectado/resources/views/components/feature-card.blade.php ENDPATH**/ ?>