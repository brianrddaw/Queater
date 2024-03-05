<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserta datos de ejemplo para Products
        Product::create([
            'name' => 'Hamburguesa con papas fritas',
            'description' => 'Deliciosa hamburguesa con carne de res, lechuga, tomate y papas fritas.',
            'price' => 10.99,
            'availability' => true,
        ]);

        Product::create([
            'name' => 'Refresco de cola',
            'description' => 'Refresco de cola frío y refrescante.',
            'price' => 2.49,
            'availability' => true,
        ]);

        Product::create([
            'name' => 'Tarta de manzana',
            'description' => 'Deliciosa tarta de manzana casera con canela y crema.',
            'price' => 4.99,
            'availability' => true,
        ]);

        Product::create([
            'name' => 'Café',
            'description' => 'Café caliente recién hecho.',
            'price' => 1.99,
            'availability' => true,
        ]);

        Product::create([
            'name' => 'Té',
            'description' => 'Té caliente recién hecho.',
            'price' => 1.99,
            'availability' => true,
        ]);

        Product::create([
            'name' => 'Agua mineral',
            'description' => 'Agua mineral fría.',
            'price' => 1.49,
            'availability' => true,
        ]);

        Product::create([
            'name' => 'Ensalada César',
            'description' => 'Ensalada César con pollo, lechuga, tomate, queso parmesano y aderezo.',
            'price' => 8.99,
            'availability' => true,
        ]);

        Product::create([
            'name' => 'Sopa de tomate',
            'description' => 'Sopa de tomate caliente.',
            'price' => 4.99,
            'availability' => true,
        ]);

        Product::create([
            'name' => 'Sándwich de pollo',
            'description' => 'Sándwich de pollo con lechuga, tomate y mayonesa.',
            'price' => 6.99,
            'availability' => true,
        ]);
        
    }
}
