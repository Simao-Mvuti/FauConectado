<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Submeter material | FauConectado']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Submeter material | FauConectado']); ?>
    <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-[30px] border border-gray-200 bg-white shadow-sm">
            <div class="grid lg:grid-cols-[1fr_1.15fr]">
                <div class="bg-[#173123] p-8 text-white lg:p-10">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-white/70">Envio para aprovação</p>
                    <h1 class="mt-4 font-serif text-4xl leading-tight">Partilha um material de estudo</h1>
                    <p class="mt-4 text-white/75">
                        Envia resumos, exames, apontamentos ou fichas e aguarda a revisão da comunidade antes de ficarem visíveis no repositório.
                    </p>

                    <div class="mt-8 rounded-2xl bg-white/5 p-4">
                        <p class="font-medium text-white">✅ Regras</p>
                        <ul class="mt-3 space-y-2 text-sm text-white/75">
                            <li>• Apenas ficheiros válidos em PDF, imagens ou documentos.</li>
                            <li>• Inclui categoria, ano e semestre.</li>
                            <li>• O material fica pendente até aprovação.</li>
                        </ul>
                    </div>
                </div>

                <div class="p-6 sm:p-8 lg:p-10">
                    <form action="<?php echo e(route('materias.upload.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
                        <?php echo csrf_field(); ?>

                        <div>
                            <label for="titulo" class="mb-2 block text-sm font-medium text-[#173123]">Título</label>
                            <input id="titulo" name="titulo" type="text" required class="w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-4 py-3 text-gray-700 focus:border-[#173123] focus:outline-none focus:ring-2 focus:ring-[#173123]/10" placeholder="Ex.: Resumo de Álgebra Linear">
                        </div>

                        <div>
                            <label for="categoria" class="mb-2 block text-sm font-medium text-[#173123]">Categoria</label>
                            <input id="categoria" name="categoria" type="text" required class="w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-4 py-3 text-gray-700 focus:border-[#173123] focus:outline-none focus:ring-2 focus:ring-[#173123]/10" placeholder="Ex.: Matemática">
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="ano" class="mb-2 block text-sm font-medium text-[#173123]">Ano</label>
                                <select id="ano" name="ano" required class="w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-4 py-3 text-gray-700 focus:border-[#173123] focus:outline-none focus:ring-2 focus:ring-[#173123]/10">
                                    <option value="">Seleciona</option>
                                    <option value="1">1º Ano</option>
                                    <option value="2">2º Ano</option>
                                    <option value="3">3º Ano</option>
                                    <option value="4">4º Ano</option>
                                </select>
                            </div>

                            <div>
                                <label for="semestre" class="mb-2 block text-sm font-medium text-[#173123]">Semestre</label>
                                <select id="semestre" name="semestre" required class="w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-4 py-3 text-gray-700 focus:border-[#173123] focus:outline-none focus:ring-2 focus:ring-[#173123]/10">
                                    <option value="">Seleciona</option>
                                    <option value="1">1º Semestre</option>
                                    <option value="2">2º Semestre</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="descricao" class="mb-2 block text-sm font-medium text-[#173123]">Descrição</label>
                            <textarea id="descricao" name="descricao" rows="4" class="w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-4 py-3 text-gray-700 focus:border-[#173123] focus:outline-none focus:ring-2 focus:ring-[#173123]/10" placeholder="Descreve o conteúdo do material..."></textarea>
                        </div>

                        <div>
                            <label for="file" class="mb-2 block text-sm font-medium text-[#173123]">Ficheiro</label>
                            <input id="file" name="file" type="file" required class="block w-full rounded-2xl border border-gray-200 bg-[#f8faf8] px-3 py-3 text-sm text-gray-700 file:mr-4 file:rounded-full file:border-0 file:bg-[#173123] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-[#12281d]">
                        </div>

                        <div class="flex flex-col gap-3 pt-2 sm:flex-row">
                            <a href="<?php echo e(route('materias.index')); ?>" class="inline-flex items-center justify-center rounded-full border border-[#173123]/20 px-5 py-3 text-sm font-semibold text-[#173123] hover:bg-[#173123]/5">
                                Voltar
                            </a>
                            <button type="submit" class="inline-flex flex-1 items-center justify-center rounded-full bg-[#173123] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#12281d]">
                                Enviar para aprovação
                            </button>
                        </div>
                    </form>
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
<?php /**PATH /home/simao/Desktop/FauConectado/resources/views/materias/upload.blade.php ENDPATH**/ ?>