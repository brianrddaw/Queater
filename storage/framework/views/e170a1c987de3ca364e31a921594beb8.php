<?php $__env->startSection('title', 'Kitchen'); ?>

<?php $__env->startSection('navegacion'); ?>
    <a href="<?php echo e(route('dashboard.main')); ?>">dashboard</a>
    <a href="<?php echo e(route('cash.main')); ?>">cash</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(Auth::check()): ?>
    <section class="flex flex-col px-14 p-4 gap-10">
            <div class="all-orders-container flex w-full gap-10 mt-4">
                <div class="flex flex-col w-full h-fit gap-6">
                    <h2 class="text-2xl font-bold bg-orange-950 text-orange-50 w-fit h-fit p-4 rounded">Pedidos listos</h2>
                    <ul class="flex flex-col gap-4 select-none text-orange-950 w-full h-[65vh] bg-stone-400 p-4 rounded overflow-y-scroll">
                        <div id="ready-orders-ctn">
                        <?php $__currentLoopData = $readyOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $readyOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="order-container bg-walter-200 rounded-lg  mb-4 drop-shadow-lg w-full h-fit grayscale">

                                <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4  rounded-t bg-orange-500 text-orange-50">
                                    <div>
                                        <strong>Pedido: </strong>
                                        <?php echo e($readyOrder['id']); ?>

                                    </div>

                                    <div >
                                        <strong><?php echo e($readyOrder['take_away'] ? 'Para llevar' : 'Mesa: ' . $readyOrder['table_id'] . ''); ?></strong>
                                    </div>

                                    <p>Finalizado</p>
                                </div>

                                <div class="flex items-center px-4 pt-0">
                                    <ul class="flex flex-col w-full">
                                        <?php $__currentLoopData = $readyOrder['orders_line']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderLine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="order-line flex flex-col items-center py-4 w-full">
                                                <div class="flex items-center w-full ">

                                                    <div class="text-lg flex flex-col gap-1 ">
                                                        <div>
                                                            <strong>
                                                                <?php echo e($orderLine['product']['name']); ?> x <?php echo e($orderLine['quantity']); ?>

                                                            </strong>
                                                        </div>


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
                        </div>
                    </ul>
                </div>
                <div class="flex flex-col w-full h-fit gap-6">
                    <h2 class="text-2xl font-bold bg-orange-500 text-orange-50 w-fit h-fit p-4 rounded">Pedidos en cola</h2>
                    <ul class="flex flex-col gap-4 select-none text-orange-950 bg-orange-100 p-4 rounded w-full h-[65vh] overflow-y-scroll">
                        <div id="orders-ctn">
                        <?php $__currentLoopData = $preparingOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preparingOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="order-container bg-walter-200 rounded-lg  mb-4 drop-shadow-lg w-full h-fit">

                                <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4  rounded-t bg-orange-500 text-orange-50">
                                    <div>
                                        <strong>Pedido: </strong>
                                        <?php echo e($preparingOrder['id']); ?>

                                    </div>

                                    <div >
                                        <strong>Para llevar</strong>
                                    </div>

                                    <button class="bg-green-500 text-green-950 hover:bg-green-400  p-2 rounded cursor-pointer" onclick="confirmOrder(this, <?php echo e($preparingOrder['id']); ?>)">Hecho</button>
                                </div>

                                <div class="flex items-center px-4 pt-0">
                                    <ul class="flex flex-col w-full">
                                        <?php $__currentLoopData = $preparingOrder['orders_line']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderLine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="order-line flex flex-col items-center py-4 ">
                                                <div class="flex items-center  w-full ">

                                                    <div class="text-lg flex flex-col gap-1 ">
                                                        <div>
                                                            <strong>
                                                                <?php echo e($orderLine['product']['name']); ?> x <?php echo e($orderLine['quantity']); ?>

                                                            </strong>
                                                        </div>

                                                        <div class="ingredients-button flex items-center gap-2 cursor-pointer" onclick="ingredientsDisplay(this)">
                                                            <strong>Descripción</strong>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="  w-7 h-7 transition-all">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>

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
                        </div>
                    </ul>
                </div>
            </div>
            <form action="<?php echo e(route('logout')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="route" value='kitchen.main'>
                <button type="submit" class="bg-orange-500 rounded min-w-40 p-4 active:bg-orange-400 text-orange-50 font-bold text-xl mt-2">Salir</button>
            </form>
        </section>

    <?php else: ?>
        <?php echo $__env->make('login-views.login',['route' => 'kitchen.main', 'title' => 'cocina'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>


    <script>
        function showNewOrders(data)
        {
            data.forEach(order => {
                const orderContainer = `
                    <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                        <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-orange-500 text-orange-50">
                            <div>
                                <strong>Pedido: </strong>
                                ${order.id}
                            </div>
                            <div>
                                <strong>${order.take_away ? 'Para llevar' : 'Mesa: ' + order.table_id}</strong>
                            </div>
                            <button class="bg-green-500 text-green-950 hover:bg-green-400 p-2 rounded cursor-pointer" onclick="confirmOrder(this, ${order.id})">Hecho</button>
                        </div>
                        <div class="flex items-center px-4 pt-0">
                            <ul class="flex flex-col w-full">
                                ${order.orders_line.map(orderLine => `
                                    <li class="order-line flex flex-col items-center py-4">
                                        <div class="flex items-center w-full">
                                            <div class="text-lg flex flex-col gap-1">
                                                <div>
                                                    <strong>${orderLine.product.name} x ${orderLine.quantity}</strong>
                                                </div>
                                                <div class="ingredients-button flex items-center gap-2 cursor-pointer" onclick="ingredientsDisplay(this)">
                                                    <strong>Ingredientes</strong>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 transition-all">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex justify-center items-center w-20 h-20 ml-auto bg-orange-950 rounded-full">
                                                <img src="/storage/${orderLine.product.image_url}" alt="${orderLine.product.name}" class="w-16 h-16">
                                            </div>
                                        </div>
                                        <div class="ingredients-container hidden bg-walter-400 p-2 h-fit m-2 mt-6 rounded text-lg w-full">
                                            ${orderLine.product.description}
                                        </div>
                                    </li>
                                `).join('')}
                            </ul>
                        </div>
                    </div>
                `;

                $('#orders-ctn').append(orderContainer);
            });
        }

        function showNewOrdersDones(data)
        {
            $('#ready-orders-ctn').empty();

            data.forEach(order => {
                const orderContainer = `
                <div class="order-container bg-walter-200 rounded-lg  mb-4 drop-shadow-lg w-full h-fit grayscale">

                <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4  rounded-t bg-orange-500 text-orange-50">
                    <div>
                        <strong>Pedido: </strong>
                        ${order.id}
                    </div>

                    <div >
                        <strong>${order.take_away ? 'Para llevar' : 'Mesa: ' + order.table_id}</strong>
                    </div>

                    <p>Finalizado</p>
                </div>

                <div class="flex items-center px-4 pt-0">
                    <ul class="flex flex-col w-full">
                        ${order.orders_line.map(orderLine => `
                            <li class="order-line flex flex-col items-center py-4 w-full">
                                <div class="flex items-center w-full ">
                                    <div class="text-lg flex flex-col gap-1 ">
                                        <div>
                                            <strong>${orderLine.product.name} x ${orderLine.quantity}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="ingredients-container hidden bg-walter-400 p-2 h-fit  m-2 mt-6 rounded text-lg w-full">
                                    ${orderLine.product.description}
                                </div>
                            </li>
                        `).join('')}

                    </ul>
                </div>
                </div>`;

                $('#ready-orders-ctn').append(orderContainer);
            });
        }

        setInterval(() => {
            $.ajax({
                url: "<?php echo e(route('kitchen.orders.new')); ?>",
                type: 'GET',
                success: function(data) {
                    if (data.length > 0) {
                        showNewOrders(data);
                    }
                },
                error: function() {
                    console.log('Error');
                }
            });

            $.ajax({
                url: "<?php echo e(route('kitchen.orders.ready')); ?>",
                type: 'GET',
                success: function(data) {
                    if (data.length > 0) {
                        showNewOrdersDones(data);
                    }
                },
                error: function() {
                    console.log('Error');
                }
            });

        }, 5000);



    </script>

<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function confirmOrder(order, orderId)
    {
        const card = $(order).closest('.order-container');

        Swal.fire({
            title: "¿Quieres terminar el pedido?",
            customClass: {
                confirmButton: 'border-0 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-400',
                cancelButton: 'border-0 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-400 ml-2',
                title: 'text-green-950',
            },
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
            focusConfirm: false

        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: "¡Pedido terminado!",
                    customClass: {
                        confirmButton: 'border border-orange-500 bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600',
                        popup: 'bg-white',
                        title: 'text-orange-950',

                    },
                    icon: "success",
                    iconColor: '#84cc16',
                    showConfirmButton: false,
                    buttonsStyling: false,
                    timer: 1000
                });

                $.ajax({
                    url: "<?php echo e(route('kitchen.orders.change-status')); ?>",
                    type: 'POST',
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        order_id: orderId
                    },
                    success: function() {
                        card.fadeOut(200, function() {
                            $(this).remove();
                        });

                        window.location.reload();
                    }
                });
            }
        });
    }


    function ingredientsDisplay(card)
    {
        const ingredientsContainer = $(card).closest('.order-line').find('.ingredients-container');
        const plusSvg = $(card).find('svg');
        ingredientsContainer.slideToggle(200);
        plusSvg.toggleClass('text-red-500 rotate-45');
    }
</script>


<?php echo $__env->make('layouts.html-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u272775609/domains/queater.com/resources/views/kitchen-views/kitchen.blade.php ENDPATH**/ ?>