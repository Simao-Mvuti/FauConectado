<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Admin | FauConectado']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Admin | FauConectado']); ?>
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
                <p class="mt-3 text-3xl font-bold text-[#173123]"><?php echo e($stats['usuarios']); ?></p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Materiais</p>
                <p class="mt-3 text-3xl font-bold text-[#173123]"><?php echo e($stats['materiais']); ?></p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Administradores</p>
                <p class="mt-3 text-3xl font-bold text-[#173123]"><?php echo e($stats['administradores']); ?></p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Tutores</p>
                <p class="mt-3 text-3xl font-bold text-[#173123]"><?php echo e($stats['tutores']); ?></p>
            </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-[1.5fr_1fr]">
            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="font-serif text-2xl font-bold text-[#173123]">Materiais recentes</h2>
                    <a href="<?php echo e(route('admin.materiais')); ?>" class="text-sm font-semibold text-[#173123] hover:underline">Ver tudo</a>
                </div>

                <div class="space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex items-center justify-between rounded-2xl bg-[#f7f9f7] p-4">
                            <div>
                                <p class="font-semibold text-[#173123]"><?php echo e($materia->titulo); ?></p>
                                <p class="text-sm text-gray-500"><?php echo e($materia->categoria ?? 'Sem categoria'); ?></p>
                            </div>
                            <span class="rounded-full bg-[#173123]/5 px-3 py-1 text-xs font-semibold text-[#173123]">
                                <?php echo e($materia->ano ?? '---'); ?>º
                            </span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-sm text-gray-500">Ainda não existem materiais registados.</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="font-serif text-2xl font-bold text-[#173123]">Tutores</h2>
                    <a href="<?php echo e(route('admin.tutores')); ?>" class="text-sm font-semibold text-[#173123] hover:underline">Ver lista</a>
                </div>

                <div class="space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pendingTutors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="rounded-2xl bg-[#f7f9f7] p-4">
                            <p class="font-semibold text-[#173123]"><?php echo e($user->name); ?></p>
                            <p class="text-sm text-gray-500"><?php echo e($user->email); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-sm text-gray-500">Nenhum tutor registado.</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH /home/simao/Desktop/FauConectado/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>