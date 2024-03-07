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
        <h2 class="font-bold text-md text-left overflow-hidden whitespace-nowrap text-ellipsis"> {{ $name }}</h2>
        {{-- <p class="description">{{ $description }}</p> --}}
    </div>
        {{-- <span class="allergens">
            <div class="w-6 h-6 bg-orange-500 rounded-full"></div>
            <div class="w-6 h-6 bg-orange-500 rounded-full"></div>
            <div class="w-6 h-6 bg-orange-500 rounded-full"></div>
            <div class="w-6 h-6 bg-orange-500 rounded-full"></div>
        </span> --}}
    <div class="flex items-end justify-between h-fit mt-2">
        <p class="text-lg h-fit leading-none">{{ $price }} €</p>
        <button onclick="addToOrder({{ $id }})" class="flex items-center text-md text-orange-50 bg-orange-500 py-1 px-2 rounded">
            Añadir
        </button>
    </div>

</div>



<style>
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

    /* .description {
        max-width: 280px;
        width: fit-content;
        height: fit-content;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    } */


    .allergens{
        display: flex;
        width: fit-content;
        /* border: 1px solid green; */
        justify-content: center;
        gap: 0.5rem;
    }


</style>


