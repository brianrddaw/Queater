@extends('layouts.html-layout')

@section('title', 'User')
@section('content')
    @include ('user-views.components.slide-bar-component', ['categories' => $productsByCategory])
    <main class="eat-here-main flex flex-col items-center pb-36 bg-orange-100">

        @foreach ($productsByCategory as $category => $products)
            <article class="flex flex-col w-full bg-orange-100 gap-6 pb-20 pt-6">
                <h2
                id="{{ $category }}"
                class="
                    w-fit
                    text-2xl
                    text-orange-50
                    font-bold
                    bg-orange-500
                    py-2
                    px-8
                    mb-8
                    mr-auto
                    rounded-r
                    "
                >
                    {{ $category }}
                </h2>
                <ul class=" items-start justify-start">
                    <li class="flex flex-wrap  w-[80%]  rounded mx-auto justify-between gap-8">
                        @foreach ($products as $product)
                            @if ($product->availability)
                                    @include('user-views.user-product.product-card', ['product' => $product])

                            @endif
                        @endforeach
                    </li>
                </ul>
            </article>
        @endforeach

        @include('user-views.user-cart.user-cart', ['orders' => []])

    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var order = {};
        var orderTotal = 0;
        var cartProductsQuantity = 0;

        window.onload = function()
        {
            if (Object.keys(order).length == 0) {
                $('#cart').css('transform', 'translateY(10%)');
            }

            $('.info-button').on('click', function()
            {
                infoDisplay(this);
            });
        }

        function addToOrder(id, price, name, image_url)
        {
            if (order[id]) {
                order[id].quantity++;

                let productCard = $('#cartProductCard' + id);
                productCard.find('.product-quantity').text( order[id].quantity );
            }
            else {
                order[id] = {
                    id: id,
                    name: name,
                    price: price,
                    quantity: 1,
                };
                addToOrderHtml(order[id], image_url);
            }

            cartProductsQuantity ++;
            updateCartQuantityText(cartProductsQuantity);

            orderTotal += price;
            $('.order-total').text(orderTotal.toFixed(2) + ' €');

            if(Object.keys(order).length = 1) {
                $('#cart').css('transform', 'translateY(-10%)');
            }
            console.log(order);
        }

        function addToOrderHtml(product, image_url)
        {
            var cartCtn = $('#cart-products-container');
            var productCard = $('<div id="cartProductCard' + product.id + '"class="cart-product-card max-w-[600px] grid grid-cols-10 items-center rounded  min-h-16 h-16 bg-orange-50 drop-shadow-lg text-orange-950 text-xs"></div>');
            var productImg = $('<img class="col-span-2 w-16 h-16 object-fit border-2 border-orange-500 bg-orange-500 rounded-l object-cover" src="/storage/'+ image_url + '" alt="">');
            var productInfo = $('<div class="flex flex-col justify-between pl-1 py-1 text-base m w-full h-full col-span-6 "></div>');
            var productName = $('<p class="font-bold leading-none max-h-4 overflow-hidden whitespace-nowrap text-ellipsis">' + product.name + '</p>');

            productInfo.append(productName);

            var quantity = $('<div class="flex justify-between items-center max-w-20"></div>');

            quantity.append('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 substract-button"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>');
            quantity.append('<p class="product-quantity flex items-center justify-center v leading-none w-4 text-lg text-center tabular-nums">' + product.quantity + '</p>');
            quantity.append('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 add-button"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>');
            productInfo.append(quantity);

            var productButtons = $('<div class="flex flex-col justify-between py-1 pr-1 w-full max-full h-full col-span-2"></div>');
            var deleteIcon = $('<div class="delete-product-button cursor-pointer flex items-center gap-2 ml-auto"></div>');
            deleteIcon.append('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="red" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>');
            productButtons.append(deleteIcon);
            var productPrice = $('<p class="leading-none max-h-4 overflow-hidden whitespace-nowrap text-ellipsis text-sm ml-auto ">' + product.price + ' €</p>');

            productButtons.append(productPrice);
            productCard.append(productImg);
            productCard.append(productInfo);
            productCard.append(productButtons);

            cartCtn.append(productCard);
            cartCtn.append(productCard.hide().fadeIn(150));

            $('.delete-product-button').off('click');
            $('.substract-button').off('click');
            $('.add-button').off('click');

            $('.delete-product-button').on('click', function()
            {
                removeFromOrder($(this).closest('.cart-product-card'))
            });

            $('.substract-button').on('click', function()
            {
                modifyQuantity($(this), -1);
            });

            $('.add-button').on('click', function()
            {
                modifyQuantity($(this), 1);
            });
        }

        function updateCartQuantityText(quantity)
        {
            $('.cart-quantity').text(quantity);
        }

        function modifyQuantity($element, amount)
        {
            const productCard = $element.closest('.cart-product-card');
            const productQuantity = productCard.find('.product-quantity');
            const idProduct = productCard.attr('id').replace('cartProductCard', '');

            const newQuantity = parseInt(productQuantity.text()) + amount;
            if (newQuantity < 1) return;

            cartProductsQuantity += amount;
            productQuantity.text(newQuantity);
            updateCartQuantityText(cartProductsQuantity);

            orderTotal += amount * order[idProduct].price;
            orderTotal = Math.max(0, orderTotal);
            $('.order-total').text(orderTotal.toFixed(2) + '€');

            order[idProduct].quantity += amount;
        }

        function removeFromOrder($productCard)
        {
            const idProduct = $productCard.attr('id').replace('cartProductCard', '');

             if (order[idProduct]) {
                const quantityToRemove = order[idProduct].quantity;
                cartProductsQuantity -= quantityToRemove;
                updateCartQuantityText(cartProductsQuantity);

                orderTotal -= order[idProduct].price * quantityToRemove;
                orderTotal = Math.max(0, orderTotal);
                $('.order-total').text(orderTotal.toFixed(2) + '€');

                delete order[idProduct];

                $productCard.fadeOut(150, function()
                {
                    $(this).remove();
                });
            }
        }

        function makeOrder()
        {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{ route('make.order') }}',
                method: 'POST',
                data: {
                    products: order,
                    takeAway: {{ $takeAway }},
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response)
                {
                    $("#error").html(response);

                    console.log(response);
                    window.location.href = "{{ route('payment.checkout') }}";
                },
                error: function(xhr, status, error)
                {
                    console.error(xhr.responseText);
                }
            });
        }


        function infoDisplay(card)
        {
            const infoContainer = $(card).closest('.product-card').find('.product-card-info');
            const infoCloseSvg = $(card).closest('.product-card').find('.info-close-svg');
            const isInfoVisible = infoContainer.hasClass('active');

            if (!isInfoVisible) {
                $(card).closest('.product-card').css('width', '300px');

                setTimeout(() => {
                    infoContainer.addClass('active').css('display', 'flex').hide().slideDown(200);
                    infoCloseSvg.css('transform', 'rotate(45deg)');
                    infoCloseSvg.css('color', ' red');
                }, 200);

            } else {

                infoContainer.slideUp(200, function() {
                    $(this).removeClass('active').css('display', 'none');
                    infoCloseSvg.css('color', '');
                });
                infoCloseSvg.css('transform', 'rotate(0deg)');

                $(card).closest('.product-card').css('width', '100px');
                setTimeout(() => {

                }, 200);
            }
        }

        function setOrderTotalAndSubmitForm()
        {
            document.getElementById('checkout-btn').disabled = true;
            const orderJSON = JSON.stringify({ order: order });;
            document.getElementById('order-input').value = orderJSON;
            document.getElementById("order-total-input").value = orderTotal;
            document.getElementById("take-away-input").value = {{ $takeAway }};
            document.getElementById("checkout-form").submit();
        }
    </script>

    <style>

        article:nth-child(even) {
            background-color: #fff7ed;
        }

        .product-card {
            height: fit-content;
            transition: all .2s ease-in-out;
        }

        .product-card-info {
            display: none;
            overflow: hidden;
            height: 0;
        }

        .product-card-info.active {
            height: auto;
        }

        .info-close-svg {
            transition: all .4s ease;
        }
    </style>
@endsection

