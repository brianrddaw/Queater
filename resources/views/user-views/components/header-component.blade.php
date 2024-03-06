<header class="grid grid-cols-4 justify-items-center items-center  bg-stone-800 p-2 ">
    <img src="{{ asset('imgs/logo.png') }}" alt="" class="w-16 mr-auto">
    <h1 class="text-white col-span-2">{{ $restaurantName }}</h1>
    <nav class="flex flex-col items-center text-white ml-auto mr-2 border-2 border-red-500 rounded ">
        <svg  id="icono-expandir" class="cursor-pointer w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
        </svg>
        <div id="expandible" class="grid grid-rows-12  bg-stone-800 w-[25vw] h-[100vh] absolute top-0 left-full transition-transform duration-500 transform translate-x-[0%] p-2">

            <svg id="icono-contraer" class="w-6 h-6 ml-auto cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>

            <a href="#" class="border-b-2 border-red-500 text-xl m-auto ">Inicio</a>


        </div>
    </nav>

</header>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        // Selecciona el botón SVG
        var iconoExpandir = document.querySelector('#icono-expandir');
        var iconoContraer = document.querySelector('#icono-contraer');

        // Selecciona el div expandible
        var expandible = document.querySelector('#expandible');

        // Añade un evento de clic al botón SVG
        iconoContraer.addEventListener('click', function() {
            expandible.style.transform = 'translateX(0%)';
        });

        iconoExpandir.addEventListener('click', function() {
            expandible.style.transform = 'translatex(-100%)';
        });
    });


</script>