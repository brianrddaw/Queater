@extends('dashboard-views.dashboard')

@section('dashboard-content')
    Categorias


    @foreach($categories as $category)
        <div class="card bg-orange-500 m-5 w-fit">
            <div class="card-body">
                <h5 class="card-title">{{ $category->name }}</h5>
                <p class="card-text">{{ $category->description }}</p>
                <button class="btn btn-primary bg-green-600" onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}', {{ $category->position }})">Editar</button>
                <button class="btn btn-danger bg-red-600" onclick="deleteCategory({{ $category->id }})">Eliminar</button>
            </div>
        </div>
    @endforeach

    <button type="button" onclick="createNewCategory()" class="bg-blue-500 w-20 m-auto" data-toggle="modal" data-target="#createCategoryModal">
        Crear Categoria
    </button>

@endsection

<script>


    function createNewCategory() {
        console.log('createNewCategory');
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
