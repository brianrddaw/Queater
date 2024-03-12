<!DOCTYPE html>
<html lang="es" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
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
            <div>
                        @yield('navegacion')
                        {{-- <a>asdadas</a> --}}
                        {{-- <a>asdadas</a> --}}
                        {{-- <a>asdadas</a> --}}
                        {{-- <a>asdadas</a> --}}
            </div>


            <svg  id="icono-expandir" class="cursor-pointer w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
             {{-- <div id="expandible" class="grid grid-rows-12  bg-orange-500 w-[25vw] h-[100vh] absolute top-0 left-full transition-transform duration-500 transform translate-x-[0%] p-2">

                <svg id="icono-contraer" class="w-6 h-6 ml-auto cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>

                <a href="#" class="border-b-2 border-red-500 text-xl m-auto ">Inicio</a>
            --}}






        </nav>

    </header>
    @yield('content')

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-width: 0;
        }
    </style>
    @livewireScripts

</body>
</html>
