@extends('layouts.html-layout')

@section('title', 'Dashboard')
@section('content')
    <h1>Dashboard</h1>
    @if (Auth::check())
        <h1>¡Bienvenido a la Dashboard!</h1>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <input type="hidden" name="route" value='dashboard.main'>
            <button type="submit">LogOut</button>
        </form>
    @else
        @include('login-views.login',['route' => 'dashboard.main'])
    @endif
@endsection
