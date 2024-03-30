@extends('layouts.html-layout')

@section('title', 'Kitchen')

@section('navegacion')
    <a href="{{ route('cash.main') }}">cash</a>
    <a href="{{ route('dashboard.main') }}">dashboard</a>
@endsection

@section('content')
    {{-- Si hay un usuario logeado muestra la cocina, sino muestra el loggin --}}
    @if (Auth::check())

        {{-- SEARCH --}}
        <div class="w-full mb-10 bg-walter-300 px-4 flex items-center">
            <div class="w-full flex items-center bg-walter-300 rounded pY-4">
                <input type="text" id="search" placeholder="Buscar pedido..." class="w-full p-2 bg-transparent focus:outline-none text-orange-950">

                <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"  class="text-gray-500 w-8 h-8">
                    <path fill-rule="evenodd"  d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>

        {{-- SECTION --}}
        <section class="flex flex-col px-4 pb-4">

            {{-- ORDERS LIST --}}
            <ul id="orders-ctn" class="select-none text-orange-950">
                @foreach ($orders as $order)
                <div class="order-container bg-walter-200 rounded-lg  mb-4 drop-shadow-lg ">
                    <div class="flex text-lg flex-row justify-between items-center font-semibold p-4  rounded-t-lg bg-orange-500 text-orange-50">
                        <div>
                            <strong>Pedido: </strong>
                            {{ $order['id'] }}
                        </div>

                        <div >
                            <strong>{{ $order['take_away'] ? 'Para llevar' : 'Comer aquí' }}</strong>
                        </div>

                        <button class="bg-green-500 text-green-950 hover:bg-green-400  p-2 rounded cursor-pointer" onclick="confirmOrder(this, {{ $order['id'] }})">Hecho</button>
                    </div>
                    <div class=" flex items-center p-4 pt-0">
                        <ul class="flex flex-col w-full">
                            @foreach ($order['orders_line'] as $orderLine)
                            <li class="order-line flex flex-col items-center py-4 ">
                                <div class="flex items-center  w-full ">

                                    <div class="text-lg flex flex-col gap-1 ">
                                        <div>
                                            <strong>
                                                {{ $orderLine['product']['name'] }} x {{ $orderLine['quantity'] }}
                                            </strong>
                                        </div>

                                        <div class="ingredients-button flex items-center gap-2 cursor-pointer" onclick="ingredientsDisplay(this)">
                                            <strong>Ingredientes</strong>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="  w-7 h-7 transition-all">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>

                                        </div>
                                    </div>

                                    <img src="{{"/storage/" .$orderLine['product']['image_url'] }}" alt="{{ $orderLine['product']['name'] }}" class="w-20 h-20 ml-auto bg-orange-500 rounded-full">
                                </div>
                                <div class="ingredients-container hidden bg-walter-400 p-4 h-fit  m-4 rounded text-lg w-full">
                                    {{ $orderLine['product']['description'] }}
                                </div>
                            </li>
                            <hr class="border border-orange-950">
                            @endforeach
                        </ul>
                    </div>

                    <div class="w-[150px] h-1 bg-orange-400 rounded-full mx-auto "></div>
                </div>
                @endforeach
            </ul>

            {{-- LOG OUT --}}
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <input type="hidden" name="route" value='kitchen.main'>
                <button type="submit" class="bg-orange-500 rounded min-w-40 p-4 active:bg-orange-400 text-orange-50 font-bold text-xl">Salir</button>
            </form>
        </section>

    @else
        @include('login-views.login',['route' => 'kitchen.main', 'title' => 'cocina'])
    @endif


    <script>

        function showNewOrders(data){
            data.forEach(order => {
                const orderContainer = `
                <div class="order-container bg-gray-100 rounded-lg  mb-4 drop-shadow-lg ">
                    <div class="flex text-lg flex-row justify-between items-center font-semibold p-4 text-white rounded-t-lg bg-orange-500">
                        <div>
                            <strong>Pedido: </strong>
                            ${order.id}
                        </div>

                        <div >
                            <strong>${order.take_away ? 'Para llevar' : 'Comer aquí'}</strong>
                        </div>


                        <button class="bg-green-500 text-green-950 hover:bg-green-400  p-2 rounded cursor-pointer" onclick="confirmOrder(this, ${order.id})">Hecho</button>
                    </div>
                    <div class=" flex items-center p-4 pt-0">
                        <ul  class="flex flex-col w-full">
                            ${order.orders_line.map(orderLine => `
                            <li class="order-line
                            flex flex-col items-center py-4 ">
                                <div class="flex items
                                -center  w-full ">

                                    <div class="text-lg flex flex-col gap-1 ">
                                        <div>
                                            <strong>
                                                ${orderLine.product.name} x ${orderLine.quantity}
                                            </strong>
                                        </div>

                                        <div class="ingredients-button flex items-center gap-2 cursor-pointer" onclick="ingredientsDisplay(this)">
                                            <strong>Ingredientes</strong>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="  w-7 h-7 transition-all">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>

                                        </div>
                                    </div>
                                    <img src="/storage/${orderLine.product.image_url}" alt="${orderLine.product.name}" class="w-20 h-20 ml-auto bg-orange-500 rounded-full">                                </div>
                                    <div class="ingredients-container hidden bg-gray-200 h-fit p-4 m-4 rounded text-lg w-full">

                                        ${orderLine.product.description}

                                    </div>
                            </li>
                            <hr class="border border-orange-950">
                            `).join('')}
                        </ul>
                    </div>

                    <div class="w-[150px] h-1 bg-orange-400 rounded-full mx-auto "></div>
                </div>
                `;
                $('#orders-ctn').append(orderContainer);

            });
        }


        //Pide los nuevos pedidos cada 5 segundos
        setInterval(() => {
            $.ajax({
                url: "{{ route('kitchen.orders.new') }}",
                type: 'GET',
                success: function(data) {
                    console.log("Hola");
                    if (data.length > 0) {
                        console.log(data);
                        showNewOrders(data);
                    }
                },
                error: function() {
                    console.log('Error');
                }
            });
        }, 5000);

    </script>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function confirmOrder(order, orderId){
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
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                Swal.fire({
                    title: "¡Pedido terminado!",
                    customClass: {
                        confirmButton: 'border border-orange-500 bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600',
                        popup: 'bg-white', // Clase para personalizar el fondo del pop-up
                        title: 'text-orange-950', // Clase para personalizar el color del texto del título

                    },
                    icon: "success",
                    iconColor: '#84cc16', // Clase para personalizar el color del icono
                    showConfirmButton: false, // Oculta el botón de confirmación
                    buttonsStyling: false,
                    timer: 1000 // Tiempo en milisegundos antes de que el pop-up se cierre automáticamente
                });



                $.ajax({
                    url: "{{ route('kitchen.orders.change-status') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        order_id: orderId
                    },
                    success: function() {
                        card.fadeOut(200, function() {
                            $(this).remove();
                        });
                        console.log('Pedido hecho');
                    }
                });
            }
        });


    }


    function ingredientsDisplay(card){

        const ingredientsContainer = $(card).closest('.order-line').find('.ingredients-container');
        const plusSvg = $(card).find('svg');
        ingredientsContainer.slideToggle(200);
        plusSvg.toggleClass('text-red-500 rotate-45');

    }

</script>

