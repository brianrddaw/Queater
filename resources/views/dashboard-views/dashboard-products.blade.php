
@extends('dashboard-views.dashboard')

@section('dashboard-content')
@section('navegacion')
    <a href="{{ route('kitchen.main') }}">kitchen</a>
    <a href="{{ route('cash.main') }}">cash</a>
@endsection
<div class="flex flex-col w-full h-full">

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

    <div class="flex  flex-wrap w-[100%] h-[calc(100vh-7.25rem)] p-6 gap-4  overflow-y-scroll">
        @foreach ($products as  $product)

            <div class="card flex flex-col justify-between w-full h-fit bg-walter-300 border rounded p-2 py-6 gap-6 text-orange-950">

                    <div class="flex">

                        <div class="flex w-full justify-between">


                            <div class="flex gap-10">
                                <div class="flex items-center justify-center overflow-hidden w-20 h-20 bg-orange-500 rounded-full drop-shadow-[0_4px_3px_rgba(0,0,0,.3)]">
                                    <img  class="object-cover w-20 h-20 rounded-full" src="{{ "/storage/" . $product->image_url }}" alt="{{ $product->name }}">
                                </div>
                                <span class="pt-2 flex flex-col justify-between">
                                    <h3 class="font-bold">{{ $product->name }}</h3>
                                    <div class="flex gap-4">
                                        <p>Precio</p>
                                        <p class="font-bold">{{ $product->price }} €</p>
                                    </div>

                                </span>

                            </div>

                            <span class="w-28 flex flex-col gap-2 justify-between items-start">

                                <p class="w-full flex justify-center items-center gap-2 text-sm font-bold bg-orange-500 p-2 rounded text-orange-50 ">Categoria</p>
                                <p class="font-bold">{{ $product->category->name }}</p>

                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col bg-walter-400 p-2 gap-2 rounded">

                        <span>
                            {{ $product->description }}
                        </span>
                        <span class="flex gap-4">
                            @foreach ($product->allergens as $allergen)
                                <img class="m-w-6 h-6" src="{{ "/storage/" . $allergen->img_url }}" alt="{{ $allergen->name }}">
                            @endforeach
                        </span>


                    </div>
                    <div class="ml-auto flex gap-2">
                        <button class="font-bold text-green-800 p-2 bg-green-400 min-w-fit w-20 rounded" onclick="showEditProduct({{ $product }})">Editar</button>
                        <button class="font-bold text-red-900 p-2 bg-red-400 min-w-fit w-20 rounded"  onclick="showDeleteProduct({{ $product->id }})">Eliminar</button>
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
                <form action="{{ route('dashboard.products.create') }}" enctype="multipart/form-data" action="" id="form-new-products" method="post" class="w-full  h-fit mx-auto  rounded-lg  text-orange-950">
                    @csrf
                    <div class="flex flex-col h-full gap-10">

                        <div class="grid grid-cols-2 gap-4 h-fit">

                            <div class="flex flex-col items-center justify-center p-2 w-[12.5rem] h-[12.5rem] bg-walter-200 rounded-full">

                                <label for="image" class="cursor-pointer" id="">

                                    <svg id="svg-label" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14 text-walter-900 h-full active:scale-110 hover:cursor-pointer active:text-walter-950">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <img id="image-for-label" src="" alt="Imagen del producto" class=" w-full h-full object-cover rounded-full bg-orange-500 hidden">
                                </label>
                                <input type="file" id="image" name="image" accept="image/*" style="display: none;" />
                                <p class="text-2xl text-walter-900  absolute top-56">96x96</p>

                            </div>

                            <div class="flex flex-col gap-2">
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    placeholder="Nombre..."
                                    class="w-full p-2 bg-walter-200 rounded no-underline outline-none">
                                <input
                                    type="text"
                                    name="price"
                                    id="price"
                                    placeholder="Precio..."
                                    class="w-full p-2 bg-walter-200 rounded no-underline outline-none"
                                    oninput="formatPrice(this)"
                                />


                                <div class="flex items-center w-full pr-2 mt-auto">
                                    <select name="category" id="category" class="w-full   bg-transparent  no-underline outline-none border-b-2 border-orange-950 pb-2">
                                        @foreach ($categories as  $category)
                                            <option class="appearance-none w-full border-none bg-transparent" value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class=" allergens-container flex flex-wrap gap-2 w-full h-fit">
                            @foreach ($allergens as $allergen)
                                <img id="allergen{{ $allergen->id }}" class="allergen  cursor-pointer object-cover w-12 h-12 rounded-full grayscale" src="{{ "/storage/" . $allergen->img_url }}" alt="{{ $allergen->name }}" onclick="addAllergen('{{ $allergen->id }}', '{{ $allergen->name }}')">
                            @endforeach
                        </div>
                        <div class="flex flex-col w-full h-fit bg-walter-200">
                            <p class="bg-orange-400 text-left text-orange-50 text-lg pl-4 py-2 font-bold uppercase">Descripción</p>
                            <textarea  name="description" id="description" rows="7"  class="w-full h-full p-2 no-underline outline-none bg-walter-200 resize-none text-md"></textarea>
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

                createNewProduct();

            }
        });
        addEventToForm();
    }

    // ADD ALLERGENS LOGIC
    let allergensArray = [];

    function addAllergen(allergenId, allergenName){

        const img = $(`#allergen${allergenId}`);
        const index = allergensArray.indexOf(allergenId);
        if (index !== -1) { // Verifica si el elemento está presente en el array
            allergensArray.splice(index, 1); // Elimina el elemento del array
            img.removeClass('allergen-active');
        } else {
            allergensArray.push(allergenId); // Si no está presente, añádelo al array
            img.addClass('allergen-active');
        }

        console.log(allergensArray);

    }


    // Agregar evento de cambio de imagen al elemento input
    function addEventToForm(){
        console.log('adding event to form')

        //Se declaran las variables de los elementos del DOM que se usan.
        const image = $('#image');
        const svgLabel = $('#svg-label');
        const imageForLabel = $('#image-for-label');

        $('#image').on('change', function() {
            console.log('image changed');
            if (this.files.length > 0) { // Verifica si se ha seleccionado al menos un archivo
                const imageUrl = URL.createObjectURL(this.files[0]); // Crea una URL de objeto para el archivo seleccionado
                $('#image-for-label').attr('src', imageUrl); // Establece la URL de objeto como fuente de la imagen
                $('#image-for-label').removeClass('hidden'); // Muestra la imagen
                $('#svg-label').addClass('hidden'); // Oculta el elemento SVG
            } else {
                $('#image-for-label').addClass('hidden'); // Oculta la imagen
                $('#svg-label').removeClass('hidden'); // Muestra el elemento SVG
            }
        });
    }


    function createNewProduct(){

        // creamos las constantes
        const image = $('#image')[0].files[0];
        const name = $('#name').val();
        const price = $('#price').val();
        const category = $('#category').val();
        const description = $('#description').val();


        // validate fields
        if (!image || !name || !price || !category || !description) {
            return Swal.fire(
                    'Error!',
                    'Debes completar todos los campos para agregar un producto.',
                    'error'
                );
        }

        var formData = new FormData();
        formData.append('image', image); // Adjunta el archivo de imagen
        formData.append('name', name.toString()); // Adjunta el nombre del producto
        formData.append('price', parseFloat(price)); // Adjunta el precio del producto
        formData.append('category',  parseInt(category)); // Adjunta la categoría del producto
        formData.append('description', description.toString()); // Adjunta la descripción del producto
        formData.append('_token', '{{ csrf_token() }}');

        // Aquí puedes continuar con el envío del formulario, ya sea mediante AJAX u otro método, utilizando formData.
        $.ajax({
            url: '{{ route('dashboard.products.create') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                Swal.fire(
                    'Agregado!',
                    'El producto ha sido agregado exitosamente.',
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
                    'Ha ocurrido un error al intentar agregar el producto.',
                    'error'
                ).then(() => {
                    // Recargar la página después de cerrar el mensaje de éxito
                    window.location.reload();
                });
            }
        });

    }

    function showEditProduct(product) {

        const image_url = product.image_url;
        const name = product.name;
        const description = product.description;
        const price = product.price;
        const category_id = product.category_id;
        const category_name = product.category_name;

        const id = product.id;

        Swal.fire({
            title: 'Editar Producto',
            html: `
                <form action="{{ route('dashboard.products.update') }}" enctype="multipart/form-data" action="" id="form-new-products" method="post" class="w-full h-[400px] mx-auto  rounded-lg  text-orange-950">
                    @method('PUT')
                    @csrf
                    <div class="flex flex-col h-full gap-4">


                        <div class="grid grid-cols-2 gap-4">

                            <div class="flex flex-col items-center justify-center p-2 w-[12.5rem] bg-walter-200 rounded-lg h-full">
                                <label for="image" class="cursor-pointer" id="">
                                    <svg id="svg-label" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden w-14 h-14 text-walter-900 h-full active:scale-110 hover:cursor-pointer active:text-walter-950">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <img id="image-for-label" src="/storage/`+image_url+`" alt="Imagen del producto" class="aspect-square w-full bg-orange-500">
                                </label>
                                <input type="file" id="image" name="image" accept="image/*" style="display: none;" />
                            </div>

                            <div class="flex flex-col gap-2">
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    placeholder="`+name+`"
                                    value="`+name+`"
                                    class="w-full p-2 bg-walter-200 rounded no-underline outline-none">
                                <input
                                    type="text"
                                    name="price"
                                    id="price"
                                    placeholder="`+price+`"
                                    value="`+price+`"
                                    class="w-full p-2 bg-walter-200 rounded no-underline outline-none"
                                    oninput="formatPrice(this)"
                                />



                                <div class="flex items-center w-full pr-2  ">
                                    <select name="category" id="category" class="w-full p-2  selected="${category_name}" value="${category_id}"  bg-transparent  no-underline outline-none border-b-2 border-orange-950 pb-2">
                                    <option class="appearance-none w-full border-none bg-transparent" value="${category_id}">${category_name}</option>`+
                                    function(){
                                        let categories = @json($categories);
                                        let options = '';
                                        categories.forEach(category2 => {
                                            if(category2.id != category_id){
                                                options += `<option class="appearance-none w-full border-none bg-transparent" value="${category2.id}">${category2.name}</option>`;
                                            }
                                        });
                                        return options;
                                    }()
                                +`</select>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col bg-walter-400 p-2 gap-2 rounded">

                            <span class="flex gap-4">

                                @foreach ($productsAllergens as $allergen)
                                    {{ $allergen->allergen->name }}
                                @endforeach

                            </span>

                        </div>


                        <div class="flex flex-col w-full h-full bg-walter-200 ">
                            <p class="text-left text-lg pl-4 py-2 font-bold uppercase">Descripción</p>
                            <textarea  name="description" id="description" cols="10" rows="10" class="w-full p-2 no-underline outline-none border-2 border-walter-200 resize-none text-md">${description}</textarea>
                        </div>
                    </div>
                </form>
            `,
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonText: 'Editar',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#f97306',
            position:'top-end',

            }).then((result) => {

                if (result.isConfirmed) {
                    editProduct(id);
                }
            });
        addEventToForm();
    }

    function editProduct(id) {

        // creamos las constantes

        const image = $('#image')[0].files[0];
        const name = $('#name').val();
        const price = $('#price').val();
        const category = $('#category').val();
        const description = $('#description').val();

        //Condición para saber si se ha cambiado la imagen
        let imgaChange = image ? true : false;

        // validate fields
        if (!name || !price || !category || !description) {
            return Swal.fire(
                'Error!',
                'Todos los campos deben estar completos para editar un producto.',
                'error'
            );
        }


        // Se crea un objeto FormData para enviar los datos del formulario
        var formData = new FormData();

        //Se verifica si hay una imagen nueva y sino pues no se envia la imagen
        if(imgaChange){
            formData.append('image', image); // Adjunta el archivo de imagen
        }
        formData.append('id', id); // Adjunta el id del producto
        formData.append('name', name.toString()); // Adjunta el nombre del producto
        formData.append('price', parseFloat(price)); // Adjunta el precio del producto
        formData.append('category',  parseInt(category)); // Adjunta la categoría del producto
        formData.append('description', description.toString()); // Adjunta la descripción del producto
        formData.append('_token', '{{ csrf_token() }}');

        // Aquí puedes continuar con el envío del formulario, ya sea mediante AJAX u otro método, utilizando formData.
        $.ajax({
            url: '{{ route('dashboard.products.update') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                Swal.fire(
                    'Editado!',
                    'El producto ha sido editado exitosamente.',
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
                    'Ha ocurrido un error al intentar agregar el producto.',
                    'error'
                ).then(() => {
                    // Recargar la página después de cerrar el mensaje de éxito
                    window.location.reload();
                });
            }
        });
    }

    function showDeleteProduct(product_id){
        Swal.fire({
            title: 'Eliminar Producto',
            html: `
                <form action="{{ route('dashboard.products.update') }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            `,
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonText: 'confirmar',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#f97306',
            position:'top-end',
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('ahora se ejecutará delete product');
                deleteProduct(product_id);
            }
        });
    }
    function deleteProduct(product_id) {
        // una vez le pasamos la id, la usamos en la URL que proviene del arichivo web cuya ruta es /dashboard/products/delete/{id}
        $.ajax({
            url: '/dashboard/products/delete/' + product_id,
            type: 'DELETE',
            data: {
                '_token': '{{ csrf_token() }}',
            },
            success: function(response) {
                console.log(response);
                Swal.fire(
                    'Eliminado!',
                    'El producto ha sido eliminado exitosamente.',
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
                    'Ha ocurrido un error al intentar eliminar el producto.',
                    'error'
                ).then(() => {
                    // Recargar la página después de cerrar el mensaje de éxito
                    window.location.reload();
                });
            }
        });
    }

    // PRICE VALIDATION
    function formatPrice(input) {
        // Reemplazar cualquier caracter que no sea un número o un punto por una cadena vacía
        input.value = input.value.replace(/[^\d.]/g, '');

        // Separar el número en parte entera y parte decimal
        var parts = input.value.split('.');
        if (parts.length > 2) {
            // Si hay más de un punto, elimina los adicionales
            input.value = parts[0] + '.' + parts[1];
        } else if (parts.length === 2) {
            // Si hay parte decimal, asegúrate de que no tenga más de dos dígitos
            parts[1] = parts[1].slice(0, 2);
            input.value = parts.join('.');
        }
    }

</script>

<style>

    .allergen-active{
        filter: grayscale(0);
        transition: all 0.2s ease;
    }

    input[type="search"]::-webkit-search-decoration,
    input[type="search"]::-webkit-search-cancel-button,
    input[type="search"]::-webkit-search-results-button,
    input[type="search"]::-webkit-search-results-decoration { display: none; }
</style>

@endsection
