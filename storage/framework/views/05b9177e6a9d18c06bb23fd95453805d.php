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
            max-width: 300px;
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
            <p><strong>Número de Orden:</strong> <?php echo e($order->id); ?></p>
            <?php if($tableId > 0): ?>
            <p><strong>Mesa:</strong> <?php echo e($tableId); ?></p>
            <?php endif; ?>
            <p><strong>Fecha:</strong> <?php echo e($order->created_at); ?></p>

        </div>
        <div class="order-items">
            <h2>Productos:</h2>
            <table class="order-item">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orderLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderLine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($orderLine->product->name); ?></td>
                            <td><?php echo e($orderLine->product->price); ?> €</td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="total">Total: <?php echo e($total); ?> €</div>
        <div class="footer">
            <p>Gracias por tu pedido.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Programación\Desktop\QUEATER\resources\views\user-views\user-payments\ticket.blade.php ENDPATH**/ ?>