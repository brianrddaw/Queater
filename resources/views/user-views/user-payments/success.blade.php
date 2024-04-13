@extends('layouts.html-layout')

@section('title', 'User')
@section('content')
    <section class="flex flex-col items-center">

        <h1>pepe feliz</h1>

        <button><a href="/printTicket/{{ $orderId }}">Imprimir ticket</button>
            <button><a href="/">Volver al menu</button>
    </section>
@endsection
