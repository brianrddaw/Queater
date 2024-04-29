<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: left;
        }
        .order-details {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .order-details h2 {
            margin-top: 20px;
        }


        .order-item {
            width: 100%;
            border-collapse: collapse;
        }
        .order-item th,
        .order-item td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .order-item th {
            background-color: #f3f4f6;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .total {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ticket de Pedido</h1>
        </div>
        <hr>
        <div class="order-details">
            <h2>Detalles del Pedido</h2>
            <p><strong>Número de Orden:</strong> {{ $order->id }}</p>
            @if($tableId > 0)
            <p><strong>Mesa:</strong> {{ $tableId }}</p>
            @else
            <p><strong>Para llevar</strong></p>
            @endif
            <p><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            <p><strong>Hora:</strong>  {{ $order->created_at->format('H:i:s') }}</p>
        </div>
        <div class="order-items">
            <h2>Productos:</h2>
            <table class="order-item">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderLines as $orderLine)
                        <tr>
                            <td id="nombre">{{ $orderLine->product->name }}</td>
                            <td id="cantidad">{{ $orderLine->quantity }}</td>
                            <td id="total">{{ $orderLine->product->price * $orderLine->quantity}} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total">Total: {{ $total }} €</div>
        <div class="footer">
            <p>Gracias por tu pedido.</p>
        </div>
    </div>
</body>
</html>
