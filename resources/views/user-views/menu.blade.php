@extends('layouts.html-layout')

@section('title', 'User')
@section('navegacion')
    {{-- <a href="{{ route('dashboard.main') }}" class="border-b-2 border-red-500 text-xl m-auto ">Menu</a>
    <a href="{{ route('kitchen.main') }}" class="border-b-2 border-red-500 text-xl m-auto ">Orden</a>
    <a href="{{ route('logout') }}" class="border-b-2 border-red-500 text-xl m-auto ">Cerrar sesión</a> --}}
@endsection
@section('content')

    <main  class="eat-here-main">

        <h2 class="text-2xl text-orange-950 font-bold border-b-2 border-orange-500">HAMBURGUESAS</h2>

        @foreach ( $products as $product )
            @if ($product->availability)
                @include('user-views.user-product.product-card', ['product' => $product])
            @endif
        @endforeach


        @include('user-views.user-cart.user-cart', ['order' => []])

    </main>


    {{-- Import para usar Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        var order = {};

        function addToOrder($product)
        {
            if (order[$product.id])
            {
                order[$product.id].quantity++;
            }
            else
            {
                order[$product.id] = {
                    id: $product.id,
                    name: $product.name,
                    price: $product.price,
                    quantity: 1
                };
            }

            // console.log("Este es el producto", $product);
            // console.log("Este es el pedido", order);

            addToOrderHtml($product);

        }

        function addToOrderHtml($product){
            console.log("Este es el producto para html", $product);
            $
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

