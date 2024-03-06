{{-- <div  class=" grid grid-cols-2  border-2 border-red-500 h-fit w-60 rounded-md">
    <div class="row-span-2 h-fit w-fit">
        <img class="w-20  " src="../imgs/burguer.webp" alt="product_image">
        <span class="flex gap-1 ">
            <div class="w-4 h-4 bg-orange-500 rounded-full"></div>
            <div class="w-4 h-4 bg-orange-500 rounded-full"></div>
            <div class="w-4 h-4 bg-orange-500 rounded-full"></div>
            <div class="w-4 h-4 bg-orange-500 rounded-full"></div>
        </span>
    </div>
    <div class="h-fit">
        <h2 class="font-bold text-xs border-2 border-red-500 h-fit max-h-10   text-ellipsis overflow-hidden">{{ $name }}</h2>
        <p class="text-xs  w-full h-10 text-ellipsis overflow-hidden">{{ $description }}</p>
    </div>
    <div class="flex items-end justify-between h-fit ">
        <p class="text-xs ">{{ $price }}</p>
        <button onclick="addToOrder({{ $id }})" class="flex items-center text-xs">
            Añadir
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>


    </div>
</div> --}}


<div class="product-card">
        <img src="../imgs/burguer.webp" alt="product_image">

    <div>
        <h2 class="font-bold text-lg"> {{ $name }}</h2>
        <p class="text-md  w-full h-10 text-ellipsis overflow-hidden">{{ $description }}</p>
    </div>
            <span class="allergens">
            <div class="w-6 h-6 bg-orange-500 rounded-full"></div>
            <div class="w-6 h-6 bg-orange-500 rounded-full"></div>
            <div class="w-6 h-6 bg-orange-500 rounded-full"></div>
            <div class="w-6 h-6 bg-orange-500 rounded-full"></div>
        </span>
    <div class="flex items-end justify-between h-fit ">
        <p class="text-lg ">{{ $price }} €</p>
        <button onclick="addToOrder({{ $id }})" class="flex items-center text-xs">
            Añadir
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>

    </div>

</div>



<style>
    .product-card{
        display: flex;
        flex-direction: column;
        border: 1px solid red;
        min-width: 100%;
        min-height: 5rem;


    }
    .product-card img{
        width: 100%;
        height: 10rem;
        object-fit: contain;
        border: 1px solid blue
    }




    .allergens{
        display: flex;
        width: fit-content;
        border: 1px solid green;
        justify-content: center;
        gap: 0.5rem;
    }


</style>


