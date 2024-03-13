@extends('layouts.html-layout')

@section('title', 'Kitchen')

@section('navegacion')
    <a href="{{ route('user.main') }}" class="">User</a>
    <a href="{{ route('dashboard.main') }}" class="">Dashboard</a>
    <a href="{{ route('kitchen.main') }}" class="">Kitchen</a>
@endsection

@section('content')
    {{-- Si hay un usuario logeado muestra la cocina, sino muestra el loggin --}}
    @if (Auth::check())
    <div class="container mx-auto py-8 px-4 text-orange-950">
        <h1 class="text-center text-3xl font-bold my-4">¡Bienvenido a la cocina!</h1>
        <h2 class="text-2xl mb-4 uppercase font-bold">pedidos</h2>
        <ul id="orders-ctn" class="select-none">
            @foreach ($orders as $order)
            <div class="order-container bg-gray-100 rounded-lg  mb-4 drop-shadow-lg ">
                <div class="flex text-lg flex-row justify-between items-center font-semibold p-4  rounded-t-lg bg-orange-400">
                    <div>
                        <strong>Pedido: </strong>
                        {{ $order['id'] }}
                    </div>

                    <div >
                        <strong>{{ $order['take_away'] ? 'Para llevar' : 'Comer aquí' }}</strong>
                    </div>

                    {{-- <div class="flex items-center gap-2">
                        <strong>Estado:</strong>
                        {{ $order['state'] }}
                    </div> --}}

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
                                <img src="{{ asset('imgs/burguer.webp') }}" alt="" class="w-20 h-20 ml-auto bg-orange-500 rounded-full">
                            </div>
                            <div class="ingredients-container hidden bg-gray-200 h-fit p-4 m-4 rounded text-lg w-full">
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

        <form action="{{ route('logout') }}" method="post">
            @csrf
            <input type="hidden" name="route" value='kitchen.main'>
            <button type="submit" class="bg-orange-950 rounded min-w-40 p-4 hover:bg-orange-900 text-orange-50 font-bold text-xl">Salir</button>
        </form>
    </div>
    @else
        @include('login-views.login',['route' => 'kitchen.main', 'title' => 'cocina'])
    @endif


    <script>

        function showNewOrders(data){
            data.forEach(order => {
                const orderContainer = `
                <div class="order-container bg-gray-100 rounded-lg  mb-4 drop-shadow-lg ">
                    <div class="flex text-lg flex-row justify-between items-center font-semibold p-4  rounded-t-lg bg-orange-400">
                        <div>
                            <strong>Pedido: </strong>
                            ${order.id}
                        </div>

                        <div >
                            <strong>${order.take_away ? 'Para llevar' : 'Comer aquí'}</strong>
                        </div>

                        <div class="flex items
                        -center gap-2">
                            <strong>Estado:</strong>
                            ${order.state}
                            <span class="flex w-4 h-4 rounded-full  bg-red-500 border-2 border-red-600"></span>
                        </div>

                        <button class="bg-green-500 text-green-950 hover:bg-green-400  p-2 rounded cursor-pointer">Hecho</button>
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
                                    <img src="{{ asset('imgs/burguer.webp') }}" alt="" class="w-20 h-20 ml-auto bg-orange-500 rounded-full">
                                </div>
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
                    if (data.length > 0) {
                        console.log(data);
                        showNewOrders(data);
                    }
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
                confirmButton: 'border border-orange-500 bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600',
                cancelButton: 'border border-red-500 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 ml-2'
            },
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
            focusConfirm: false
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire("¡Pedido terminado!", "", "success");

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

