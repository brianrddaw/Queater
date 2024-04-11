@extends('layouts.html-layout')

@section('title', 'User')
@section('content')

<form action="/checkout" method="POST" class="bg-white p-4 shadow-md rounded-lg">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <h2 class="text-xl font-bold mb-4">Formulario de Pago</h2>

    <section class="mb-4">
    <h3 class="text-lg font-medium mb-2">Información del Cliente</h3>
    <div class="flex flex-wrap -mx-2">
        <div class="w-full md:w-1/2 px-2 mb-2 md:mb-0">
        <label for="nombre" class="block mb-1">Nombre</label>
        <input type="text" id="nombre" name="nombre" class="w-full border border-gray-300 rounded-md py-2 px-3" />
        </div>
        <div class="w-full md:w-1/2 px-2 mb-2 md:mb-0">
        <label for="email" class="block mb-1">Email</label>
        <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md py-2 px-3" />
        </div>
    </div>
    </section>

    <section class="mb-4">
    <h3 class="text-lg font-medium mb-2">Información de la Tarjeta de Crédito</h3>
    <div class="flex flex-wrap -mx-2">
        <div class="w-full md:w-1/2 px-2 mb-2 md:mb-0">
        <label for="numero_tarjeta" class="block mb-1">Número de Tarjeta</label>
        <input type="text" id="numero_tarjeta" name="numero_tarjeta" class="w-full border border-gray-300 rounded-md py-2 px-3" />
        </div>
        <div class="w-full md:w-1/4 px-2 mb-2 md:mb-0">
        <label for="fecha_expiracion" class="block mb-1">Fecha de Expiración</label>
        <input type="text" id="fecha_expiracion" name="fecha_expiracion" class="w-full border border-gray-300 rounded-md py-2 px-3" />
        </div>
        <div class="w-full md:w-1/4 px-2 mb-2 md:mb-0">
        <label for="cvv" class="block mb-1">CVV</label>
        <input type="text" id="cvv" name="cvv" class="w-full border border-gray-300 rounded-md py-2 px-3" />
        </div>
    </div>
    </section>

    @csrf
    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-md w-full">
        Realizar Pago
    </button>
</form>


@endsection
