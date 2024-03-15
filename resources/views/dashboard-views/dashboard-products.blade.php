<div class="w-full h-full ">
    <div class="flex items-center w-full h-[3.75rem] ">
        {{-- SEARCH --}}
        <div class="flex items-center justify-center  w-[80%] h-full bg-zinc-200 p-2 pr-6 ">
            <input type="search" id="" name="" placeholder="Buscar  producto..." class="p-4 w-full  h-full bg-transparent focus:outline-none"/>
            <button class="drop-shadow-lg ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-orange-950">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </div>

         {{-- BOTÓN AÑADIR --}}
        <button class="bg-walter-600 min-w-fit px-6 w-[20%] h-full text-orange-950 font-bold active:bg-zinc-300 ">
            Añadir
        </button>
    </div>
    <div class="flex flex-wrap gap-4 items-center justify-center w-full h-fit p-4 ">

        @foreach ($products as $product)

            <div class="product-card gap-2 rounded-lg p-4 w-full h-[200px] bg-gray-100 text-orange-950 drop-shadow-[0_4px_3px_rgba(0,0,0,.3)] ">
                <div class="flex w-full px-2 items-center justify-between">
                    <h2>{{ $product->name }}</h2>
                    <img src="../imgs/burguer.webp" alt="" class="w-16 bg-orange-500 rounded-full">
                </div>

            </div>

        @endforeach

    </div>

</div>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>



</script> --}}
