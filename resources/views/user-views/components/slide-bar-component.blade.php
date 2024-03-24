<div class="slider-container flex items-center justify-between bg-gray-200   border min-w-full w-full h-12">

    <div class="left-arrow flex  items-center  w-12 h-full bg-gray-200  z-10 px-2 pr-6 relative right-2">

    </div>

    <div class=" flex justify-around gap-4 py-4 w-[100%] absolute overflow-x-auto">

            @foreach ($productsByCategory as $category => $products)

                <p class="min-w-fit category">{{ $category }}</p>
                <p class="min-w-fit category">{{ $category }}</p>
                <p class="min-w-fit category">{{ $category }}</p>

            @endforeach

    </div>


    <div class="right-arrow flex  items-center  w-12 h-full bg-gray-200 z-10 px-2 pl-6 relative">

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


