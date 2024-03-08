@extends('layouts.html-layout')

@section('title', 'Kitchen')

@section('navegacion')
    <a href="{{ route('kitchen.main') }}" class="border-b-2 border-red-500 text-xl m-auto ">Inicio</a>
    <a href="{{ route('dashboard.main') }}" class="border-b-2 border-red-500 text-xl m-auto ">Pedidos</a>
    <a href="{{ route('user.main') }}" class="border-b-2 border-red-500 text-xl m-auto ">Productos</a>
@endsection

@section('content')
    {{-- Si hay un usuario logeado muestra la cocina, sino muestra el loggin --}}
    Bienvendo a la cocina.
    <h1>Cocina</h1>
    @if (Auth::check())
        <h1>¡Bienvenido a la cocina!</h1>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <input type="hidden" name="route" value='kitchen.main'>
            <button type="submit">LogOut</button>
        </form>
    @else
        @include('login-views.login',['route' => 'kitchen.main'])
    @endif
@endsection
