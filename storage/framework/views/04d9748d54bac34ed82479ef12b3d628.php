<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-serif text-2xl font-bold text-[#173123] leading-tight">
            <?php echo e(__('Painel de Controle')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <!-- Fundo off-white inspirado na landing page -->
    <div class="py-12 bg-[#f9faf7] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Cartão de Boas-vindas Principal (Inspirado no bloco verde escuro) -->
            <div class="bg-[#173123] overflow-hidden shadow-xl sm:rounded-3xl">
                <div class="p-8 sm:p-12 text-white flex flex-col md:flex-row justify-between items-center gap-8">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 mb-6 text-xs font-semibold tracking-wider text-[#173123] uppercase bg-white rounded-full">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            Área do Estudante
                        </div>
                        <h3 class="font-serif text-4xl mb-3">
                            Olá, <?php echo e(auth()->user()->name ?? 'Estudante'); ?>! 👋
                        </h3>
                        <p class="text-gray-300 text-lg max-w-xl">
                            Pronto para aprender, partilhar e conectar-se hoje? Explore os materiais mais recentes e contacte mentores da comunidade.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <!-- Botão com estilo pílula igual ao "Explorar Conteúdos" da imagem, mas com cores invertidas -->
                        <a href="#" class="inline-flex items-center px-8 py-3 bg-white text-[#173123] font-semibold rounded-full hover:bg-gray-100 transition-colors shadow-sm">
                            Explorar Conteúdos &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- Grade de Ações Rápidas (Estilo dos cartões cinzas/claros) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Ação 1: Materiais -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-[1.25rem] border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-[#f3f5f2] text-[#173123] rounded-xl flex items-center justify-center text-2xl">
                            📁
                        </div>
                        <h4 class="font-serif text-xl font-bold text-[#173123]">Materiais</h4>
                    </div>
                    <p class="text-gray-600 text-sm mb-5 leading-relaxed">
                        Aceda aos apontamentos e exames resolvidos guardados ou partilhe novos conteúdos.
                    </p>
                    <a href="#" class="text-sm font-semibold text-[#173123] hover:underline flex items-center gap-1">
                        Ver repositório &rarr;
                    </a>
                </div>

                <!-- Ação 2: Tutores -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-[1.25rem] border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-[#f3f5f2] text-[#173123] rounded-xl flex items-center justify-center text-2xl">
                            🎓
                        </div>
                        <h4 class="font-serif text-xl font-bold text-[#173123]">Tutores</h4>
                    </div>
                    <p class="text-gray-600 text-sm mb-5 leading-relaxed">
                        Gira as suas sessões de mentoria, veja requisitos e contacte alunos mais experientes.
                    </p>
                    <a href="#" class="text-sm font-semibold text-[#173123] hover:underline flex items-center gap-1">
                        Contactar mentores &rarr;
                    </a>
                </div>

                <!-- Ação 3: Comunidade/Manutenção -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-[1.25rem] border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-[#f3f5f2] text-[#173123] rounded-xl flex items-center justify-center text-2xl">
                            ⚡
                        </div>
                        <h4 class="font-serif text-xl font-bold text-[#173123]">Comunidade</h4>
                    </div>
                    <p class="text-gray-600 text-sm mb-5 leading-relaxed">
                        Acompanhe o estado dos servidores e veja como pode contribuir voluntariamente.
                    </p>
                    <a href="#" class="text-sm font-semibold text-orange-600 hover:underline flex items-center gap-1">
                        Apoiar o projeto &rarr;
                    </a>
                </div>
            </div>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/simao/Desktop/FauConectado/resources/views/dashboard.blade.php ENDPATH**/ ?>