@extends('layouts.html-layout')

@section('title', 'User')
@section('content')

    <main class="flex w-full h-[calc(100vh-3.5rem)] place-content-center items-center ">

        <section class="w-fit h-fit flex flex-col justify-center items-center gap-5  mb-8">

            <a href="{{route('eat-here.main')}}" class="flex flex-col justify-center items-center p-5 bg-orange-500 rounded w-fit min-w-52 text-orange-50 active:scale-105 active:bg-orange-400 hover:cursor-pointer drop-shadow-lg">
                <p class="text-lg font-sans">Comer aquí</p>
            </a>
            <a href="{{route('take-away.main')}}" class="flex flex-col justify-center items-center p-5 bg-orange-500 rounded w-fit min-w-52 text-white active:scale-105 active:bg-orange-400 hover:cursor-pointer drop-shadow-lg">
                <p class="text-lg font-sans">Para llevar</p>
            </a>

        </section>

    </main>


@endsection




