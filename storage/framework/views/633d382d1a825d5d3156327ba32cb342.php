<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-6 sm:space-y-8">
        
        <!-- Cabeçalho -->
        <div class="space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-fcGreenDark/5 border border-fcGreenDark/10 text-[10px] sm:text-xs font-bold tracking-widest text-fcGreenDark uppercase">
                <span class="w-1.5 h-1.5 rounded-full bg-fcCoral"></span>
                EXPLORAR REPOSITÓRIO ACADÉMICO
            </div>
            
            <h1 class="text-2xl sm:text-4xl font-serif font-bold text-fcGreenDark">
                Ficheiros & Materiais de Estudo
            </h1>
            <p class="text-xs sm:text-sm text-fcTextMuted max-w-2xl leading-relaxed">
                Aceda a exames resolvidos, sebentas e resumos em PDF ou imagem partilhados pela comunidade.
            </p>
        </div>

        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div class="bg-white p-3 sm:p-4 rounded-2xl border border-[#dcdfd9] shadow-sm flex flex-col md:flex-row gap-3 flex-1">
                <div class="relative flex-grow">
                    <input 
                        wire:model.live="search"
                        type="text" 
                        placeholder="Pesquisar por título ou categoria (ex: Algoritmos, Exame, Informática)..." 
                        class="w-full bg-fcBgLight border border-gray-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-fcGreenDark focus:ring-1 focus:ring-fcGreenDark transition"
                    >
                </div>

                <div class="flex gap-2">
                    <select wire:model.live="ano" class="w-1/2 md:w-auto bg-fcBgLight border border-gray-200 rounded-xl px-3 py-2.5 text-xs sm:text-sm text-fcTextDark focus:outline-none focus:border-fcGreenDark">
                        <option value="">Todos os Anos</option>
                        <option value="1">1º Ano</option>
                        <option value="2">2º Ano</option>
                        <option value="3">3º Ano</option>
                        <option value="4">4º Ano</option>
                    </select>

                    <select wire:model.live="semestre" class="w-1/2 md:w-auto bg-fcBgLight border border-gray-200 rounded-xl px-3 py-2.5 text-xs sm:text-sm text-fcTextDark focus:outline-none focus:border-fcGreenDark">
                        <option value="">Semestre</option>
                        <option value="1">1º Semestre</option>
                        <option value="2">2º Semestre</option>
                    </select>
                </div>
            </div>

            <a href="<?php echo e(route('materias.upload')); ?>" class="inline-flex items-center justify-center rounded-full bg-[#173123] px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#12281d]">
                Submeter material
            </a>
        </div>

        <!-- Grelha Dinâmica de Cartões -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $materias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
               <?php if (isset($component)) { $__componentOriginal563f295d2ef98d4ecc378afcc7a3f296 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal563f295d2ef98d4ecc378afcc7a3f296 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subject-card','data' => ['code' => $materia->categoria ?? '#' . $materia->id,'title' => $materia->titulo,'year' => $materia->ano,'semester' => $materia->semestre,'materialsCount' => $materia->votos,'tutorsCount' => (int)$materia->pontuacao,'href' => route('materias.show', $materia->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subject-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['code' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($materia->categoria ?? '#' . $materia->id),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($materia->titulo),'year' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($materia->ano),'semester' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($materia->semestre),'materialsCount' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($materia->votos),'tutorsCount' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((int)$materia->pontuacao),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('materias.show', $materia->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal563f295d2ef98d4ecc378afcc7a3f296)): ?>
<?php $attributes = $__attributesOriginal563f295d2ef98d4ecc378afcc7a3f296; ?>
<?php unset($__attributesOriginal563f295d2ef98d4ecc378afcc7a3f296); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal563f295d2ef98d4ecc378afcc7a3f296)): ?>
<?php $component = $__componentOriginal563f295d2ef98d4ecc378afcc7a3f296; ?>
<?php unset($__componentOriginal563f295d2ef98d4ecc378afcc7a3f296); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-8 text-fcTextMuted text-sm">
                    Nenhum material encontrado com os filtros selecionados.
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

    </div>
</div><?php /**PATH /home/simao/Desktop/FauConectado/resources/views/livewire/materia-index.blade.php ENDPATH**/ ?>