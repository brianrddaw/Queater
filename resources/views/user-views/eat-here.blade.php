@extends('layouts.html-layout')

@section('title', 'User')
@section('content')

    <x-header-component />
    <x-user-cart-component

        price='49.99 €'

    />

    <main  class="eat-here-main">
        {{-- <button class="border-2 border-red-500" onclick="makeOrder()">Comer</button> --}}

        <h2 class="text-2xl text-orange-950 font-bold border-b-2 border-orange-500">HAMBURGUESAS</h2>

        @foreach ( $products as $product )



        @if ($product->availability)
        <x-product-card-component

        name='{{ $product->name }}'
        description='{{ $product->description }}'
        price='{{ $product->price }}'
        id='{{ $product->id }}'

        />

        @endif

        @endforeach



    </main>


@endsection

<style>

    .eat-here-main{
        display: flex;
        flex-direction: column;
        gap: 5rem;
        align-items: center;
        padding: 3rem;
    }

</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>


<script>
    var order = {};

    function addToOrder(id)
    {
        // let orderLine = {
        //     id: id,
        //     quantity: 1
        // };

        if(order[id])
        {
            order[id].quantity++;
        }
        else
        {
            order[id] = {
                id: id,
                quantity: 1
            };
        }
        console.log(order);
        console.log(id);
    }

    function makeOrder()
    {
        // Obtener el token CSRF desde la etiqueta meta
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Configurar la solicitud AJAX con el token CSRF
        $.ajax({
            url: '{{ route('make.order') }}',
            method: 'POST',
            data: {
                user_id: 1,
                products: order
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response)
            {
                console.log(response);
            },
            error: function(xhr, status, error)
            {
                console.error(xhr.responseText);
            }
        });
    }
</script>
