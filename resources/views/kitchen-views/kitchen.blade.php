@extends('layouts.html-layout')

@section('title', 'Kitchen')
@section('content')
    {{-- Si hay un usuario logeado muestra la cocina, sino muestra el loggin --}}
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
