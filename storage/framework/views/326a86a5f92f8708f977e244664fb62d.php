<?php $__env->startSection('dashboard-content'); ?>


<section class="flex flex-wrap w-[100%] h-fit pr-2 gap-3">
        <button class="flex justify-center items-center gap-4 bg-stone-100 min-w-fit w-fit h-fit p-4 mt-2 rounded-lg  active:bg-walter-300 font-bold shadow-4" onclick="showAddCategoryForm()">
            <p class="text-orange-950 uppercase" >
                Agregar Categoria
            </p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>

        <div class="w-full h-fit flex flex-wrap gap-4 mt-4">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card flex flex-col w-[250px]  bg-stone-100 rounded shadow-lg ">
                <div class="flex justify-center items-center w-full h-32 bg-slate-400">
                    <h3 class="card-title absolute text-2xl font-bold text-slate-700 ">
                        <?php echo e($category->name); ?>

                    </h3>
                </div>
                <div class="card grid grid-cols-3 w-full rounded">
                    <div onclick="showEditCategory(<?php echo e($category->id); ?>, '<?php echo e($category->name); ?>', '<?php echo e($category->description); ?>', <?php echo e($category->position); ?>)"
                    class="flex justify-center items-center font-bold text-green-600 bg-green-200 col-span-2 p-4 m-1 gap-2 cursor-pointer">
                        <p>Editar</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>

                    <button class="flex justify-center bg-red-200 m-1 p-4 w-auto rounded  font-bold text-red-600" onclick="showDeleteCategory(<?php echo e($category->id); ?>)">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>

                    </button>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>



<?php $__env->stopSection(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function showAddCategoryForm() {
    Swal.fire({
        title: 'Agregar Categoria',
        html: `
            <form  enctype="multipart/form-data" action="" id="form-new-category" method="post" class="w-full  h-fit mx-auto  rounded-lg  text-orange-950">
                <div class="flex justify-evenly gap-2">
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Nombre..."
                        class="w-auto h-10 p-2 bg-walter-200 rounded no-underline outline-none">
                    <div class="flex flex-col items-center w-fit pr-2 mt-auto">
                        <label for="position" class="flex items-center justify-center w-fit h-10 bg-orange-500 rounded text-orange-50 text-lg px-4 font-bold uppercase">Posición</label>
                        <select name="position" id="position" class="w-full bg-transparent no-underline outline-none border-b-2 border-orange-950 py-2 pr-4">

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->position); ?>"><?php echo e($category->position); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <option value="<?php echo e(count($categories) + 1); ?>"><?php echo e(count($categories) + 1); ?></option>
                        </select>
                    </div>
                </div>
            </form>
        `,
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonText: 'Agregar',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#ef4444',
        confirmButtonColor: '#22c55e',
        position:'center',

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
        position:'center',
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('ahora se ejecutará delete product');
            deleteCategory(category_id);
        }
    });
}

function createNewCategory() {

    const name = ($('#name').val()).toString();
    const position = parseInt($('#position').val());

    if (!name || !position) {
        return Swal.fire(
                'Error!',
                'Debes completar los campos nombre y posición.',
                'error'
            );
    }

    toggleLoader()

    $.ajax({
        url: '/dashboard/categories/create',
        type: 'POST',
        data: {
            '_token': '<?php echo e(csrf_token()); ?>',
            'name': name,
            'position': position,
        },
        success: function(response) {
            toggleLoader()
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
            toggleLoader()
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


function showEditCategory(categoryId, categoryName, categoryDescription, categoryPosition) {
    Swal.fire({
        title: 'Editar Categoria',
        html: `
            <form  enctype="multipart/form-data" action="" id="form-new-category" method="post" class="w-full  h-fit mx-auto  rounded-lg  text-orange-950">

                <div class="flex flex-col h-full gap-10">

                    <div class="grid grid-cols-2 gap-4 h-fit">

                        <div class="flex flex-col gap-2">
                            <input type="hidden" name="category" id="category" value="${categoryId}">
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="${categoryName}"
                                placeholder="Nombre..."
                                class="w-full p-2 bg-walter-200 rounded no-underline outline-none">
                                <div class="flex items-center w-full pr-2  ">
                                    <select name="position" id="position" class="w-full p-2  selected="${categoryPosition}" value="${categoryPosition}"  bg-transparent  no-underline outline-none border-b-2 border-orange-950 pb-2">
                                    <option class="appearance-none w-full border-none bg-transparent" value="${categoryPosition}">${categoryPosition}</option>
                                    `+
                                        function(){
                                            let categories = <?php echo json_encode($categories, 15, 512) ?>;
                                            let options = '';
                                            categories.forEach(category2 => {
                                                options += `<option class="appearance-none w-full border-none bg-transparent" value="${category2.position}">${category2.position}</option>`;
                                            });
                                            return options;
                                        }()
                                    +`
                                </select>
                            </div>
                        </div>
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
        position:'center',

    }).then((result) => {

        if (result.isConfirmed) {
            editCategory();
        }
    });
}

function editCategory() {

    // creamos las constantes
    const categoryId = ($('#category').val()).toString();
    const categoryName = ($('#name').val()).toString();
    const categoryPosition = parseInt($('#position').val());

    $.ajax({
        url: '/dashboard/categories/update',
        type: 'POST',
        data: {
            '_token': '<?php echo e(csrf_token()); ?>',
            'id': categoryId,
            'name': categoryName,
            'position': categoryPosition,
        },
        success: function(response) {
            console.log(response);
            Swal.fire(
                'Editado!',
                'La categoria se ha editado exitosamente.',
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
                'Ha ocurrido un error al intentar editar la categoria.',
                'error'
            ).then(() => {
                // Recargar la página después de cerrar el mensaje de éxito
                window.location.reload();
            });
        }
    });
}

function deleteCategory(category_id) {
    $.ajax({
        url: '/dashboard/categories/delete/' + category_id,
        type: 'DELETE',
        data: {
            '_token': '<?php echo e(csrf_token()); ?>',
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

<?php echo $__env->make('dashboard-views.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Programación\Desktop\miguel\resources\views/dashboard-views/dashboard-categories.blade.php ENDPATH**/ ?>