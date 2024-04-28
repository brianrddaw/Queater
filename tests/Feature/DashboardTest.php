<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_product_by_id(): void
    {

        $categorie = Category::create([
            'id' => 1,
            'name' => 'Categoría de prueba',
            'position' => 1,
        ]);

        $product = Product::create([
            'id' => 1, //Añadimos el id para que no de error 'Column not found: 1054 Unknown column 'id' in 'field list
            'name' => 'Producto de prueba',
            'description' => 'Descripción de prueba',
            'price' => 10,
            'category_id' => 1,
            'image_url' => ''
        ]);

        $response = $this->delete(route('dashboard.products.delete', ['id' => 1]));

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Producto eliminado correctamente'
        ]);
    }
}
