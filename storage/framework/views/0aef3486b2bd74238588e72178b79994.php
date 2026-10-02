<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 space-y-6">
    
    <!-- Alertas Flash de Erro (caso o ficheiro não exista) -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('error')): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs sm:text-sm">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Botão de Voltar -->
    <div>
        <a href="<?php echo e(route('materias.index')); ?>" class="text-xs font-bold text-fcGreenDark hover:text-fcCoral transition inline-flex items-center gap-1">
            ← Voltar para todos os materiais
        </a>
    </div>

    <!-- Cartão Principal de Detalhes -->
    <div class="bg-white rounded-2xl p-6 border border-[#dcdfd9] shadow-sm space-y-6">
        
        <!-- Topo / Categoria e Detalhes Académicos -->
        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 pb-4">
            <span class="bg-fcGreenDark/10 text-fcGreenDark px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider">
                <?php echo e($materia->categoria); ?>

            </span>
            <span class="text-xs font-semibold text-fcTextMuted">
                <?php echo e($materia->ano); ?>º Ano • <?php echo e($materia->semestre); ?>º Semestre
            </span>
        </div>

        <!-- Título e Descrição -->
        <div class="space-y-3">
            <h1 class="text-2xl sm:text-3xl font-serif font-bold text-fcGreenDark">
                <?php echo e($materia->titulo); ?>

            </h1>
            <p class="text-sm text-fcTextMuted leading-relaxed">
                <?php echo e($materia->descricao); ?>

            </p>
        </div>

        <!-- Métricas / Avaliação -->
        <div class="flex items-center gap-6 text-xs text-fcTextMuted pt-2">
            <span class="flex items-center gap-1 font-semibold text-fcTextDark">
                ⭐ <strong><?php echo e(number_format($materia->pontuacao, 1)); ?></strong> / 5.0
            </span>
            <span class="flex items-center gap-1 font-semibold text-fcTextDark">
                🗳️ <strong><?php echo e($materia->votos); ?></strong> avaliações
            </span>
        </div>

        <!-- Ação de Download -->
        <div class="pt-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs text-fcTextMuted">
                Ficheiro: <span class="font-mono text-fcTextDark"><?php echo e(basename($materia->file)); ?></span>
            </div>

            <button 
                wire:click="download" 
                class="w-full sm:w-auto bg-fcGreenDark hover:bg-fcCoral text-white font-bold text-xs sm:text-sm px-6 py-3 rounded-xl shadow transition flex items-center justify-center gap-2"
            >
                📥 Descarregar Ficheiro
            </button>
        </div>

    </div>
</div><?php /**PATH /home/simao/Desktop/FauConectado/resources/views/livewire/materia-show.blade.php ENDPATH**/ ?>