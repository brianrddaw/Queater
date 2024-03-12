<!DOCTYPE html>
<html lang="es" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>
<body class="overflow-x-hidden bg-orange-100">
    <header class="flex justify-items-center items-center  bg-orange-950 p-2 h-14 text-orange-100">
        {{-- <img src="{{ asset('imgs/logo.webp') }}" alt="" class="w-8 mr-auto"> --}}
        <div class="flex items-center pr-4 pl-2 h-full">
            <h1 class=" col-span-2 font-bold">Queater</h1>
        </div>
        <nav class="flex flex-row items-center ml-auto mr-2 ">

            <button id="nav-button" class="">

                <svg  id="icono-expandir" class="cursor-pointer w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">

                    <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                </svg>

            </button>

            {{-- NAV SLIDE --}}
            <div class="nav-slide flex flex-col gap-2 p-3  items-center h-[300px] w-[25vw]  min-w-fit absolute right-0 top-14 z-10 bg-orange-950">

                <a href="#">Inicio</a>
                @yield('navegacion')

            </div>
        </nav>

    </header>
    @yield('content')



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nav-button').click(function() {
                toggleNavSlideLeft();
            });
        });

        function toggleNavSlideLeft() {
            const navSlide = $('.nav-slide');
            const isNavVisible = navSlide.hasClass('active');

            if (!isNavVisible) {
                navSlide.addClass('active').css('display', 'flex').hide().slideDown(200);
            } else {
                navSlide.removeClass('active').slideUp(200);
            }
        }

    </script>



    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-width: 0;
        }


        .nav-slide {
            display: none;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 0;
        }

        .nav-slide.active {
            height: auto;
        }


        .nav-slide a {
            font-weight: bold;
            white-space: nowrap;
            text-transform: uppercase;
        }

        .nav-slide a:hover {
            color: #fb923c;
        }

    </style>
</body>
</html>
