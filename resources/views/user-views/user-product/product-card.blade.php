<div class="product-card flex w-[400px] min-w-32 rounded-xl px-3 py-3 bg-stone-100 text-slate-800 drop-shadow-[0_3px_3px_rgba(0,0,0,.3)] text-base">

    <div class="flex flex-col gap-4 w-full">
        <div class="flex justify-between gap-4">
            <div class="flex items-center justify-center overflow-hidden w-14 h-14 bg-slate-950 rounded-full drop-shadow-[0_4px_3px_rgba(0,0,0,.3)]">
                <img  class="object-cover w-12 h-12 rounded-full" src="{{ "/storage/" . $product->image_url }}" alt="{{ $product->name }}">
            </div>

            <div class="flex flex-col gap-2 max-w-[180px] min-w-[180px]">

                <span class="flex text-left items-center whitespace-nowrap overflow-hidden w-full">
                    <h3 class="font-bold truncate">
                        {{ $product->name }}
                    </h3>
                </span>

                <div class="flex justify-between items-center">
                    <div class="info-button flex gap-1 items-center cursor-pointer">

                        <p>info</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="info-close-svg w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    </div>
                    <p class="h-fit leading-none">{{ $product->price }} €</p>
                </div>
            </div>

            <div class="price-add-container flex flex-wrap justify-center items-center w-fit gap-3">
                <button onclick="addToOrder({{ $product->id }},{{ $product->price }},'{{ $product->name }}','{{ $product->image_url }}')" class="add-to-order-button flex items-center text-md text-orange-50 bg-orange-500 w-fit p-1 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="product-card-info flex flex-wrap gap-2 bg-slate-100 p-2 rounded-sm mb-0">
            <span>
                <p>{{ $product->description }}</p>
            </span>
            <div class="flex flex-wrap gap-2 text-sm">
                @foreach ($product->allergens as $allergen)
                    <img  class="allergen cursor-pointer object-cover w-6 h-6 rounded-full"  src="{{ "/storage/" . $allergen->img_url }}" alt="{{ $allergen->name }}">
                @endforeach
            </div>

        </div>
    </div>

</div>




