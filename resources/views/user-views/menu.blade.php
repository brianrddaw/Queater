@extends('layouts.html-layout')

@section('title', 'User')
@section('navegacion')
    {{-- <a href="{{ route('dashboard.main') }}" class="border-b-2 border-red-500 text-xl m-auto ">Menu</a>
    <a href="{{ route('kitchen.main') }}" class="border-b-2 border-red-500 text-xl m-auto ">Orden</a>
    <a href="{{ route('logout') }}" class="border-b-2 border-red-500 text-xl m-auto ">Cerrar sesión</a> --}}
@endsection
@section('content')
    <main  class="eat-here-main border border-blue-700">

        @foreach ($productsByCategory as $category => $products)
        <h2 class="text-2xl text-orange-950 font-bold border-b-2 border-orange-500">{{ $category }}</h2>
            <ul class="flex flex-col gap-20">
                @foreach ($products as $product)
                    @if ($product->availability)
                        @include('user-views.user-product.product-card', ['product' => $product])
                    @endif
                @endforeach
            </ul>
        @endforeach

        {{-- @foreach ( $products as $product )
            @if ($product->availability)

                @include('user-views.user-product.product-card', ['product' => $product])
            @endif
        @endforeach --}}


        @include('user-views.user-cart.user-cart', ['orders' => []])

    </main>


    {{-- Import para usar Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        var order = {};

        window.onload = function()
        {
            if (Object.keys(order).length == 0) {
                console.log("No hay productos en el pedido");
                $('#cart').hide();
            };
        }

        function addToOrder(id, price, name)
        {

            if (order[id])
            {
                order[id].quantity++;
            }
            else
            {
                order[id] = {
                    id: id,
                    name: name,
                    price: price,
                    quantity: 1
                };
            }
            if(Object.keys(order).length > 0){
                $('#cart').show();
            }
            addToOrderHtml(order[id]);


            console.log("Este es el producto",id, price,name);

        }


        function addToOrderHtml(product) {
            console.log("Este es el producto para html", product);

            var cartCtn = $('#cart-products-container');



            var productCard = $('<div id=cartProductCard'+ product.id +' class="flex items-center rounded-r-lg rounded-l-full min-h-12 h-12 pr-4 bg-orange-50 text-orange-950"></div>');
            var productImg = $('<img class="w-12 h-12 mr-4 object-fit border-2 border-orange-500 bg-orange-950 rounded-full object-fit" src="{{ asset("imgs/burguer.webp") }}" alt="">');
            var productInfo = $('<div class="flex flex-col justify-between text-base max-w-24 w-full h-full pt-2 pb-1"></div>');
            var productName = $('<p class="font-bold leading-none max-h-4 overflow-hidden whitespace-nowrap text-ellipsis">' + product.name + '</p>');
            var productPrice = $('<p class="leading-none max-h-4 overflow-hidden whitespace-nowrap text-ellipsis">' + product.price + ' €</p>');
            var productButtons = $('<div class="flex justify-between items-center ml-auto gap-2"></div>');
            var minusButton = $('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>');
            var quantity = $('<p class="flex items-center justify-center v leading-none w-4 text-xl text-center tabular-nums">' + product.quantity + '</p>');
            var plusButton = $('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>');

            productInfo.append(productName);
            productInfo.append(productPrice);

            productButtons.append(minusButton);
            productButtons.append(quantity);
            productButtons.append(plusButton);

            productCard.append(productImg);
            productCard.append(productInfo);
            productCard.append(productButtons);

            cartCtn.append(productCard);
        }


        function makeOrder()
        {

            // Obtener el token CSRF desde la etiqueta meta
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Configurar la solicitud AJAX con el token CSRF
            $.ajax({
                url: '{{ route('make.order') }}',
                method: 'POST',
                data: {
                    products: order
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response)
                {
                    console.log(response);
                },
                error: function(xhr, status, error)
                {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <style>

        .eat-here-main{
            display: flex;
            flex-direction: column;
            gap: 5rem;
            align-items: center;
            padding: 3rem;
        }



        .product-card{

            display: flex;
            flex-direction: column;
            /* border: 1px solid red; */
            min-width: 15rem;
            width: 15rem;
            height: fit-content;

        }
        .product-card img{
            width: fit-content;
            height: 6rem;
            width: 6rem;
            object-fit: contain;
            margin: 0 auto;
            /* border: 1px solid blue; */
        }


        .allergens{
            display: flex;
            width: fit-content;
            /* border: 1px solid green; */
            justify-content: center;
            gap: 0.5rem;
        }



    </style>


@endsection

