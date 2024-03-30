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
        <button class="bg-walter-400 min-w-fit h-full p-4 border-l-4  active:bg-walter-300 font-bold text-orange-950 uppercase" onclick="showAddCategoryForm()">Agregar</button>
    </div>

    <section class="flex flex-wrap w-[100%] h-fit p-3 gap-3">

        @foreach($categories as $category)
        <div class="card flex flex-col w-[calc(50%-0.4rem)]  bg-walter-300  rounded drop-shadow-xl">
            <div class="flex justify-center items-center w-full h-32">
                <img src="/storage/categories_images/batidos.webp" alt="" class="w-full h-full object-cover rounded-t opacity-70">
                <h3 class="card-title absolute text-2xl font-bold text-orange-950">
                    {{ $category->name }}
                </h3>
            </div>
            <div class="card grid grid-cols-3 w-full rounded">
                <button class="bg-walter-400 p-4 w-full font-bold text-green-600 col-span-2" onclick="editCategorie({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}', {{ $category->position }})">Editar</button>

                <button class="bg-walter-400 p-4 w-full font-bold text-red-600" onclick="showDeleteCategory({{ $category->id }})">Eliminar</button>

            </div>
        </div>
        @endforeach
    </section>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function showAddCategoryForm() {
    Swal.fire({
        title: 'Agregar Categoria',
        html: `
            <form  enctype="multipart/form-data" action="" id="form-new-category" method="post" class="w-full  h-fit mx-auto  rounded-lg  text-orange-950">

                <div class="flex flex-col h-full gap-10">

                    <div class="grid grid-cols-2 gap-4 h-fit">

                        <div class="flex flex-col gap-2">
                            <input
                                type="text"
                                name="name"
                                id="name"
                                placeholder="Nombre..."
                                class="w-full p-2 bg-walter-200 rounded no-underline outline-none">
                            <div class="flex flex-col items-center w-full pr-2 mt-auto">
                                <label for="position" class="bg-orange-400 text-left text-orange-50 text-lg pl-4 py-2 font-bold uppercase w-full">Position</label>
                                <select name="position" id="position" class="w-full   bg-transparent  no-underline outline-none border-b-2 border-orange-950 pb-2">

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->position }}">{{ $category->position }}</option>
                                    @endforeach

                                    <option value="{{ count($categories) + 1 }}">{{ count($categories) + 1 }}</option>
                                </select>
                            </div>
                        </div>
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
        position:'top-end',

    }).then((result) => {

        if (result.isConfirmed) {
            createNewCategory();
        }
    });
}

function showDeleteCategory(category_id){
    console.log('showDeleteCategory: ', category_id);
    Swal.fire({
        title: 'Eliminar Categoria',
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonColor: '#f97306',
        position:'top-end',
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('ahora se ejecutará delete product');
            deleteCategory(category_id);
        }
    });
}

function createNewCategory() {

    // creamos las constantes
    const name = ($('#name').val()).toString();
    const position = parseInt($('#position').val());


    // validate fields
    if (!name || !position) {
        return Swal.fire(
                'Error!',
                'Debes completar los campos nombre y posición.',
                'error'
            );
    }

    $.ajax({
        url: '/dashboard/categories/create',
        type: 'POST',
        data: {
            '_token': '{{ csrf_token() }}',
            'name': name,
            'position': position,
        },
        success: function(response) {
            console.log(response);
            Swal.fire(
                'Creada!',
                'La categoria se ha creado exitosamente.',
                'success'
            ).then(() => {
                // Recargar la página después de cerrar el mensaje de éxito
                window.location.reload();
            });
        },
        error: function(error) {
            console.log(error);
            Swal.fire(
                'Error!',
                'Ha ocurrido un error al intentar crear la categoria.',
                'error'
            ).then(() => {
                // Recargar la página después de cerrar el mensaje de éxito
                window.location.reload();
            });
        }
    });
}



function editCategory(categoryId, categoryName, categoryDescription, categoryPosition) {
    console.log('editCategory: ', arguments);
}

function deleteCategory(category_id) {
    $.ajax({
        url: '/dashboard/categories/delete/' + category_id,
        type: 'DELETE',
        data: {
            '_token': '{{ csrf_token() }}',
        },
        success: function(response) {
            console.log(response);
            Swal.fire(
                'Eliminado!',
                'La categoria se ha sido eliminado exitosamente.',
                'success'
            ).then(() => {
                // Recargar la página después de cerrar el mensaje de éxito
                window.location.reload();
            });
        },
        error: function(error) {
            console.log(error);
            Swal.fire(
                'Error!',
                'Ha ocurrido un error al intentar eliminar la categoria.',
                'error'
            ).then(() => {
                // Recargar la página después de cerrar el mensaje de éxito
                window.location.reload();
            });
        }
    });
}


</script>
