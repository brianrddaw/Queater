@extends('layouts.html-layout')

@section('title', 'Cash')
@section('content')
@section('navegacion')
    <a href="{{ route('dashboard.main') }}">dasboard</a>
    <a href="{{ route('kitchen.main') }}">kitchen</a>
@endsection

    <main class="w-full h-full min-h-[calc(100vh-3.5rem)] p-4 px-14 flex flex-col gap-10">
        <div class="flex flex-col gap-4 w-fit p-6 bg-orange-50 rounded shadow-4">
            <h1 class="text-4xl font-bold p-4 rounded w-fit">ESTÁS EN LA CAJA</h1>
            <div class="flex gap-4">
                <h2 class="text-4xl font-bold bg-orange-400 p-4 rounded w-fit">PEDIDOS EN COLA: {{ count($eatHereOrders) + count($takeAwayOrders) }}</h2>
                <h2 class="text-4xl font-bold bg-[#ffdb71] p-4 rounded w-fit">PARA COMER AQUÍ: {{ count($eatHereOrders)}}</h2>
                <h2 class="text-4xl font-bold bg-[#ffdb71] p-4 rounded w-fit">PARA LLEVAR: {{ count($takeAwayOrders)}}</h2>
            </div>
        </div>

        <section class="w-full h-fit flex flex-wrap flex-col gap-4">
            <div class="all-orders-container flex w-full gap-10">
                <ul class="flex flex-col gap-4 select-none text-orange-950 w-full h-[75vh] rounded pr-4 overflow-y-scroll">
                    <h2 class="text-2xl font-bold bg-orange-500 text-orange-50 w-fit h-fit p-4 rounded">Pedidos para llevar</h2>
                    @foreach ($takeAwayOrders as $takeAwayOrder)
                        <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                            <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-orange-500 text-orange-50">
                                <div>
                                    <strong>Pedido: </strong>
                                    {{ $takeAwayOrder['id'] }}
                                </div>
                                <div>
                                    <strong>{{ $takeAwayOrder['take_away'] ? 'Para llevar' : 'Mesa: ' . $takeAwayOrder['table_id'] }}</strong>
                                </div>
                                <p>{{ \Carbon\Carbon::parse($takeAwayOrder['created_at'])->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div class="flex items-center px-4 pt-0">
                                <ul class="flex flex-col w-full">
                                    @foreach ($takeAwayOrder['orders_line'] as $orderLine)
                                        <li class="order-line flex flex-col items-center py-4 w-full">
                                            <div class="flex items-center w-full">
                                                <div class="text-lg flex flex-col gap-1">
                                                    <div>
                                                        <strong>{{ $orderLine['product']['name'] }} x {{ $orderLine['quantity'] }}</strong>
                                                    </div>
                                                </div>
                                                <div class="flex justify-center items-center w-20 h-20 ml-auto bg-orange-500 rounded-full">
                                                    <img src="{{ asset('storage/' . $orderLine['product']['image_url']) }}" alt="{{ $orderLine['product']['name'] }}" class="w-16 h-16">
                                                </div>
                                            </div>
                                            <div class="ingredients-container hidden bg-walter-400 p-2 h-fit m-2 mt-6 rounded text-lg w-full">
                                                {{ $orderLine['product']['description'] }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </ul>

                <ul id="orders-ctn" class="flex flex-col gap-4 select-none text-orange-950 rounded w-full h-[75vh] pr-4 overflow-y-scroll">
                    <h2 class="text-2xl font-bold bg-orange-500 text-orange-50 w-fit h-fit p-4 rounded">Pedidos para comer aquí</h2>
                    @foreach ($eatHereOrders as $eatHereOrder)
                        <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                            <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-orange-500 text-orange-50">
                                <div>
                                    <strong>Pedido: </strong>
                                    {{ $eatHereOrder['id'] }}
                                </div>
                                <div>
                                    <strong>Mesa: {{ $eatHereOrder['table_id'] }}</strong>
                                </div>
                                <p>{{ \Carbon\Carbon::parse($eatHereOrder['created_at'])->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div class="flex items-center px-4 pt-0">
                                <ul class="flex flex-col w-full">
                                    @foreach ($eatHereOrder['orders_line'] as $orderLine)
                                        <li class="order-line flex flex-col items-center py-4 ">
                                            <div class="flex items-center  w-full ">
                                                <div class="text-lg flex flex-col gap-1 ">
                                                    <div>
                                                        <strong>{{ $orderLine['product']['name'] }} x {{ $orderLine['quantity'] }}</strong>
                                                    </div>
                                                </div>
                                                <div class="flex justify-center items-center w-20 h-20 ml-auto bg-orange-500 rounded-full">
                                                    <img src="{{"/storage/" . $orderLine['product']['image_url'] }}" alt="{{ $orderLine['product']['name'] }}" class="w-16 h-16">
                                                </div>
                                            </div>
                                            <div class="ingredients-container hidden bg-walter-400 p-2 h-fit  m-2 mt-6 rounded text-lg w-full">
                                                {{ $orderLine['product']['description'] }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
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
@endsection

