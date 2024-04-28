<?php $__env->startSection('title', 'User'); ?>
<?php $__env->startSection('content'); ?>
    <section class="flex flex-col gap-10 w-[100vw] h-[calc(100vh-3.5rem)] p-20 text-orange-800 bg-slate-200">
        <span class="flex flex-col gap-8">
            <h1 class="font-bold lg:text-7xl xs:text-3xl">¡Bienvenido a Queater!</h1>
            <h2 class="font-bold lg:text-3xl text-justify">Tu nueva manera de atender a los clientes</h2>
        </span>
        <div class="flex flex-col w-fit h-fit justify-left items-start gap-6 mt-14">

            <p class="font-bold lg:text-3xl ">Tan fácil como escanear y pedir</p>

            <div class="svg-container flex relative md:w-[30rem] h-fit p-4 bg-orange-50 rounded shadow-5 text-orange-800 sm:w-[20rem]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>

                <svg width="180" height="180" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 3H3V9H5V5H9V3ZM3 21V15H5V19H9V21H3ZM15 3V5H19V9H21V3H15ZM19 15H21V21H15V19H19V15ZM7 7H11V11H7V7ZM7 13H11V17H7V13ZM17 7H13V11H17V7ZM13 13H17V17H13V13Z" fill="currentColor" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5468 3.67162C20.1563 3.28109 19.5231 3.28109 19.1326 3.67162L13.7687 9.03555H2V11.0356H2.00842C2.22563 16.3663 6.61591 20.6213 12 20.6213C17.3841 20.6213 21.7744 16.3663 21.9916 11.0356H22V9.03555H16.5971L20.5468 5.08583C20.9374 4.69531 20.9374 4.06214 20.5468 3.67162ZM14.1762 11.0356C14.1806 11.0356 14.1851 11.0356 14.1896 11.0356H19.9895C19.7739 15.2613 16.2793 18.6213 12 18.6213C7.72066 18.6213 4.22609 15.2613 4.01054 11.0356H14.1762Z" fill="currentColor" />
                </svg>
            </div>
        </div>
        <img class="absolute bottom-0 right-0 drop-shadow-xl w-[1000px] md:w-[20rem] xs:hidden md:block xl:w-[50rem] z-0" src="<?php echo e(asset('imgs/chef-landpage.webp ')); ?>" alt="">
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.html-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u272775609/domains/queater.com/resources/views/land-page/land-page.blade.php ENDPATH**/ ?>