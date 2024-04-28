<?php $__env->startSection('title', 'Cash'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('navegacion'); ?>
    <a href="<?php echo e(route('dashboard.main')); ?>">dasboard</a>
    <a href="<?php echo e(route('kitchen.main')); ?>">kitchen</a>
<?php $__env->stopSection(); ?>

    <main class="w-full h-full min-h-[calc(100vh-3.5rem)] p-4  flex flex-col gap-6">

        <section class="w-full h-fit flex flex-wrap flex-col gap-4">

            <div class="all-orders-container flex w-full gap-10">

                <ul class="flex flex-col gap-4 select-none text-orange-950 w-full h-[75vh] bg-stone-200 p-4 rounded overflow-y-scroll">
                    <h2 class="text-2xl font-bold bg-orange-950 text-orange-50 w-fit h-fit p-4 rounded">Pedidos para llevar</h2>
                    <?php $__currentLoopData = $takeAwayOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $takeAwayOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                            <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-orange-500 text-orange-50">
                                <div>
                                    <strong>Pedido: </strong>
                                    <?php echo e($takeAwayOrder['id']); ?>

                                </div>
                                <div>
                                    <strong><?php echo e($takeAwayOrder['take_away'] ? 'Para llevar' : 'Mesa: ' . $takeAwayOrder['table_id']); ?></strong>
                                </div>
                                <p><?php echo e(\Carbon\Carbon::parse($takeAwayOrder['created_at'])->format('d/m/Y H:i:s')); ?></p>
                            </div>
                            <div class="flex items-center px-4 pt-0">
                                <ul class="flex flex-col w-full">
                                    <?php $__currentLoopData = $takeAwayOrder['orders_line']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderLine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="order-line flex flex-col items-center py-4 w-full">
                                            <div class="flex items-center w-full">
                                                <div class="text-lg flex flex-col gap-1">
                                                    <div>
                                                        <strong><?php echo e($orderLine['product']['name']); ?> x <?php echo e($orderLine['quantity']); ?></strong>
                                                    </div>

                                                </div>
                                                <div class="flex justify-center items-center w-20 h-20 ml-auto bg-orange-950 rounded-full">
                                                    <img src="<?php echo e(asset('storage/' . $orderLine['product']['image_url'])); ?>" alt="<?php echo e($orderLine['product']['name']); ?>" class="w-16 h-16">
                                                </div>
                                            </div>
                                            <div class="ingredients-container hidden bg-walter-400 p-2 h-fit m-2 mt-6 rounded text-lg w-full">
                                                <?php echo e($orderLine['product']['description']); ?>

                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>


                <ul id="orders-ctn" class="flex flex-col gap-4 select-none text-orange-950 bg-orange-100 p-4 rounded w-full h-[75vh] overflow-y-scroll">
                    <h2 class="text-2xl font-bold bg-orange-500 text-orange-50 w-fit h-fit p-4 rounded">Pedidos para comer aquí</h2>
                    <?php $__currentLoopData = $eatHereOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eatHereOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="order-container bg-walter-200 rounded-lg  mb-4 drop-shadow-lg w-full h-fit">

                            <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4  rounded-t bg-orange-500 text-orange-50">
                                <div>
                                    <strong>Pedido: </strong>
                                    <?php echo e($eatHereOrder['id']); ?>

                                </div>

                                <div >
                                    <strong>Mesa: <?php echo e($eatHereOrder['table_id']); ?></strong>
                                </div>

                                <p><?php echo e(\Carbon\Carbon::parse($eatHereOrder['created_at'])->format('d/m/Y H:i:s')); ?></p>
                            </div>

                            <div class="flex items-center px-4 pt-0">
                                <ul class="flex flex-col w-full">
                                    <?php $__currentLoopData = $eatHereOrder['orders_line']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderLine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="order-line flex flex-col items-center py-4 ">
                                            <div class="flex items-center  w-full ">

                                                <div class="text-lg flex flex-col gap-1 ">
                                                    <div>
                                                        <strong>
                                                            <?php echo e($orderLine['product']['name']); ?> x <?php echo e($orderLine['quantity']); ?>

                                                        </strong>
                                                    </div>


                                                </div>
                                                <div class="flex justify-center items-center w-20 h-20 ml-auto bg-orange-950 rounded-full">
                                                    <img src="<?php echo e("/storage/" . $orderLine['product']['image_url']); ?>" alt="<?php echo e($orderLine['product']['name']); ?>" class="w-16 h-16">
                                                </div>
                                            </div>
                                            <div class="ingredients-container hidden bg-walter-400 p-2 h-fit  m-2 mt-6 rounded text-lg w-full">
                                                <?php echo e($orderLine['product']['description']); ?>

                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

        </section>

    </main>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

    <script>
        function ingredientsDisplay(card)
        {
            const ingredientsContainer = $(card).closest('.order-line').find('.ingredients-container');
            const plusSvg = $(card).find('svg');
            ingredientsContainer.slideToggle(200);
            plusSvg.toggleClass('text-red-500 rotate-45');
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.html-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Programación\Desktop\QUEATER\resources\views/cash-views/cash.blade.php ENDPATH**/ ?>