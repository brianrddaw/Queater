
@extends('dashboard-views.dashboard')

@section('dashboard-content')

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
        <button class="bg-zinc-200 min-w-fit h-full p-4 border-l-4 border-walter-950 active:bg-zinc-300 font-bold text-orange-950 uppercase" onclick="showAddProductForm()">Añadir</button>
    </div>

    <div class="w-full h-full flex flex-wrap p-4 gap-4">

        <form action="" method="post" class="w-[500px] h-[400px] mx-auto  rounded-lg   text-orange-950">
            @csrf
            <div class="grid grid-rows-2 h-full">

                {{-- IMG && INFO --}}
                <div class="grid grid-cols-2 ">
                    <div class="w-full ">
                        <img src="../imgs/burguer.webp" alt="" class=" object-contain h-48 w-full">

                    </div>
                    <div class="">
                        <input type="text" name="name" id="name" placeholder="Nombre..." class="w-full p-2 border-b-4 border-transparent focus:border-orange-950 no-underline outline-none">
                        <input type="number" name="price" id="price" placeholder="Precio..." class="w-full p-2 border-b-4 border-transparent focus:border-orange-950 no-underline outline-none">
                        <select name="category" id="category" class="w-full p-2 border-b-4 border-transparent focus:border-orange-950 no-underline outline-none">
                            @foreach ($categories as  $category)

                                <option value="{{ $category->id }}">{{ $category->name }}</option>

                            @endforeach
                        </select>
                    </div>

                </div>


                {{-- DESCRIPCIÓN --}}
                <div class="flex flex-col w-full h-full bg-walter-400  gap-2 pt-2 font-bold uppercase">
                    <p class="text-left text-lg pl-4">Descripción</p>
                    <textarea name="description" id="description" cols="10" rows="10" class="w-full p-2 h  no-underline outline-none"></textarea>
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

    function showAddProductForm() {
        Swal.fire({
            title: 'Agregar Producto',
            html: `
                <form action="" method="post" class="w-full h-[400px] mx-auto  rounded-lg  text-orange-950">
                    @csrf
                    <div class="grid grid-rows-2 h-full">
                        <div class="grid grid-cols-2">
                            <div class="w-full">
                                <img src="../imgs/burguer.webp" alt="" class="object-contain h-48 w-full">
                            </div>
                            <div class="flex flex-col gap-2">
                                <input type="text" name="name" id="name" placeholder="Nombre..." class="w-full p-2 border border-orange-950 no-underline outline-none">
                                <input type="number" name="price" id="price" placeholder="Precio..." class="w-full p-2 border border-orange-950 no-underline outline-none">
                                <div class="flex items-center w-full pr-2  ">
                                    <select name="category" id="category" class="w-full pr-2 bg-transparent  no-underline outline-none border-b-2 border-orange-950 pb-2">
                                        @foreach ($categories as  $category)
                                        <option class="appearance-none w-full border-none bg-transparent" value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col w-full h-full bg-walter-400 gap-2 p-4 ">
                            <p class="text-left text-lg pl-4 font-bold uppercase">Descripción</p>
                            <textarea  name="description" id="description" cols="10" rows="10" class="w-full p-2 h  no-underline outline-none border border-walter-400 resize-none text-md"></textarea>
                        </div>
                    </div>
                </form>
            `,
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonText: 'Agregar',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
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

</script>

@endsection
