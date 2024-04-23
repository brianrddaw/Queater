<div id="cart" class="user-cart hidden grid-rows-10 fixed bottom-0 w-full h-[75vh] bg-stone-100 text-orange-950 py-4 pt-4" >

    <div id="cart-products-container" class="flex flex-col w-[100%] p-4 mx-auto row-span-8  gap-3  h-full overflow-y-scroll">
    </div>

    <form id="checkout-form" action="/checkout" method="POST" class="flex justify-center w-full h-full row-span-2 pt-2">
        <input class="hidden" type="hidden" name="_token" value="{{ csrf_token() }}">
        <input class="hidden" type="hidden" name="orderTotal" id="order-total-input" value="">
        <input class="hidden" type="hidden" name="order" id="order-input" value="">
        <input class="hidden" type="hidden" name="takeAway" id="take-away-input" value="">
        <input class="hidden" type="hidden" name="tableId" id="table-id-input" value="">
        @csrf
        <button onclick="setOrderTotalAndSubmitForm()" id="checkout-btn" type="button"
            class="
                flex justify-center items-center
                w-full
                max-w-[350px]
                h-12

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

    header.addEventListener('click', function() {
    if (!cartIsOpen) {
        header.style.transform = 'translateY(-66vh)';
        $('#cart')
        .css('display', 'grid')
        .slideDown({ duration: 150, easing: 'ease-in-out' }); // Use smoother animation

    } else {
        header.style.transform = 'translateY(-0)';
        $('#cart')
        .hide()
        .slideUp({ duration: 150, easing: 'ease-in-out' }); // Use smoother animation
    }
    arrow.classList.toggle('rotate-180');
    arrow.classList.toggle('animate-bounce');
    cartIsOpen = !cartIsOpen;
    });

    const cartProductsContainer = document.querySelector('#cart-products-container');
</script>
