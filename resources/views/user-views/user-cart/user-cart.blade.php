<div id="cart" class="user-cart fixed bottom-0 top-[92vh] left-[10vw]  w-[80vw] h-[90vh] bg-orange-500 z-10 grid grid-rows-10 p-4 pt-0 gap-4 rounded-t-lg text-orange-100" style="transition: all 0.3s ease;">

    {{-- ENCABEZADO CARRITO --}}
    <div class="grid grid-cols-3 justify-items-center items-center  w-full  h-[8vh] pt-1 ">

        {{-- PRECIO TOTAL --}}
        <p class="order-total font-bold text-md">0 €</p>

        {{-- SVGS --}}
        <svg id="cart-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 animate-bounce mt-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
        </svg>

        <div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />

            </svg>
            <span class="cart-quantity flex items-center justify-center font-bold text-orange-950 w-5 h-5 bg-orange-50 rounded-full  relative -top-2 left-4 text-xs leading-none text-center whitespace-nowrap">
                0
            </span>

        </div>
        {{-- END SVGS --}}

    </div>

    <div class="w-full h-0.5 bg-orange-50 rounded-full my-auto"></div>

    {{-- TARJETAS DE PRODUCTOS DEL CARRITO --}}
    <div id="cart-products-container" class=" flex flex-col w-full gap-3 row-span-9 h-full overflow-scroll">

        {{-- @livewire('cart-product-card') --}}

    </div>

    {{-- BOTON FINALIZAR PEDIDO --}}
    <button onclick="makeOrder()" class="flex justify-center items-center bottom-4 w-full bg-orange-50 py-4 rounded-lg text-orange-950 font-bold row-span-1">

        Terminar pedido

    </button>

</div>


<script>


        const arrow = document.querySelector('#cart-arrow');
        const cart = document.querySelector('#cart');
        let cartIsOpen = false;


        arrow.addEventListener('click', function(){

            if (!cartIsOpen) {
                cart.style.transform = 'translateY(-90%)';
            } else {
                cart.style.transform = 'translateY(0%)';
            }
            arrow.classList.toggle('rotate-180');
            arrow.classList.toggle('animate-bounce');
            cartIsOpen = !cartIsOpen;

        })


        const cartProductsContainer = document.querySelector('#cart-products-container');
</script>
