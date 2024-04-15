@extends('layouts.html-layout')

@section('title', 'User')
@section('content')
    <section class="flex flex-col items-center gap-6 mt-6 text-orange-950">
        <img class="w-64" src="{{ asset('imgs/chef.webp') }}" alt="">
        <h1 class="font-bold text-lg">Tu pedido se ha mandado a cocina</h1>
        <span class="flex flex-col w-fit h-full items-center gap-4 mt-6">
            <a class="min-w-fit w-44  text-center h-12 flex items-center justify-center  bg-orange-500 rounded font-bold text-orange-50" href="/printTicket/{{ $orderId }}">Imprimir ticket</a>
            <a class="min-w-fit w-44  text-center h-12 flex items-center justify-center  bg-orange-500 rounded font-bold text-orange-50" href="/">Volver al menu</a>
        </span>

    </section>
@endsection
