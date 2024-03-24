@extends('dashboard-views.dashboard')

@section('dashboard-content')
    Categorias


    @foreach($categories as $category)
        <div class="card bg-orange-500 m-5 w-fit">
            <div class="card-body">
                <h5 class="card-title">{{ $category->name }}</h5>
                <p class="card-text">{{ $category->description }}</p>
                <button class="btn btn-primary bg-green-600" onclick="editCategorie({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}', {{ $category->position }})">Editar</button>
                <button class="btn btn-danger bg-red-600" onclick="deleteCategorie({{ $category->id }})">Eliminar</button>
            </div>
        </div>
    @endforeach

    <button type="button" onclick="createNewCategorie()" class="bg-blue-500 w-20 m-auto" data-toggle="modal" data-target="#createCategoryModal">
        Crear Categoria
    </button>

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
