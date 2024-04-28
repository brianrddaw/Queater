@extends('layouts.html-layout')

@section('title', 'User')
@section('content')
    <section class="flex flex-col items-center gap-6 mt-6 text-orange-950">
        <img class="w-64" src="{{ asset('imgs/chef.webp') }}" alt="">
        <h1 class="font-bold text-lg">Tu pedido se ha mandado a cocina</h1>
        <span class="flex flex-col w-fit h-full items-center gap-4 mt-6">
            <div class="min-w-fit w-44 h-14 text-center  flex items-center justify-center gap-1 bg-orange-500 rounded font-bold text-orange-50">
                <a  href="/printTicket/{{ $orderId }}/{{ $tableId }}">
                    Descargar ticket
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </div>
            <a class="min-w-fit w-44 h-14 text-center  flex items-center justify-center  bg-orange-500 rounded font-bold text-orange-50" href="/">Volver al menu</a>
        </span>
    </section>
@endsection
