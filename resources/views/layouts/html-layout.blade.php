<!DOCTYPE html>
<html lang="es" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@100..900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>
<body class="overflow-x-hidden bg-walter-200">
    <header class="flex justify-items-center items-center  bg-orange-500 p-2 h-14 text-zinc-100 ">
        <img src="{{ asset('imgs/letras.webp') }}" alt="" class="pl-2 h-4 mr-auto  ">

        @if (!empty(trim($__env->yieldContent('navegacion'))))
        <nav class="flex flex-row items-center ml-auto mr-2 ">

            <button id="nav-button" class="">

                <svg  id="icono-expandir" class="cursor-pointer w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">

                    <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                </svg>

            </button>

            {{-- DROPDOWN NAV --}}
                <div class="nav-slide hidden flex-col gap-2 items-center min-w-fit absolute right-0 top-14 z-10 bg-orange-500 overflow-hidden text-ellipsis w-fit text-[1rem]">
                    @yield('navegacion')
                </div>


            </nav>
        @endif

        </header>
    @yield('content')



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nav-button').click(toggleDropdownNav);
        });

        // Funcion para cerrar o abrir el dropdown con JavaScript puro
        function toggleDropdownNav() {
            const dropdawn =  $(this).parent();
            const dropdawnItems = dropdawn.find('.nav-slide');
            console.log(dropdawn);
            console.log(dropdawnItems);

            // Si el dropdown esta abierto se cierra / si esta cerrado se abre
            dropdawnItems.slideToggle();
        }


    </script>



    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-width: 0;
        }

        .nav-slide a {
            display: flex;
            width: 100%;
            font-weight: bold;
            white-space: nowrap;
            text-transform: uppercase;
            text-align: right;
            padding: .75rem;
        }

    </style>
</body>
</html>
