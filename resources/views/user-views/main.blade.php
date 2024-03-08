@extends('layouts.html-layout')

@section('title', 'User')
@section('content')

    <main class="flex w-full h-[calc(100vh-3.25rem)] place-content-center items-center border-2 border-red-700">

        <section class="w-fit h-fit flex flex-col justify-center items-center gap-5 border-2 border-red-700 mb-8">

            <a href="{{route('eat-here.main')}}" class="flex flex-col justify-center items-center p-5 bg-red-500 rounded w-fit min-w-52 text-white hover:bg-red-400 hover:cursor-pointer">
                <p class="text-lg font-sans">Comer aquí</p>
            </a>
            <a href="{{route('take-away.main')}}" class="flex flex-col justify-center items-center p-5 bg-red-500 rounded w-fit min-w-52 text-white hover:bg-red-400 hover:cursor-pointer">
                <p class="text-lg font-sans">Para llevar</p>
            </a>

        </section>

    </main>



@endsection




