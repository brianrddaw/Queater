@extends('layouts.html-layout')

@section('title', 'Dashboard')
@section('navegacion')
    <a href="{{ route('user.main') }}" class="">User</a>
    <a href="{{ route('kitchen.main') }}" class="">Kitchen</a>
@endsection
@section('content')
    @if (Auth::check())
    <main class=" w-full h-[calc(100vh-3.5rem)] grid grid-cols-10">
        <div class="bg-orange-50 col-span-2 text-center">
            <h2 class="text-lg text-orange-50 bg-orange-500  font-bold capitalize bg-orange py-4">dashboard</h2>
            <nav class="flex flex-col">
                <a href="#" class=" py-4 border-b-2 border-orange-950 hover:bg-orange-100">Productos</a>
                <a href="#" class=" py-4 border-b-2 border-orange-950 hover:bg-orange-100">Categorías</a>
                <a href="#" class=" py-4 border-b-2 border-orange-950 hover:bg-orange-100">Mesas</a>
                <form action="{{ route('logout') }}" method="post" class="w-full p-2">
                    @csrf
                    <input type="hidden" name="route" value='dashboard.main'>
                    <button type="submit" class="bg-orange-500 w-full rounded p-4 hover:bg-orange-400 text-orange-50 font-bold text-lg">Salir</button>
                </form>
            </nav>
        </div>

        <section class="flex w-full h-full bg-gray-100  col-span-8 border border-red-500">
            @include('dashboard-views.dashboard-products', ['route' => route('dashboard.products')])
        </section>

    </main>
    @else
        @include('login-views.login',['route' => 'dashboard.main', 'title' => 'Dashboard'])
    @endif
@endsection
