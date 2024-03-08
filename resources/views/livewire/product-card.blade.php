<div class="product-card gap-2 rounded-lg p-4 bg-gray-100 text-orange-950">
    <div class="flex h-10 ">
        <img class="relative bottom-16 right-8 bg-orange-500 rounded-full drop-shadow-[0_4px_3px_rgba(0,0,0,.3)]" src="../imgs/burguer.webp" alt="product_image">

        <div class="flex gap-1 items-center">

            <p class="text-lg">info</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

        </div>
    </div>

    <div class="flex flex-col">
        <h2 class="font-bold text-md text-left overflow-hidden whitespace-nowrap text-ellipsis"> {{ $product->name }}</h2>
    </div>

    <div class="flex items-end justify-between h-fit mt-2">
        <p class="text-lg h-fit leading-none">{{ $product->price }} €</p>

        {{-- BOTON AÑADIR AL CARRITO --}}
        <button onclick="addToOrder({{ $product->id }}, {{ $product->price }})" class="flex items-center text-md text-orange-50 bg-orange-500 py-1 px-2 rounded">
            Añadir
        </button>
    </div>


</div>






