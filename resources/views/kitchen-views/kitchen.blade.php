@extends('layouts.html-layout')

@section('title', 'Kitchen')
@section('content')
    {{-- Si hay un usuario logeado muestra la cocina, sino muestra el loggin --}}

    @if (Auth::check())
        <h1>¡Bienvenido a la cocina!</h1>
    @else
        @include('login-views.login',['route' => route('kitchen.main')])
    @endif
@endsection
