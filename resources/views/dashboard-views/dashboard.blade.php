@extends('layouts.html-layout')

@section('title', 'Dashboard')

@section('content')
    @if (Auth::check())
    <main class=" w-full h-[100vh] grid grid-cols-10">
        <div class="bg-walter-200 col-span-3 text-left border-r-2 border-orange-500">
            <h2 class="text-lg text-orange-50 bg-orange-500  font-bold capitalize bg-orange py-4 pl-4">dashboard</h2>
            <nav class="flex flex-col text-orange-950">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between p-4 bg-orange-100">
                        <h2 class="font-bold ">Navegación</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>

                    </div>
                    <div class="flex flex-col routes-dropdown font-bold text-orange-950">

                        <a href="#" class="py-4  hover:bg-orange-100">Productos</a>
                        <a href="#" class="py-4  hover:bg-orange-100">Categorías</a>
                        <a href="#" class="py-4 hover:bg-orange-100">Mesas</a>

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
            @include('dashboard-views.dashboard-products', ['products' => $products])
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



</script>


@endsection



