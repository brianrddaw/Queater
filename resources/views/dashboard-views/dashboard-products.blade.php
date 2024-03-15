<div class="w-full h-full ">

    <div class="flex items-center   w-full h-[3.75rem]  ">
        {{-- SEARCH --}}
        <div class="flex items-center justify-center p-4 w-full h-full bg-zinc-200 text-orange-950">

            <input type="search" id="" name="" placeholder="Buscar  producto..." class=" w-full  h-full bg-transparent focus:outline-none"/>
            <button class="drop-shadow-lg ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </div>
        {{-- ADD BUTTON --}}
        <button class="bg-zinc-200 min-w-fit h-full p-4 border-l-4 border-walter-950 active:bg-zinc-300 font-bold text-orange-950 uppercase" onclick="addProduct()">Añadir</button>
    </div>

    <div class="w-full h-full flex flex-wrap p-4 gap-4">

        <form action="" method="post" class="w-[500px] h-[400px] mx-auto p-2 border border-red-500">
            @csrf
            <div class="grid grid-rows-2 border border-blue-500 h-full">

                {{-- IMG && INFO --}}
                <div class="grid grid-cols-2 ">
                    <div class="w-full ">
                        <img src="../imgs/burguer.webp" alt="" class="border border-indigo-500 object-cover h-48 w-full">

                    </div>
                    <div class="border border-yellow-500">
                        <input type="text" name="" id="name" placeholder="Nombre...">
                        <input type="number" name="" id="price" placeholder="Price...">
                        <select name="" id="category">
                            @foreach ($categories as  $category)

                                <option value="{{ $category->id }}">{{ $category->name }}</option>

                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- DESCRIPCIÓN --}}
                <div class=" w-full border border-pink-500">

                    <p>3</p>
                </div>

            </div>

        </form>


        {{-- @foreach ($products as  $product)
            <div class="card flex flex-col bg-walter-300  drop-shadow-[0_4px_3px_rgba(0,0,0,.3)] w-full h-32">
                <div class="flex justify-between">
                    <h3>{{ $product->name }}</h3>


                </div>
            </div>
        @endforeach --}}

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function addProduct() {

    }

</script>
