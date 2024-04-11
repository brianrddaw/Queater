<div class="slider-container flex items-center justify-between bg-gray-200   border min-w-full w-full h-12 px-4  overflow-x-auto">



    <div class="flex justify-around gap-4 w-full h-fit">
        @foreach ($productsByCategory as $category => $products)

        <p class="min-w-fit category">{{ $category }}</p>


        @endforeach
    </div>


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

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


