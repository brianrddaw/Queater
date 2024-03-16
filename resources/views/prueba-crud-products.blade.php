{{-- Formulario para crear nuevos productos --}}

@extends('layouts.html-layout')

@section('content')
    Formulario.

    <form action="" method="post" class="w-[500px] h-[400px] mx-auto p-2 border border-red-500">
        @csrf
        <div class="grid grid-rows-2 border border-blue-500 h-full">

            {{-- IMG && INFO --}}
            <div class="">
                <div class="">
                    <input type="file" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100
                    "/>
                </div>
                <div class="">
                    <input type="text" name="name" id="name" placeholder="Nombre...">
                    <input type="number" name="price" id="price" placeholder="Price...">
                    <select name="category" id="category">
                    </select>
                </div>

            </div>

            {{-- DESCRIPCIÓN --}}
            <div class="">
                <p></p>
            </div>

        </div>



@endsection
