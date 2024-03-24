<div class="product-card gap-2 rounded-lg p-4 w-[300px] bg-gray-100 text-orange-950 drop-shadow-[0_4px_3px_rgba(0,0,0,.3)]">
    <div class="flex h-10 ">

        {{-- IMG --}}
        <div class="flex items-center justify-center overflow-hidden w-24 h-24 relative bottom-16 right-2 bg-orange-500 rounded-full drop-shadow-[0_4px_3px_rgba(0,0,0,.3)]">
            <img  class="object-cover w-20 h-20 rounded-full" src="{{ "/storage/" . $product->image_url }}" alt="{{ $product->name }}">
        </div>


        {{-- INFO BUTTON--}}
        <div class="info-button flex gap-1 items-center cursor-pointer">

            <p class="text-lg">info</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="info-close-svg w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

        </div>
    </div>

    <div class="flex flex-col">
        <h2 class="font-bold text-md text-left overflow-hidden whitespace-nowrap text-ellipsis"> {{ $product->name }}</h2>
    </div>

    <div class="flex items-end justify-between h-fit mt-2">
        <p class="text-lg h-fit leading-none">{{ $product->price }} €</p>

        <button onclick="addToOrder({{ $product->id }},{{ $product->price }},'{{ $product->name }}','{{ $product->image_url }}')" class="flex items-center text-md text-orange-50 bg-orange-500 py-1 px-2 rounded active:bg-orange-400 active:scale-105">
            Añadir
        </button>
    </div>

    {{-- DESCRIPTION CONTAINER --}}
    <div class="product-card-info flex flex-col gap-2 bg-walter-300 p-2 rounded-sm mt-2">

        <div class="font-bold">

            <p>{{ $product->description }}</p>

        </div>

        {{-- Lista de alergenos --}}
        <div class="flex gap-2 text-sm ">
            @foreach ($product->allergens as $allergen)


                {{ $allergen->name }}

            @endforeach
        </div>

    </div>
</div>




