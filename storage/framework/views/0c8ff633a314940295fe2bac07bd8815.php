<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'FauConectado'); ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Compilado via Vite -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-fcBgLight text-fcTextDark font-sans min-h-screen flex flex-col justify-between antialiased">

    <?php if (isset($component)) { $__componentOriginal3dafb3aa1b5d40b6fbe8429d03ffda90 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3dafb3aa1b5d40b6fbe8429d03ffda90 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.top-banner','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('top-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3dafb3aa1b5d40b6fbe8429d03ffda90)): ?>
<?php $attributes = $__attributesOriginal3dafb3aa1b5d40b6fbe8429d03ffda90; ?>
<?php unset($__attributesOriginal3dafb3aa1b5d40b6fbe8429d03ffda90); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3dafb3aa1b5d40b6fbe8429d03ffda90)): ?>
<?php $component = $__componentOriginal3dafb3aa1b5d40b6fbe8429d03ffda90; ?>
<?php unset($__componentOriginal3dafb3aa1b5d40b6fbe8429d03ffda90); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginala591787d01fe92c5706972626cdf7231 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala591787d01fe92c5706972626cdf7231 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $attributes = $__attributesOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__attributesOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $component = $__componentOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__componentOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>

    <main class="flex-grow py-6 sm:py-8">
        <?php echo e($slot); ?>

    </main>

    <footer class="py-4 text-center text-xs text-fcTextMuted border-t border-gray-200/60 mt-8">
        &copy; <?php echo e(date('Y')); ?> FauConectado. Plataforma colaborativa mantida pela comunidade.
    </footer>

</body>
</html><?php /**PATH /home/simao/Desktop/FauConectado/resources/views/components/layouts/app.blade.php ENDPATH**/ ?>