<div id="cart" class="user-cart fixed bottom-0 top-[92vh] w-full h-[90vh] bg-orange-50 z-10 grid grid-rows-10 rounded-t text-orange-950 transition-all border-t-4 border-orange-950" >

    <div id="cart-header" class="grid grid-cols-3 justify-items-center items-center w-full  h-[8vh] pt-1 row-span-2">
        <span class="flex gap-2 mr-auto pl-4">
            <p class="font-bold text-md ">Total:</p>
            <p class="order-total font-bold text-md">0 €</p>
        </span>

        <svg id="cart-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 animate-bounce mt-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
        </svg>

        <div class="ml-auto pr-8">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />

            </svg>
            <span class="cart-quantity flex items-center justify-center font-bold text-orange-50 w-5 h-5 border border-orange-950 bg-orange-950 rounded-full  relative -top-2 left-4 text-xs leading-none text-center whitespace-nowrap">
                0
            </span>

        </div>

    </div>

    <div id="cart-products-container" class=" flex flex-col p-4 row-span-6 w-full gap-3  h-full overflow-scroll">
    </div>

    <form id="checkout-form" action="/checkout" method="POST" class="flex justify-center items-center w-full row-span-4">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="orderTotal" id="order-total-input" value="">
        <input type="hidden" name="order" id="order-input" value="">
        <input type="hidden" name="takeAway" id="take-away-input" value="">
        @csrf
        <button onclick="setOrderTotalAndSubmitForm()" id="checkout-btn" type="button"
            class="
                flex justify-center items-center
                w-[21.44rem]
                p-4
                font-bold
                rounded
                text-orange-50
                bg-orange-500"
            >
            Terminar pedido
        </button>
    </form>

</div>

<script>
    const header = document.querySelector('#cart-header');
    const arrow = document.querySelector('#cart-arrow');
    const cart = document.querySelector('#cart');
    let cartIsOpen = false;

    header.addEventListener('click', function(){

        if (!cartIsOpen) {
            cart.style.transform = 'translateY(-90%)';
        } else {
            cart.style.transform = 'translateY(-10%)';
        }
        arrow.classList.toggle('rotate-180');
        arrow.classList.toggle('animate-bounce');
        cartIsOpen = !cartIsOpen;

    })

    const cartProductsContainer = document.querySelector('#cart-products-container');
</script>
