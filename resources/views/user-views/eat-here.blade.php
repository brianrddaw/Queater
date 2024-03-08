@extends('layouts.html-layout')

@section('title', 'User')
@section('content')

    <x-header-component />
    @livewire('user-cart')

    <main  class="eat-here-main">

        <h2 class="text-2xl text-orange-950 font-bold border-b-2 border-orange-500">HAMBURGUESAS</h2>

        @foreach ( $products as $product )


            @if ($product->availability)

                @livewire('product-card', ['product' => $product], key($product->id))

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



    .product-card{

        display: flex;
        flex-direction: column;
        /* border: 1px solid red; */
        min-width: 15rem;
        width: 15rem;
        height: fit-content;

    }
    .product-card img{
        width: fit-content;
        height: 6rem;
        width: 6rem;
        object-fit: contain;
        margin: 0 auto;
        /* border: 1px solid blue; */
    }


    .allergens{
        display: flex;
        width: fit-content;
        /* border: 1px solid green; */
        justify-content: center;
        gap: 0.5rem;
    }



</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>


<script>
    var order = {};

    function addToOrder(id, price)
    {

        if(order[id])
        {
            order[id].quantity++;
        }
        else
        {
            order[id] = {
                id: id,
                quantity: 1,
                price: price
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
