@extends('layouts.html-layout')

@section('title', 'Cash')
@section('content')
@section('navegacion')
    <a href="{{ route('dashboard.main') }}">dasboard</a>
    <a href="{{ route('kitchen.main') }}">kitchen</a>
@endsection

    <main class="w-full h-full min-h-[calc(100vh-3.5rem)] p-6 px-14 flex flex-col gap-4">
        <h1 class="text-4xl font-bold p-4 rounded w-fit bg-stone-200">ESTÁS EN LA CAJA</h1>
        <section class="w-full h-fit flex flex-wrap flex-col gap-4">
            <div class="all-orders-container flex w-full rounded gap-6">
                <ul id="orders-ctn" class="flex flex-col gap-4 select-none text-orange-950 rounded w-full h-[75vh] p-4 overflow-y-scroll bg-cyan-100 shadow-stone-300 shadow-4">
                    <div class="flex justify-between text-2xl w-full h-fit items-center gap-6">
                        <h2 class="font-bold bg-cyan-500 text-orange-50 p-4 rounded">Para comer aquí</h2>
                        <div class="flex items-center font-bold bg-yellow-950 text-orange-50 gap-4 p-4 rounded">
                            <h3>Total: {{ count($eatHereOrders) }}</h3>
                            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 2.5C5.44772 2.5 5 2.94772 5 3.5V5.5C5 6.05228 5.44772 6.5 6 6.5C6.55228 6.5 7 6.05228 7 5.5V3.5C7 2.94772 6.55228 2.5 6 2.5Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13 21.5C15.973 21.5 18.441 19.3377 18.917 16.5H19C21.2091 16.5 23 14.7091 23 12.5C23 10.2909 21.2091 8.5 19 8.5V7.5H1V15.5C1 18.8137 3.68629 21.5 7 21.5H13ZM3 9.5V15.5C3 17.7091 4.79086 19.5 7 19.5H13C15.2091 19.5 17 17.7091 17 15.5V9.5H3ZM21 12.5C21 13.6046 20.1046 14.5 19 14.5V10.5C20.1046 10.5 21 11.3954 21 12.5Z" fill="currentColor" /><path d="M9 3.5C9 2.94772 9.44771 2.5 10 2.5C10.5523 2.5 11 2.94772 11 3.5V5.5C11 6.05228 10.5523 6.5 10 6.5C9.44771 6.5 9 6.05228 9 5.5V3.5Z" fill="currentColor" /><path d="M14 2.5C13.4477 2.5 13 2.94772 13 3.5V5.5C13 6.05228 13.4477 6.5 14 6.5C14.5523 6.5 15 6.05228 15 5.5V3.5C15 2.94772 14.5523 2.5 14 2.5Z" fill="currentColor" />
                            </svg>
                        </div>
                    </div>
                    @foreach ($eatHereOrders as $eatHereOrder)
                        <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit ">
                            <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-cyan-500 text-orange-50">
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
                                                <div class="flex justify-center items-center w-20 h-20 ml-auto bg-cyan-800 rounded-full">
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

                <ul class="flex flex-col gap-4 select-none text-orange-950 w-full h-[75vh] rounded p-4 overflow-y-scroll bg-orange-100 shadow-stone-300 shadow-4">
                    <div class="flex justify-between text-2xl w-full h-fit items-center gap-6">
                        <h2 class="font-bold bg-orange-500 text-orange-50 p-4 rounded">Para llevar</h2>
                        <div class="flex items-center font-bold bg-yellow-950 text-orange-50 gap-4 p-4 rounded">
                            <h3>Total: {{ count($takeAwayOrders) }}</h3>
                            <svg class="w-8 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5 4H19C19.5523 4 20 4.44771 20 5V19C20 19.5523 19.5523 20 19 20H5C4.44772 20 4 19.5523 4 19V5C4 4.44772 4.44771 4 5 4ZM2 5C2 3.34315 3.34315 2 5 2H19C20.6569 2 22 3.34315 22 5V19C22 20.6569 20.6569 22 19 22H5C3.34315 22 2 20.6569 2 19V5ZM12 12C9.23858 12 7 9.31371 7 6H9C9 8.56606 10.6691 10 12 10C13.3309 10 15 8.56606 15 6H17C17 9.31371 14.7614 12 12 12Z" fill="currentColor" />
                            </svg>
                        </div>
                    </div>
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
                                                <div class="flex justify-center items-center w-20 h-20 ml-auto bg-orange-800 rounded-full">
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

                <ul id="orders-ctn" class="flex flex-col gap-4 select-none text-orange-950 rounded w-full h-[75vh] p-4 overflow-y-scroll bg-stone-100 shadow-stone-300 shadow-4">
                    <div class="flex justify-between text-2xl w-full h-fit items-center gap-6">
                        <h2 class="font-bold bg-stone-950 text-orange-50 p-4 rounded">En cola...</h2>
                        <h3 class="font-bold bg-yellow-950 text-orange-50 p-4 rounded">Total: {{ count($preparingOrders) }}</h3>
                    </div>
                    @foreach ($preparingOrders as $preparingOrder)
                        <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                            <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-stone-500 text-orange-50">
                                <div>
                                    <strong>Pedido: </strong>
                                    {{ $preparingOrder['id'] }}
                                </div>
                                <div>
                                    <strong>{{ $takeAwayOrder['take_away'] ? 'Para llevar' : 'Mesa: ' . $takeAwayOrder['table_id'] }}</strong>
                                </div>
                                <p>{{ \Carbon\Carbon::parse($preparingOrder['created_at'])->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div class="flex items-center px-4 pt-0">
                                <ul class="flex flex-col w-full">
                                    @foreach ($preparingOrder['orders_line'] as $orderLine)
                                        <li class="order-line flex flex-col items-center py-4 ">
                                            <div class="flex items-center  w-full ">
                                                <div class="text-lg flex flex-col gap-1 ">
                                                    <div>
                                                        <strong>{{ $orderLine['product']['name'] }} x {{ $orderLine['quantity'] }}</strong>
                                                    </div>
                                                </div>
                                                <div class="flex justify-center items-center w-20 h-20 ml-auto bg-stone-950 rounded-full">
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

