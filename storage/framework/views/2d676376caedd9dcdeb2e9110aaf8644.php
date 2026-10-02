<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Materiais | Admin | FauConectado']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Materiais | Admin | FauConectado']); ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#173123]/60">Administração</p>
                <h1 class="mt-2 font-serif text-3xl font-bold text-[#173123]">Materiais</h1>
            </div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="rounded-full border border-[#173123]/20 px-4 py-2 text-sm font-semibold text-[#173123] hover:bg-[#173123]/5">
                Voltar ao painel
            </a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-4 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $materiais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-100">
                            <td class="px-4 py-3 font-medium text-[#173123]"><?php echo e($materia->titulo); ?></td>
                            <td class="px-4 py-3"><?php echo e($materia->categoria ?? 'Geral'); ?></td>
                            <td class="px-4 py-3"><?php echo e($materia->ano ?? '---'); ?>º</td>
                            <td class="px-4 py-3"><?php echo e(number_format($materia->pontuacao ?? 0, 1)); ?></td>
                            <td class="px-4 py-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($materia->aprovado): ?>
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Aprovado</span>
                                <?php else: ?>
                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">Pendente</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (! ($materia->aprovado)): ?>
                                    <form method="POST" action="<?php echo e(route('admin.materiais.aprovar', $materia)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="rounded-full bg-[#173123] px-3 py-2 text-xs font-semibold text-white hover:bg-[#12281d]">
                                            Aprovar
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-xs text-gray-400">Publicado</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">Nenhum material foi encontrado.</td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
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
<?php /**PATH /home/simao/Desktop/FauConectado/resources/views/admin/materiais.blade.php ENDPATH**/ ?>