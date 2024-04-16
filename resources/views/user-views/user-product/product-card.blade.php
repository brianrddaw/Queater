<div class="product-card gap-1 flex flex-col w-[100px] min-w-32 items-center  rounded-xl py-3  bg-gray-100 text-orange-950 drop-shadow-[0_4px_3px_rgba(0,0,0,.3)] transition-all">

    <div class="flex items-center justify-center overflow-hidden w-24 h-24 bg-orange-950 rounded-full drop-shadow-[0_4px_3px_rgba(0,0,0,.3)]">
        <img  class="object-cover w-20 h-20 rounded-full" src="{{ "/storage/" . $product->image_url }}" alt="{{ $product->name }}">
    </div>

    <div class="info-button flex gap-1 items-center cursor-pointer mt-2">

        <p class="text-lg">info</p>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="info-close-svg w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>

    </div>

    <span class="flex justify-center items-center whitespace-nowrap overflow-hidden w-full px-4">
        <h3 class="font-bold text-md truncate">
            {{ $product->name }}
        </h3>
    </span>


    <div class="price-add-container flex flex-wrap justify-center items-center gap-3">
        <p class="text-lg h-fit leading-none mt-1">{{ $product->price }} €</p>

        <button onclick="addToOrder({{ $product->id }},{{ $product->price }},'{{ $product->name }}','{{ $product->image_url }}')" class="flex items-center text-md text-orange-50 bg-orange-500 py-1 px-6 w-fit min-h-10 rounded-full active:bg-green-500 active:scale-105">
            Añadir
            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg> --}}

        </button>
    </div>


    <div class="product-card-info flex flex-col gap-2 bg-walter-300 p-2 rounded-sm m-2 mb-0">

        <div class="font-bold">

            <p>{{ $product->description }}</p>

        </div>

        <div class="flex gap-2 text-sm">
            @foreach ($product->allergens as $allergen)

                <img  class="allergen  cursor-pointer object-cover w-6 h-6 rounded-full"  src="{{ "/storage/" . $allergen->img_url }}" alt="{{ $allergen->name }}">

            @endforeach
        </div>

    </div>
</div>




