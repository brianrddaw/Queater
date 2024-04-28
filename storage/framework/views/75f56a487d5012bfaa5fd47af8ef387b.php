<?php $__env->startSection('title', 'User'); ?>
<?php $__env->startSection('content'); ?>

    <main class="flex flex-col w-full h-[calc(100vh-3.5rem)] place-content-center justify-evenly items-center">

        <section class="w-full h-fit flex flex-col justify-center items-center">
            <img class="w-64  mr-6" src="<?php echo e(asset('imgs/plato-main.webp')); ?>" alt="">

            <div
                role="heading"
                aria-label="Sección de bienvenida a Queater"
                class="
                flex flex-col
                justify-center
                items-center
                text-orange-950
                py-4
                "
                >
                <h2 class="font-bold text-2xl">Bienvenido a Queater</h2>
                <p class="text-lg">¿Cómo deseas tu comida?</p>
            </div>
        </section>

        <section class="w-fit h-fit flex flex-col justify-center items-center gap-4">
            <a href="<?php echo e(route('eat-here.main', ['mesa' => 1])); ?>"
                class="
                    flex flex-col
                    justify-center
                    items-center
                    p-5
                    bg-orange-500
                    rounded
                    w-fit
                    min-w-52
                    active:scale-105
                    active:bg-orange-400
                    hover:cursor-pointer
                    drop-shadow-lg"
            >
                <b class="font-sans text-white">Para comer aquí</b>
            </a>
            <a href="<?php echo e(route('take-away.main')); ?>"
                class="
                    flex flex-col
                    justify-center
                    items-center
                    p-5
                    bg-orange-500
                    rounded
                    w-fit
                    min-w-52
                    active:scale-105
                    active:bg-orange-400
                    hover:cursor-pointer
                    drop-shadow-lg"
            >
                <b class="font-sans text-white">Para llevar</b>
            </a>

        </section>

    </main>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.html-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Programación\Desktop\QUEATER\resources\views/user-views/main.blade.php ENDPATH**/ ?>