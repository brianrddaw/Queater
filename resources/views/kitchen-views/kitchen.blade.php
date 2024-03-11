@extends('layouts.html-layout')

@section('title', 'Kitchen')

@section('navegacion')
    <a href="{{ route('user.main') }}" class="">User</a>
    <a href="{{ route('dashboard.main') }}" class="">Dashboard</a>
    <a href="{{ route('kitchen.main') }}" class="">Kitchen</a>
@endsection

@section('content')
    {{-- Si hay un usuario logeado muestra la cocina, sino muestra el loggin --}}
    @if (Auth::check())
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">¡Bienvenido a la cocina!</h1>
        <h2 class="text-xl mb-4">Estos son los pedidos que tienes que preparar:</h2>
        <ul>
            @foreach ($orders as $order)
            <div class="bg-orange-800 rounded-lg p-4 mb-4">
                <div class="flex flex-col mb-4 ">
                    <div class="flex text-lg flex-row justify-between font-semibold border-b border-black">
                        <div><strong>ID de Pedido:</strong> {{ $order['id'] }}</div>
                        <div><strong>Para llevar:</strong> {{ $order['take_away'] ? 'Sí' : 'No' }}</div>
                        <div><strong>Estado:</strong> {{ $order['state'] }}</div>
                    </div>
                    <ul>
                        @foreach ($order['orders_line'] as $orderLine)
                        <li class="flex justify-between items-center border-b border-orange-200 py-2">
                            <div class="text-sm">
                                <strong>ID de Producto:</strong> {{ $orderLine['product']['id'] }}<br>
                                <strong>Nombre de Producto:</strong> {{ $orderLine['product']['name'] }}<br>
                                <strong>Cantidad:</strong> {{ $orderLine['quantity'] }}<br>
                            </div>
                            <div class="text-sm">
                                <strong>Precio:</strong> ${{ $orderLine['product']['price'] }}<br>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </ul>

        <form action="{{ route('logout') }}" method="post">
            @csrf
            <input type="hidden" name="route" value='kitchen.main'>
            <button type="submit" class="bg-red-600 rounded-lg p-4 hover:bg-red-500">LogOut</button>
        </form>
    </div>
    @else
        @include('login-views.login',['route' => 'kitchen.main', 'title' => 'cocina'])
    @endif

@endsection
