<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
<meta name="csrf-token" content="{{ csrf_token() }}">

<h1>Prueba</h1>


<div class='menu-ctn'>
    <div class='products-ctn'>
        @foreach($products as $product)
            @if($product->availability)
                <div class='available product'>
                    <p >{{ $product->name }} - Disponible</p>
                    <button class='addToOrder' onclick="addToOrder({{ $product->id }})">Añadir al pedido</button>
                </div>
            @else
                <div class='unable product'><p>{{ $product->name }} - No disponible</p></div>
            @endif
        @endforeach
    </div>
    <div class='order'>
        <h1>Pedido</h1>
        <button id='makeOrder' onclick="makeOrder()">Hacer pedido</button>
    </div>
</div>


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

<style>
    .unable
    {
        background-color: red;
    }
    .available
    {
        background-color: green;
    }

    .product 
    {
        margin: 10px;
        padding: 10px;
        border: 1px solid black;
        width: 200px;
    }

    .menu-ctn
    {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    
</style>

</body>
</html>