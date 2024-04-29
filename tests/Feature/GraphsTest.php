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

        //COgemos todos los productos

        //Creamos una categoría de prueba
        $category = Category::create([
            'id' => 1, //Añadimos el id para que no de error 'Column not found: 1054 Unknown column 'id' in 'field list'
            'name' => 'Categoría de prueba',
            'position' => 1,
        ]);

        $product = Product::create([
            'id' => 1, //Añadimos el id para que no de error 'Column not found: 1054 Unknown column 'id' in 'field list'
            'name' => 'Producto de prueba',
            'description' => 'Descripción de prueba',
            'price' => 10,
            'category_id' => 1,
            'image_url' => ''
        ]);
        $order = Order::create([
            'id' => 1, //Añadimos el id para que no de error 'Column not found: 1054 Unknown column 'id' in 'field list
            'state' => 'delivered',
            'take_away' => false,
            'table_id' => 1
        ]);
        $ordersLine = OrdersLine::create([
            'id' => 1, //Añadimos el id para que no de error 'Column not found: 1054 Unknown column 'id' in 'field list
            'order_id' => 1,
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
        // Verificamos que la respuesta JSON contenga los datos de los 5 productos más vendidos
        $response->assertJsonStructure([ // Verificamos la estructura de cada producto en la respuesta
            'labels',
            'data'
        ]);
    }
}
