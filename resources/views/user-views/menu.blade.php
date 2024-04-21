@extends('layouts.html-layout')
@section('title', 'User')
@section('content')
    @include ('user-views.components.slide-bar-component', ['categories' => $productsByCategory])
    <main class="eat-here-main flex flex-col items-center bg-stone-100 py-10 pb-20">
        @foreach ($productsByCategory as $category => $products)
            <article class="flex flex-col w-full h-full bg-stone-100 pb-10">
                <span id="{{ $category }}"></span>
                <h2 class="w-fit text-2xl text-orange-50 font-bold bg-orange-500 py-2 px-8 mb-8 mr-auto rounded-r">
                    {{ $category }}
                </h2>
                <ul class=" items-start justify-start">
                    <li class="flex flex-wrap  w-[90%]  rounded mx-auto justify-between gap-4">
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
                $('#cart').css('transform', 'translateY(0%)');
            }
        }

        function addToOrderAnimation(event) {
            const button = event.target.closest('.add-to-order-button');
            const buttonContainer = button.parentElement;
            button.disabled = true;


            button.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            `;
            button.classList.remove('bg-orange-500');
            button.classList.add('bg-green-600');
            setTimeout(function() {
                button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>`;
                button.classList.add('bg-orange-500');
                button.classList.remove('bg-green-600');
                button.disabled = false;
            }, 1000);


        }

        const buttons = document.querySelectorAll('.add-to-order-button');
        buttons.forEach(function(button) {
            button.addEventListener('click', addToOrderAnimation);
        });



        function addToOrderHtml(product, image_url)
        {
            var cartCtn = $('#cart-products-container');
            var productCard = $('<div id="cartProductCard' + product.id + '"class="cart-product-card flex justify-between mx-auto w-full max-w-[400px] min-w-32 rounded-xl px-3 py-3 bg-stone-100 text-orange-950 drop-shadow-[0_3px_3px_rgba(0,0,0,.3)] text-base"></div>');
            var productImg = $('<div class="flex items-center justify-center overflow-hidden w-14 h-14 bg-orange-950 rounded-full drop-shadow-[0_4px_3px_rgba(0,0,0,.3)]"><img class="object-cover w-12 h-12 rounded-full" src="/storage/'+ image_url + '" alt=""></div>');
            var productInfo = $('<div class="flex flex-col justify-between max-w-[180px] min-w-[180px]"></div>');
            var productName = $('<p class="font-bold leading-none max-h-4 overflow-hidden whitespace-nowrap text-ellipsis">' + product.name + '</p>');

            productInfo.append(productName);

            var quantity = $('<div class="flex justify-between items-center max-w-20"></div>');

            quantity.append('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 substract-button"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>');
            quantity.append('<p class="product-quantity flex items-center justify-center v leading-none w-4 text-lg text-center tabular-nums">' + product.quantity + '</p>');
            quantity.append('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 add-button"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>');
            productInfo.append(quantity);

            var productButtons = $('<div class="flex flex-col justify-between"></div>');
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

        function infoDisplay(card)
        {
            const infoContainer = $(card).closest('.product-card').find('.product-card-info');
            const infoCloseSvg = $(card).closest('.product-card').find('.info-close-svg');
            const isInfoVisible = infoContainer.hasClass('active');

            if (!isInfoVisible) {

                    infoContainer.addClass('active').css('display', 'flex').hide().slideDown(200);
                    infoCloseSvg.css('transform', 'rotate(45deg)');
                    infoCloseSvg.css('color', ' red');

            } else {

                infoContainer.slideUp(200, function() {
                    $(this).removeClass('active').css('display', 'none');
                    infoCloseSvg.css('color', '');
                });
                infoCloseSvg.css('transform', 'rotate(0deg)');

            }
        }

        function setOrderTotalAndSubmitForm()
        {
            toggleLoader();
            document.getElementById('checkout-btn').disabled = true;
            const orderJSON = JSON.stringify({ order: order });;
            document.getElementById('order-input').value = orderJSON;
            document.getElementById("order-total-input").value = orderTotal;
            document.getElementById("take-away-input").value = {{ $takeAway }};
            document.getElementById("table-id-input").value = {{ $tableId }};
            document.getElementById("checkout-form").submit();
        }
    </script>

    <style>
        article:nth-child(even) {
            background-color: #e7e5e4;
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
            transition: all .2s ease;
        }

        .add-to-order-button {
            transition: all .4s ease-out;
        }
    </style>

@endsection

