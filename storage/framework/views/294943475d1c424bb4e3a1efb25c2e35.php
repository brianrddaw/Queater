<?php $__env->startSection('title', 'Cash'); ?>
<?php $__env->startSection('navegacion'); ?>
    <a href="<?php echo e(route('dashboard.main')); ?>">dasboard</a>
    <a href="<?php echo e(route('kitchen.main')); ?>">kitchen</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <main class="w-full h-full min-h-[calc(100vh-3.5rem)] p-6 px-14 flex flex-col gap-4 text-slate-800">

        <h1 class="text-4xl font-bold py-4 px-8 rounded w-fit bg-slate-800 text-orange-50">Zona de pedidos</h1>

        <section class="w-full h-fit flex flex-wrap flex-col gap-4">

            <div class="all-orders-container flex w-full rounded gap-6">
                <ul id="orders-ctn" class="flex flex-col gap-4 select-none text-orange-950 rounded w-full h-[75vh] p-4 bg-cyan-100 shadow-stone-300 shadow-4">
                    <div class="flex text-2xl w-fit h-fit justify-between items-center p-2 pl-4 gap-6 bg-cyan-500 text-orange-50 font-bold   rounded-full">
                        <h2 >Para comer aquí</h2>
                        <div class="flex items-center justify-center w-10 h-10 font-bold bg-cyan-800 text-orange-50 rounded-full shadow-5">
                            <h3 id="total-eat-here"><?php echo e(count($eatHereOrders)); ?></h3>
                        </div>
                    </div>
                    <div id="eat-here-orders-ctn" class="overflow-y-auto pr-4">
                        
                    </div>
                </ul>

                <ul class="flex flex-col gap-4 select-none text-orange-950 w-full h-[75vh] rounded p-4 bg-orange-100 shadow-stone-300 shadow-4">
                    <div class="flex text-2xl w-fit h-fit justify-between items-center p-2 pl-4 gap-6 bg-orange-500 text-orange-50 font-bold   rounded-full">
                        <h2 >Para llevar</h2>
                        <div class="flex items-center justify-center w-10 h-10 font-bold bg-orange-800 text-orange-50 rounded-full shadow-5">
                            <h3 id="total-take-away"><?php echo e(count($takeAwayOrders)); ?></h3>
                        </div>
                    </div>
                    <div id="take-away-orders-ctn" class="overflow-y-auto pr-4">
                    
                    </div>
                </ul>

                <ul id="orders-ctn" class="flex flex-col gap-4 select-none text-orange-950 rounded w-full h-[75vh] p-4 bg-slate-300 shadow-stone-300 shadow-4">
                    <div class="flex text-2xl w-fit h-fit justify-between items-center p-2 pl-4 gap-6 bg-slate-800 text-orange-50 font-bold   rounded-full">
                        <h2 >En Preparación...</h2>
                        <div class="flex items-center justify-center w-10 h-10 font-bold bg-slate-600 text-slate-100 rounded-full shadow-5">
                            <h3 id="total-preparing"><?php echo e(count($preparingOrders)); ?></h3>
                        </div>
                    </div>
                    <div id="preparing-orders-ctn" class="overflow-y-auto pr-4">
                    
                    </div>
                </ul>
            </div>

        </section>

    </main>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        function getOrders()
        {
            $.ajax({
                url: '/get/orders',
                method: 'GET',
                success: function(data) {
                    createOrdersPreparingHtml(data.preparingOrders);
                    createOrdersEatHereHtml(data.eatHereOrders);
                    createOrdersTakeAwayHtml(data.takeAwayOrders);
                },
                error: function(err) {
                    console.error(err);
                }
            });
        }

        function createOrdersPreparingHtml(data) {
            const numberOrders = data.length;

            $('#total-preparing').text(`${numberOrders}`);

            const ordersHtml = data.map(order => {
                const orderHeaderHtml = `
                    <div>
                        <strong>Pedido: </strong>${order.id}
                    </div>
                    <div class="bg-slate-500 rounded px-2">
                        <strong>${order.take_away ? 'Para llevar' : 'Mesa: ' + order.table_id}</strong>
                    </div>
                    <p>${order.created_at}</p>
                `;

                const orderLineItemsHtml = order.orders_line.map(orderLine => `
                    <li class="order-line flex flex-col items-center py-4">
                        <div class="flex items center w-full">
                            <div class="text-lg flex  flex-col gap-1">
                                <div>
                                    <strong>${orderLine.product.name} x ${orderLine.quantity}</strong>
                                </div>
                            </div>
                        </div>
                    </li>
                `).join('');

                return `
                    <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                        <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-slate-800 text-orange-50">${orderHeaderHtml}</div>
                        <div class="flex items-center px-4 pt-0"><ul class="flex flex-col w-full">${orderLineItemsHtml}</ul></div>
                    </div>
                `;
            }).join('');

            $('#preparing-orders-ctn').html(ordersHtml);
        }

        function createOrdersTakeAwayHtml(data) {

            const numberOrders = data.length;

            $('#total-take-away').text(`${numberOrders}`);

            const ordersHtml = data.map(order => {
                const orderBtnDeliveredHtml = `<button class="bg-orange-800 text-orange-50 p-2 px-4 rounded" onclick="changeOrderState(${order.id})">Entregar</button>`;
                const orderHeaderHtml = `
                    <div>
                        <strong>Pedido: </strong>${order.id}
                    </div>
                    <div>
                        <strong>${order.take_away ? 'Para llevar' : 'Mesa: ' + order.table_id}</strong>
                    </div>
                    <p>${order.created_at}</p>
                    <div>
                        ${orderBtnDeliveredHtml}
                    </div>
                `;

                const orderLineItemsHtml = order.orders_line.map(orderLine => `
                    <li class="order-line flex flex-col items-center py-4">
                        <div class="flex items center w-full">
                            <div class="text-lg flex flex-col gap-1">
                                <div>
                                    <strong>${orderLine.product.name} x ${orderLine.quantity}</strong>
                                </div>
                            </div>
                        </div>
                    </li>
                `).join('');


                return `
                    <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                        <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-orange-500 text-orange-50">${orderHeaderHtml}</div>
                        <div class="flex items-center px-4 pt-0"><ul class="flex flex-col w-full">${orderLineItemsHtml}</ul></div>
                    </div>
                `;
            }).join('');

            $('#take-away-orders-ctn').html(ordersHtml);
        }


        function createOrdersEatHereHtml(data) {

            const numberOrders = data.length;

            $('#total-eat-here').text(`${numberOrders}`);

            const ordersHtml = data.map(order => {
                const orderBtnDeliveredHtml = `<button class="bg-cyan-800 text-orange-50 p-2 px-4 rounded" onclick="changeOrderState(${order.id})">Entregar</button>`;
                const orderHeaderHtml = `
                    <div>
                        <strong>Pedido: </strong>${order.id}
                    </div>
                    <div class="bg-cyan-600 rounded p-2">
                        <strong>Mesa: ${order.table_id}</strong>
                    </div>
                    <p>${order.created_at}</p>
                    <div>
                        ${orderBtnDeliveredHtml}
                    </div>
                `;

                const orderLineItemsHtml = order.orders_line.map(orderLine => `
                    <li class="order-line flex flex-col items-center py-4">
                        <div class="flex items center w-full">
                            <div class="text-lg flex flex-col gap-1">
                                <div>
                                    <strong>${orderLine.product.name} x ${orderLine.quantity}</strong>
                                </div>
                            </div>
                        </div>
                    </li>
                `).join('');


                return `
                    <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                        <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-cyan-500 text-orange-50">${orderHeaderHtml}</div>
                        <div class="flex items-center px-4 pt-0"><ul class="flex flex-col w-full">${orderLineItemsHtml}</ul></div>

                    </div>
                `;
            }).join('');

            $('#eat-here-orders-ctn').html(ordersHtml);
        }


        function changeOrderState(order_id)
        {
            Swal.fire({
            title: "¿Quieres cambiar el estado del pedido a entregado?",
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
                        title: "¡Pedido entregado!",
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
                        url: "/orders/change/state",
                        type: 'put',
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            order_id: order_id
                        },
                        success: function(response) {
                            console.log(response);
                            getOrders();
                        },
                        error: function(err) {
                            console.error(err);
                            console.error(err.responseText);
                        }
                    });
                }
            });
        }
        getOrders();

        setInterval(() =>{
            getOrders();
        }, 5000);




    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.html-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Programación\Desktop\miguel\resources\views/cash-views/cash.blade.php ENDPATH**/ ?>