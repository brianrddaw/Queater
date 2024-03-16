
@extends('dashboard-views.dashboard')

@section('dashboard-content')

<div class="flex flex-col w-full h-full">

    <div class="flex items-center w-full h-[3.75rem]">
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
        <button class="bg-zinc-200 min-w-fit h-full p-4 border-l-4 border-walter-950 active:bg-zinc-300 font-bold text-orange-950 uppercase" onclick="showAddProductForm()">Añadir</button>
    </div>

    <div class="flex  flex-wrap w-[100%] h-[calc(100vh-7.25rem)] p-6 gap-4  overflow-y-scroll">
        @foreach ($products as  $product)
            <div class="card flex flex-col w-full h-[200px] bg-walter-300 border border-red-500">
                <div class="flex justify-between">
                    <h3>{{ $product->name }}</h3>


                </div>
            </div>
        @endforeach
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function showAddProductForm() {
        Swal.fire({
            title: 'Agregar Producto',
            html: `
                <form action="" id="form-new-products" method="post" class="w-full h-[400px] mx-auto  rounded-lg  text-orange-950">
                    @csrf
                    <div class="grid grid-rows-2 h-full gap-4">


                        <div class="grid grid-cols-2 gap-4">

                            <div class="flex flex-col items-center justify-center p-2 w-full bg-walter-200 rounded-lg h-full">
                                <label for="image" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14 text-walter-900 h-full active:scale-110 hover:cursor-pointer active:text-walter-950">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </label>
                                <input type="file" id="image" name="image" accept="image/*" style="display: none;" />
                            </div>

                            <div class="flex flex-col gap-2">
                                <input type="text" name="name" id="name" placeholder="Nombre..." class="w-full p-2 bg-walter-200 rounded no-underline outline-none">
                                <input type="number" name="price" id="price" placeholder="Precio..." class="w-full p-2 bg-walter-200 rounded no-underline outline-none">
                                <div class="flex items-center w-full pr-2  ">
                                    <select name="category" id="category" class="w-full p-2  bg-transparent  no-underline outline-none border-b-2 border-orange-950 pb-2">
                                        @foreach ($categories as  $category)
                                        <option class="appearance-none w-full border-none bg-transparent" value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col w-full h-full bg-walter-200 ">
                            <p class="text-left text-lg pl-4 py-2 font-bold uppercase">Descripción</p>
                            <textarea  name="description" id="description" cols="10" rows="10" class="w-full p-2 no-underline outline-none border-2 border-walter-200 resize-none text-md"></textarea>
                        </div>
                    </div>
                </form>
            `,
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonText: 'Agregar',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#f97306',

        }).then((result) => {
            if (result.isConfirmed) {
                // Aquí puedes manejar la lógica para enviar el formulario si el usuario confirma
                Swal.fire(
                    'Agregado!',
                    'El producto ha sido agregado exitosamente.',
                    'success'
                );
            }
        });
    }

    // Agregar evento de clic de imagen al elemento SVG
    document.querySelector('svg').addEventListener('click', function() {
        document.getElementById('avatar').click();
    });

</script>

@endsection
