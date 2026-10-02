<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Matérias & Cadeiras | FauConectado']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Matérias & Cadeiras | FauConectado']); ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-6 sm:space-y-8">
        
        <!-- Cabeçalho da Página (Mobile First) -->
        <div class="space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-fcGreenDark/5 border border-fcGreenDark/10 text-[10px] sm:text-xs font-bold tracking-widest text-fcGreenDark uppercase">
                <span class="w-1.5 h-1.5 rounded-full bg-fcCoral"></span>
                EXPLORAR REPOSITÓRIO ACADÉMICO
            </div>
            
            <h1 class="text-2xl sm:text-4xl font-serif font-bold text-fcGreenDark">
                Cadeiras & Disciplinas
            </h1>
            <p class="text-xs sm:text-sm text-fcTextMuted max-w-2xl leading-relaxed">
                Escolha uma cadeira para ver os apontamentos partilhados ou entrar em contacto direto com os tutores inscritos.
            </p>
        </div>

        <!-- Barra de Pesquisa e Filtros Responsivos -->
        <div class="bg-white p-3 sm:p-4 rounded-2xl border border-[#dcdfd9] shadow-sm flex flex-col md:flex-row gap-3">
            
            <!-- Campo de Pesquisa -->
            <div class="relative flex-grow">
                <input 
                    type="text" 
                    placeholder="Pesquisar cadeira (ex: Algoritmos, Gestão, Estatística)..." 
                    class="w-full bg-fcBgLight border border-gray-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-fcGreenDark focus:ring-1 focus:ring-fcGreenDark transition"
                >
            </div>

            <!-- Filtro por Ano -->
            <div class="flex gap-2">
                <select class="w-1/2 md:w-auto bg-fcBgLight border border-gray-200 rounded-xl px-3 py-2.5 text-xs sm:text-sm text-fcTextDark focus:outline-none focus:border-fcGreenDark">
                    <option value="">Todos os Anos</option>
                    <option value="1">1º Ano</option>
                    <option value="2">2º Ano</option>
                    <option value="3">3º Ano</option>
                    <option value="4">4º Ano</option>
                </select>

                <!-- Filtro por Semestre -->
                <select class="w-1/2 md:w-auto bg-fcBgLight border border-gray-200 rounded-xl px-3 py-2.5 text-xs sm:text-sm text-fcTextDark focus:outline-none focus:border-fcGreenDark">
                    <option value="">Semestre</option>
                    <option value="1">1º Semestre</option>
                    <option value="2">2º Semestre</option>
                </select>
            </div>
        </div>

        <!-- Nota Transparente sobre Conteúdo -->
        <div class="bg-fcGreenDark/5 border border-fcGreenDark/10 rounded-xl p-3.5 flex items-start gap-3 text-xs text-fcTextDark">
            <span class="text-base shrink-0">💡</span>
            <p class="leading-relaxed">
                <strong>Nota:</strong> Os materiais são carregados colaborativamente pelos alunos. Se a tua cadeira ainda tiver poucos ficheiros ou tutores, podes ser o primeiro a contribuir ou registar-te como tutor.
            </p>
        </div>

        <!-- Grelha de Cartões (1 Coluna em Mobile, 2 em Tablet, 3 em Desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            
            <?php if (isset($component)) { $__componentOriginal563f295d2ef98d4ecc378afcc7a3f296 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal563f295d2ef98d4ecc378afcc7a3f296 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subject-card','data' => ['code' => 'INF-101','title' => 'Introdução à Programação & Algoritmos','year' => '1','semester' => '1','materialsCount' => '14','tutorsCount' => '3','href' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subject-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['code' => 'INF-101','title' => 'Introdução à Programação & Algoritmos','year' => '1','semester' => '1','materialsCount' => '14','tutorsCount' => '3','href' => '#']); ?>
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

            <?php if (isset($component)) { $__componentOriginal563f295d2ef98d4ecc378afcc7a3f296 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal563f295d2ef98d4ecc378afcc7a3f296 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subject-card','data' => ['code' => 'GES-202','title' => 'Contabilidade Geral e Financeira','year' => '1','semester' => '2','materialsCount' => '8','tutorsCount' => '2','href' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subject-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['code' => 'GES-202','title' => 'Contabilidade Geral e Financeira','year' => '1','semester' => '2','materialsCount' => '8','tutorsCount' => '2','href' => '#']); ?>
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

            <?php if (isset($component)) { $__componentOriginal563f295d2ef98d4ecc378afcc7a3f296 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal563f295d2ef98d4ecc378afcc7a3f296 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subject-card','data' => ['code' => 'MAT-105','title' => 'Análise Matemática I','year' => '1','semester' => '1','materialsCount' => '22','tutorsCount' => '5','href' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subject-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['code' => 'MAT-105','title' => 'Análise Matemática I','year' => '1','semester' => '1','materialsCount' => '22','tutorsCount' => '5','href' => '#']); ?>
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

            <?php if (isset($component)) { $__componentOriginal563f295d2ef98d4ecc378afcc7a3f296 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal563f295d2ef98d4ecc378afcc7a3f296 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subject-card','data' => ['code' => 'INF-204','title' => 'Sistemas de Gestão de Bases de Dados','year' => '2','semester' => '1','materialsCount' => '11','tutorsCount' => '1','href' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subject-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['code' => 'INF-204','title' => 'Sistemas de Gestão de Bases de Dados','year' => '2','semester' => '1','materialsCount' => '11','tutorsCount' => '1','href' => '#']); ?>
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

            <?php if (isset($component)) { $__componentOriginal563f295d2ef98d4ecc378afcc7a3f296 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal563f295d2ef98d4ecc378afcc7a3f296 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subject-card','data' => ['code' => 'GES-301','title' => 'Gestão de Projetos de Informática','year' => '3','semester' => '1','materialsCount' => '5','tutorsCount' => '0','href' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subject-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['code' => 'GES-301','title' => 'Gestão de Projetos de Informática','year' => '3','semester' => '1','materialsCount' => '5','tutorsCount' => '0','href' => '#']); ?>
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

            <?php if (isset($component)) { $__componentOriginal563f295d2ef98d4ecc378afcc7a3f296 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal563f295d2ef98d4ecc378afcc7a3f296 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subject-card','data' => ['code' => 'INF-302','title' => 'Redes de Computadores & Segurança','year' => '3','semester' => '2','materialsCount' => '9','tutorsCount' => '2','href' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subject-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['code' => 'INF-302','title' => 'Redes de Computadores & Segurança','year' => '3','semester' => '2','materialsCount' => '9','tutorsCount' => '2','href' => '#']); ?>
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
<?php endif; ?><?php /**PATH /home/simao/Desktop/FauConectado/resources/views/materias/index.blade.php ENDPATH**/ ?>