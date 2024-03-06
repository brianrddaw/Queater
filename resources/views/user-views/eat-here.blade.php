@extends('layouts.html-layout')

@section('title', 'User')
@section('content')

    <x-header-component  restaurantName="Queater"/>

    <main class="flex w-full h-[calc(100vh-3.25rem)] place-content-center items-center border-2 border-red-700">
        <x-product-card-component />
    </main>

@endsection
