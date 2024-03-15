@extends('layouts.html-layout')

@section('title', 'Dashboard')

@section('content')
    @if (Auth::check())
    <main class=" w-full h-[100vh] grid grid-cols-10">
        <div class="bg-walter-200 col-span-3 text-left border-r-2 border-orange-500">
            <h2 class="text-lg text-orange-50 bg-orange-500  font-bold capitalize bg-orange py-4 pl-4">dashboard</h2>
            <nav class="flex flex-col text-orange-950">
                <div class="flex flex-col nav-parent">
                    <div class="nav-parent-title flex items-center justify-between p-4 bg-orange-100">
                        <h2 class="font-bold ">Navegación</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="nav-arrow w-6 h-6 transition-all duration-500 rotate-180">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>

                    </div>
                    <div class="flex flex-col routes-dropdown font-bold text-orange-950 nav-child">
                        {{-- Navegacion --}}
                        <a href="{{ route('dashboard.main') }}" class="p-4 hover:bg-orange-100">Inicio</a>
                        <a href="{{ route('dashboard.products') }}" class="p-4 hover:bg-orange-100">Productos</a>
                        <a href="{{ route('dashboard.categories') }}" class="p-4 hover:bg-orange-100">Categorias</a>
                        <a href="{{ route('dashboard.tables') }}" class="p-4 hover:bg-orange-100">Mesas</a>
                    </div>
                </div>
            </nav>
            <form action="{{ route('logout') }}" method="post" class="w-full p-2">
                @csrf
                <input type="hidden" name="route" value='dashboard.main'>
                <button type="submit" class="bg-orange-500 w-full rounded p-4 hover:bg-orange-400 text-orange-50 font-bold text-lg bottom-0 relative">Salir</button>
            </form>
        </div>

        <section class="flex w-full h-full bg-gray-100 col-span-7 ">
            {{-- Contenido de la dashboard --}}


            @if (!empty(trim($__env->yieldContent('dashboard-content'))))
                @yield('dashboard-content')
            @else
                Inicio
            @endif

        </section>


    </main>
    @else
        @include('login-views.login',['route' => 'dashboard.main', 'title' => 'Dashboard'])
    @endif


<style>

    .routes-dropdown a {
        padding-left: 1rem;
    }


    nav a:hover {
        @apply bg-orange-100
    }



</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    // Cuando cargue el documento se añaden los addEventListener
    document.addEventListener('DOMContentLoaded', () => {
        const dropdowns = document.querySelectorAll('.nav-parent');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('click', toggleDropdown);
        });
    });

    // Funcion para cerrar o abrir el dropdown con JavaScript puro
    function toggleDropdown() {
        const child =  $(this).children('.nav-child');
        const arrow = $(this).find('.nav-arrow');
        // Si el dropdown esta abierto se cierra / si esta cerrado se abre
        child.slideToggle();

        //Rotar la flecha
        arrow.toggleClass('rotate-180');

        console.log(arrow);
        //Rotar la flecha

    }

</script>



@endsection



