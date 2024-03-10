@extends('layouts.html-layout')

@section('title', 'Dashboard')
@section('navegacion')
    <a href="{{ route('user.main') }}" class="">User</a>
    <a href="{{ route('kitchen.main') }}" class="">Kitchen</a>
@endsection
@section('content')
    <h1>Dashboard</h1>
    @if (Auth::check())
        <h1>¡Bienvenido a la Dashboard!</h1>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <input type="hidden" name="route" value='dashboard.main'>
            <button type="submit" class="bg-red-600 rounded-lg p-4 hover:bg-red-500">LogOut</button>
        </form>
    @else
        @include('login-views.login',['route' => 'dashboard.main'])
    @endif
@endsection
