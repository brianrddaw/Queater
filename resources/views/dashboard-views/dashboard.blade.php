@extends('layouts.html-layout')

@section('title', 'Dashboard')
@section('content')

    <h1>Dashboard</h1>
    {{-- LogOut --}}
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">LogOut</button>
    </form>


    <style>

    </style>
@endsection
