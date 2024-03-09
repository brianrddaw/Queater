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


        @include('user-views.user-cart.user-cart', ['orders' => []])

    </main>


    {{-- Import para usar Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        var order = {};
        var orderTotal = 0;
        var cartProductsQuantity = 0;


        window.onload = function()
        {
            // validar si hay algo en el carrito para mostrarlo
            if (Object.keys(order).length == 0) {
                $('#cart').css('transform', 'translateY(10%)');
            }

        }

        function addToOrder(id, price, name)
        {

            if (order[id])
            {
                order[id].quantity++;

                // Actualizar la tarjeta
                let productCard = $('#cartProductCard' + id);
                productCard.find('.product-quantity').text( order[id].quantity );

            }
            else
            {
                order[id] = {
                    id: id,
                    name: name,
                    price: price,
                    quantity: 1,

                };

                addToOrderHtml(order[id]);
            }

            cartProductsQuantity ++;
            updateCartQuantityText(cartProductsQuantity);

            orderTotal += price;
            $('.order-total').text(orderTotal.toFixed(2) + ' €');

            if(Object.keys(order).length = 1){
                $('#cart').css('transform', 'translateY(0%)');
            }



        }


        function addToOrderHtml(product) {

            // Obtener el contenedor del carrito
            var cartCtn = $('#cart-products-container');

            // Crear la tarjeta
            var productCard = $('<div id="cartProductCard' + product.id + '"class="cart-product-card max-w-80 grid grid-cols-9 items-center rounded  min-h-14 h-14 bg-orange-50 text-orange-950 text-xs"></div>');

            // IMG
            var productImg = $('<img class="col-span-2 w-14 h-14 object-fit border-2 border-orange-950 bg-orange-950 rounded-l object-cover" src="{{ asset('imgs/burguer.webp') }}" alt="">');

            // INFO CONTAINER
            var productInfo = $('<div class="flex flex-col justify-between pl-1 py-1 text-base m w-full h-full col-span-5 "></div>');


            // PRODUCT NAME
            var productName = $('<p class="font-bold leading-none max-h-4 overflow-hidden whitespace-nowrap text-ellipsis">' + product.name + '</p>');
            productInfo.append(productName);


            // QUANTITY

            // QUANTITY CONTAINER
            var quantity = $('<div class="flex justify-between items-center max-w-20"></div>');

            quantity.append('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 substract-button"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>');
            quantity.append('<p class="product-quantity flex items-center justify-center v leading-none w-4 text-lg text-center tabular-nums">' + product.quantity + '</p>');
            quantity.append('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 add-button"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>');
            productInfo.append(quantity);


            // DELETE ICON & PRICE
            var productButtons = $('<div class="flex flex-col justify-between py-1 pr-1 w-full max-full h-full col-span-2"></div>');


            // DELETE ICON
            var deleteIcon = $('<div class="delete-product-button cursor-pointer flex items-center gap-2 ml-auto"></div>');
            deleteIcon.append('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>');
            productButtons.append(deleteIcon);

            // PRICE
            var productPrice = $('<p class="leading-none max-h-4 overflow-hidden whitespace-nowrap text-ellipsis text-sm ml-auto ">' + product.price + ' €</p>');
            productButtons.append(productPrice);


            // Agregar los elementos a la tarjeta
            productCard.append(productImg);
            productCard.append(productInfo);
            productCard.append(productButtons);

            // Agregar la tarjeta al contenedor del carrito
            cartCtn.append(productCard);

            // Agregar la tarjeta al contenedor del carrito
            cartCtn.append(productCard.hide().fadeIn(150));


            // Desasociar eventos de los elementos existentes
            $('.delete-product-button').off('click');
            $('.substract-button').off('click');
            $('.add-button').off('click');

            // Volver a asociar los eventos a los elementos
            $('.delete-product-button').on('click', function() {
                removeFromOrder($(this).closest('.cart-product-card'))
            });

            $('.substract-button').on('click', function() {
                modifyQuantity($(this), -1);
            });

            $('.add-button').on('click', function() {
                modifyQuantity($(this), 1);
            });



        }


        function updateCartQuantityText(quantity){
            $('.cart-quantity').text(quantity);
        }

        // Función genérica para modificar la cantidad
        function modifyQuantity($element, amount) {
            const productCard = $element.closest('.cart-product-card');
            const productQuantity = productCard.find('.product-quantity');
            const idProduct = productCard.attr('id').replace('cartProductCard', '');

            const newQuantity = parseInt(productQuantity.text()) + amount;
            if (newQuantity < 1) return;

            // Actualizar el carrito
            cartProductsQuantity += amount;
            productQuantity.text(newQuantity);
            updateCartQuantityText(cartProductsQuantity);

            // Actualizar el total
            orderTotal += amount * order[idProduct].price;
            orderTotal = Math.max(0, orderTotal);
            $('.order-total').text(orderTotal.toFixed(2) + '€');

            // Actualizar el array de orden
            order[idProduct].quantity += amount;
        }


    // Función para eliminar un producto del pedido
        function removeFromOrder($productCard) {
            const idProduct = $productCard.attr('id').replace('cartProductCard', '');

             if (order[idProduct]) {
                // Actualizar el carrito
                const quantityToRemove = order[idProduct].quantity;
                cartProductsQuantity -= quantityToRemove;
                updateCartQuantityText(cartProductsQuantity);

                // Actualizar el total
                orderTotal -= order[idProduct].price * quantityToRemove;
                orderTotal = Math.max(0, orderTotal);
                $('.order-total').text(orderTotal.toFixed(2) + '€');

                // Actualizar el array de orden
                delete order[idProduct];

                // Eliminar el elemento HTML del carrito
                $productCard.fadeOut(150, function() {
                    $(this).remove();
                });
            }
        }
        // function addQuantity($element){

        //     //  obtenemos la id tarjeta
        //     let productCard = $element.parent().parent().parent();
        //     let productQuantity = productCard.find('.product-quantity');

        //     idProduct = productCard.attr('id').replace('cartProductCard', '');

        //    // actualizar el carrito
        //     cartProductsQuantity ++;
        //     productQuantity.text(cartProductsQuantity);
        //     updateCartQuantityText(cartProductsQuantity);

        //     // actualizar el total
        //     orderTotal += order[idProduct].price;
        //     orderTotal = Math.max(0, orderTotal); // Asegurarse de que el total nunca sea menor que cero
        //     $('.order-total').text(orderTotal.toFixed(2) + '€');


        //     order[idProduct].quantity++;

        // }

        // function substractQuantity($element){


        //     //  obtenemos la id tarjeta
        //     let productCard = $element.parent().parent().parent();
        //     let productQuantity = productCard.find('.product-quantity');

        //     idProduct = productCard.attr('id').replace('cartProductCard', '');

        //     if (productQuantity.text() == 1) {
        //         return;
        //     }

        //    // actualizar el carrito
        //     cartProductsQuantity --;
        //     productQuantity.text(cartProductsQuantity);
        //     updateCartQuantityText(cartProductsQuantity);

        //     // actualizar el total
        //     orderTotal -= order[idProduct].price;
        //     orderTotal = Math.max(0, orderTotal); // Asegurarse de que el total nunca sea menor que cero
        //     $('.order-total').text(orderTotal.toFixed(2) + '€');


        //     order[idProduct].quantity--;



        // }




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

