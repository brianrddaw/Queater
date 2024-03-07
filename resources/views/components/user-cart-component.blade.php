<div id="cart" class="user-cart fixed bottom-0 top-[54vh] left-[10vw]  w-[80vw] h-[90vh] bg-orange-500 z-10 grid grid-rows-12 p-4 pt-0 rounded-t-lg text-orange-100">

    <div class="grid grid-cols-3 justify-items-center items-center  w-full  h-[6vh]">

        <p class="font-bold text-md">{{ $total }} €</p>

        <svg id="cart-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 animate-bounce mt-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
        </svg>

    </div>

    <div id="cart-products-container" class="border border-blue-700 flex flex-col gap-3 row-span-11 h-full ">

        <x-cart-product-card-component  total="10" name="Hamburguesa" quantity="1"/>

    </div>

    <button onclick="makeOrder()" class="sticky bottom-4 w-full bg-orange-50 py-4 rounded-lg text-orange-950 font-bold">

        Terminar pedido

    </button>
</div>


<style>

    .user-cart{
        transition: all 0.3s ease;
    }

    /* .user-cart::before{
        content: '';
        position: absolute;
        left: 0;
        bottom: 100%;
        background-image: linear-gradient(to top, white, transparent);
        width: 100%;
        height: calc(100%*2);
    } */

</style>


<script>


        const arrow = document.querySelector('#cart-arrow');
        const cart = document.querySelector('#cart');
        let cartIsOpen = false;


        arrow.addEventListener('click', function(){

            if (!cartIsOpen) {
                cart.style.transform = 'translateY(-90%)';
            } else {
                cart.style.transform = 'translateY(-0%)';
            }
            arrow.classList.toggle('rotate-180');
            arrow.classList.toggle('animate-bounce');
            cartIsOpen = !cartIsOpen;

        })


        const cartProductsContainer = document.querySelector('#cart-products-container');



</script>
