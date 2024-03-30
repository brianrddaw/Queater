@extends('dashboard-views.dashboard')

@section('dashboard-content')
    <div class="flex items-center w-full h-[3.75rem]">
        {{-- SEARCH --}}
        <div class="flex items-center justify-center p-4 w-full h-full bg-walter-400 text-orange-950">

            <input type="search" id="" name="" placeholder="Buscar  producto..." class=" w-full  h-full bg-transparent focus:outline-none "/>
            <button class="drop-shadow-lg ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </div>
        {{-- ADD BUTTON --}}
        <button class="bg-walter-400 min-w-fit h-full p-4 border-l-4  active:bg-walter-300 font-bold text-orange-950 uppercase" onclick="showAddProductForm()">Añadir</button>
    </div>

    <section class="flex flex-wrap w-[100%] h-fit p-3 gap-3">

        @foreach($categories as $category)
        <div class="card flex flex-col w-[calc(50%-0.4rem)]  bg-walter-300  rounded drop-shadow-xl	">
            <div class="flex justify-center items-center w-full h-32 overflow-hidden ">
                <img src="/storage/categories_images/batidos.webp" alt="" class="w-full rounded-t opacity-70">
                <h3 class="card-title absolute text-2xl font-bold text-orange-950">
                    {{ $category->name }}
                </h3>
            </div>
            <div class="card grid grid-cols-3 w-full rounded">
                <button class="bg-walter-400 p-4 w-full font-bold text-green-600 col-span-2" onclick="editCategorie({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}', {{ $category->position }})">Editar</button>
                <button class="bg-red-400 text-red-900 m-w-fit w-full p-2 ml-auto rounded-r font-bold" onclick="deleteCategorie({{ $category->id }})">Eliminar</button>
            </div>

        </div>
        @endforeach
    </section>

@endsection

<script>


    function createNewCategorie() {
        console.log('createNewCategorie');
    }

    function editCategorie(categoryId, categoryName, categoryDescription, categoryPosition) {
        console.log('editCategorie: ', arguments);
    }

    function deleteCategorie() {
        console.log('deleteCategorie');
    }

</script>
