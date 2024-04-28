<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrdersLine;
use App\Models\Category;


class GraphsTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_data_top_5_in_week()
    {
        //Creamos un pedido de prueba
        $order = Order::create([
            'state' => 'delivered',
            'take_away' => false,
            'table_id' => 1
        ]);

        //Creamos una categoría de prueba
        $category = Category::create([
            'name' => 'Categoría de prueba',
            'position' => 1,
        ]);

        //Creamos un producto de prueba
        $product = Product::create([
            'name' => 'Producto de prueba',
            'description' => 'Descripción de prueba',
            'price' => 10,
            'category_id' => 1,
            'image_url' => ''
        ]);


        //Creamos una order line de prueba del pedido
        $orderLine = $order->ordersLine()->create([
            'product_id' => 1,
            'quantity' => 1
        ]);


        $response = $this->get(route('dashboard.graph.top-5'));

        // Verificamos que la respuesta sea exitosa (código 200)
        $response->assertStatus(200);

        // Verificamos que la respuesta JSON contenga los datos de los 5 productos más vendidos
        $response->assertJsonStructure([ // Verificamos la estructura de cada producto en la respuesta
            '*' => [
                'name',
                'total'
            ]
        ]);
    }

    public function test_get_data_sales_of_last_7_days()
    {
        $response = $this->get(route('dashboard.graph.sales-of-last-7-days'));

        // Verificamos que la respuesta sea exitosa (código 200)
        $response->assertStatus(200);
        //Imprime en consola la respuesta

        // Verificamos que la respuesta JSON contenga los datos de los 5 productos más vendidos
        $response->assertJsonStructure([ // Verificamos la estructura de cada producto en la respuesta
            'labels',
            'data'
        ]);
    }
}
