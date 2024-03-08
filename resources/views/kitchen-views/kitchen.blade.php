@extends('layouts.html-layout')
@php
    $urls = [
        'home' => route('dashboard.main'),
        'menu' => route('eat-here.main'),
        'kitchen' => route('kitchen.main'),
    ];

    $urls = json_encode($urls);
@endphp


@section('title', 'Kitchen')
@section('urls', $urls )
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
