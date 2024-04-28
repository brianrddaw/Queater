<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_preparing_orders()
    {
        // Creamos un pedido de prueba en estado 'preparing'
        $preparingOrder = Order::create([
            'take_away' => false,
            'state' => 'preparing',
            'table_id' => 1
        ]);
        // Realizamos una solicitud GET a la ruta correspondiente para obtener los pedidos en estado 'preparing'
        $response = $this->get(route('get.orders.preparing'));

        // Verificamos que la respuesta sea exitosa (código 200)
        $response->assertStatus(200);

        // Verificamos que la respuesta JSON contenga los datos de la orden preparada
        $response->assertJsonStructure([ // Verificamos la estructura de cada orden en la respuesta
            '*'=>[
                'id',
                'take_away',
                'table_id',
                'state',
                'created_at',
                'updated_at',
                'orders_line' => [
                    '*' => [
                        'id',
                        'order_id',
                        'product_id',
                        'quantity',
                        'product' => [
                            'id',
                            'name',
                            'description',
                            'price',
                            'image_url'
                        ]
                    ]
                ]
            ]
        ]);

        //Borra el pedido de prueba
        $preparingOrder->delete();

    }

    public function test_get_ready_orders_eat_here()
    {
        // Creamos un pedido de prueba en estado 'ready'
        $readyOrder = Order::create([
            'take_away' => false,
            'state' => 'ready',
            'table_id' => 1
        ]);
        // Realizamos una solicitud GET a la ruta correspondiente para obtener los pedidos en estado 'ready' para comer aquí
        $response = $this->get(route('get.orders.eat-here.ready'));

        // Verificamos que la respuesta sea exitosa (código 200)
        $response->assertStatus(200);

        // Verificamos que la respuesta JSON contenga los datos de la orden preparada
        $response->assertJsonStructure([ // Verificamos la estructura de cada orden en la respuesta
            '*'=>[
                'id',
                'take_away',
                'table_id',
                'state',
                'created_at',
                'updated_at',
                'orders_line' => [
                    '*' => [
                        'id',
                        'order_id',
                        'product_id',
                        'quantity',
                        'product' => [
                            'id',
                            'name',
                            'description',
                            'price',
                            'image_url'
                        ]
                    ]
                ]
            ]
         ]);

        //Borra el pedido de prueba
        $readyOrder->delete();

    }

    public function test_get_ready_orders_take_away()
    {
        // Creamos un pedido de prueba en estado 'ready'
        $readyOrder = Order::create([
            'take_away' => true,
            'state' => 'ready',
            'table_id' => null
        ]);
        // Realizamos una solicitud GET a la ruta correspondiente para obtener los pedidos en estado 'ready' para llevar
        $response = $this->get(route('get.orders.take-away.ready'));

        // Verificamos que la respuesta sea exitosa (código 200)
        $response->assertStatus(200);

        // Verificamos que la respuesta JSON contenga los datos de la orden preparada
        $response->assertJsonStructure([ // Verificamos la estructura de cada orden en la respuesta
            '*'=>[
                'id',
                'take_away',
                'table_id',
                'state',
                'created_at',
                'updated_at',
                'orders_line' => [
                    '*' => [
                        'id',
                        'order_id',
                        'product_id',
                        'quantity',
                        'product' => [
                            'id',
                            'name',
                            'description',
                            'price',
                            'image_url'
                        ]
                    ]
                ]
            ]
        ]);

        //Borra el pedido de prueba
        $readyOrder->delete();

    }

    public function test_change_order_state_new_to_preparing()
    {
        // Creamos un pedido de prueba en estado 'new'
        $preparingOrder = Order::create([
            'take_away' => false,
            'state' => 'new',
            'table_id' => 1
        ]);

        // Realizamos una solicitud PUT a la ruta correspondiente para cambiar el estado del pedido de 'preparing' a 'new'
        $response = $this->put(route('change.order.state', ['order_id' => $preparingOrder->id]));

        // Verificamos que la respuesta sea exitosa (código 200)
        $response->assertStatus(200);

        // Verificamos que el estado del pedido haya cambiado a 'preparing'
        $this->assertEquals('preparing', Order::find($preparingOrder->id)->state);

        //Borra el pedido de prueba
        $preparingOrder->delete();
    }

    public function test_change_order_state_preparing_to_ready()
    {
        // Creamos un pedido de prueba en estado 'preparing'
        $preparingOrder = Order::create([
            'take_away' => false,
            'state' => 'preparing',
            'table_id' => 1
        ]);

        // Realizamos una solicitud PUT a la ruta correspondiente para cambiar el estado del pedido de 'preparing' a 'ready'
        $response = $this->put(route('change.order.state', ['order_id' => $preparingOrder->id]));

        // Verificamos que la respuesta sea exitosa (código 200)
        $response->assertStatus(200);

        // Verificamos que el estado del pedido haya cambiado a 'ready'
        $this->assertEquals('ready', Order::find($preparingOrder->id)->state);

        //Borra el pedido de prueba
        $preparingOrder->delete();
    }
}
