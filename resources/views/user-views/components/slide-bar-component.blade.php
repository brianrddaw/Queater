<div class="slider-container flex items-center justify-between bg-gray-200   border min-w-full w-full h-12">

    <div class="left-arrow flex  items-center  w-fit h-full bg-gray-200 z-10 px-2 pr-6">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 z-10 ml-auto">
            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </div>

    <div class=" flex gap-4 py-4 w-[100%] absolute overflow-x-auto">

            @foreach ($productsByCategory as $category => $products)

                <p class="min-w-fit category">{{ $category }}</p>
                <p class="min-w-fit category">{{ $category }}</p>
                <p class="min-w-fit category">{{ $category }}</p>

            @endforeach

    </div>


    <div class="right-arrow flex  items-center  w-fit h-full bg-gray-200 z-10 px-2 pl-6">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-auto">
            <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const slider = $('.slider-container');
        const categories = $('.category');

        // Ancho total del contenido del slider

        // Función para desplazar el slider hacia la izquierda
        $('.left-arrow').click(function() {
            console.log('left arrow clicked');
        });

        // Función para desplazar el slider hacia la derecha
        $('.right-arrow').click(function() {
            console.log('right arrow clicked');
        });
    });
</script>


<style>



    .left-arrow, .right-arrow {
        cursor: pointer;
    }

    .left-arrow{

        background: linear-gradient(90deg, rgba(229, 231, 235, 1) 65%, rgba(229, 231, 235, 0) 100%);
    }

    .right-arrow{

        background: linear-gradient(270deg, rgba(229, 231, 235, 1) 65%, rgba(229, 231, 235, 0) 100%);

    }


</style>


