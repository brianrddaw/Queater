@extends('layouts.html-layout')

@section('title', 'User')
@section('content')

    <x-header-component/>

    <main class="flex w-full h-[calc(100vh-3.25rem)] place-content-center items-center border-2 border-red-700">

        <section class="w-fit h-fit flex flex-col justify-center items-center gap-5 border-2 border-red-700 mb-8">

            <x-text-card-component message="Comer aquí" />
            <x-text-card-component message="Para llevar" />

        </section>

    </main>



@endsection




