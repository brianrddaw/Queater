<?php $__env->startSection('title', 'User'); ?>
<?php $__env->startSection('content'); ?>
    <section class="flex flex-col items-center gap-6 mt-6 text-orange-950">
        <img class="w-64" src="<?php echo e(asset('imgs/chef.webp')); ?>" alt="">
        <h1 class="font-bold text-lg">Tu pedido se ha mandado a cocina</h1>
        <span class="flex flex-col w-fit h-full items-center gap-4 mt-6">
            <a class="min-w-fit w-44 h-14 text-center  flex items-center justify-center  bg-orange-500 rounded font-bold text-orange-50" href="/printTicket/<?php echo e($orderId); ?>/<?php echo e($tableId); ?>">Imprimir ticket</a>
            <a class="min-w-fit w-44 h-14 text-center  flex items-center justify-center  bg-orange-500 rounded font-bold text-orange-50" href="/">Volver al menu</a>
        </span>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.html-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Programación\Desktop\QUEATER\resources\views/user-views/user-payments/success.blade.php ENDPATH**/ ?>