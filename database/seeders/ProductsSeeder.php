<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Allergen;
use App\Models\ProductsAllergens;
use App\Models\Category;
use App\Models\Table;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $categorys =
        [
            [
                'name' => 'Hamburguesas',
                'position' => 1
            ],
            [
                'name' => 'Ensaladas',
                'position' => 2
            ],
            [
                'name' => 'Bebidas',
                'position' => 3
            ],
            [
                'name' => 'Postres',
                'position' => 4
            ],
        ];

        $products = [
            [
                'name' => 'Hamburguesa de pollo',
                'description' => 'Deliciosa hamburguesa de pollo con lechuga, tomate y salsa barbacoa.',
                'price' => 6.95,
                'category_id' => '1',
                'image_url' => 'products_images/hamburguesa_pollo.webp',
            ],
            [
                'name' => 'Hamburguesa clásica',
                'description' => 'Una hamburguesa tradicional con carne de res, queso cheddar, lechuga, tomate, cebolla y salsa especial.',
                'price' => 7.99,
                'category_id' => '1',
                'image_url' => 'products_images/hamburguesa_clasica.webp',
            ],
            [
                'name' => 'Hamburguesa de pescado',
                'description' => 'Exquisita hamburguesa de pescado con queso cheddar, lechuga, tomate, cebolla y salsa marina.',
                'price' => 8.49,
                'category_id' => '1',
                'image_url' => 'products_images/hamburguesa_pescado.webp',
            ],
            [
                'name' => 'Hamburguesa vegetariana',
                'description' => 'Una opción vegetariana deliciosa con falafel, aguacate, lechuga, tomate, cebolla caramelizada y tahini.',
                'price' => 7.95,
                'category_id' => '1',
                'image_url' => 'products_images/hamburguesa_vegetariana.webp'
            ],
            [
                'name' => 'Ensalada griega',
                'description' => 'Una ensalada refrescante con tomate, pepino, pimiento, cebolla roja, aceitunas, queso feta y aderezo de limón.',
                'price' => 8.95,
                'category_id' => '2',
                'image_url' => 'products_images/ensalada_griega.webp'
            ],
            [
                'name' => 'Ensalada de pollo',
                'description' => 'Una ensalada saludable con quinoa, espinacas, aguacate, tomate, garbanzos y aderezo de limón.',
                'price' => 9.75,
                'category_id' => '2',
                'image_url' => 'products_images/ensalada_pollo.webp'
            ],
            [
                'name' => 'Ensalada César',
                'description' => 'La clásica ensalada César con lechuga romana, pollo a la parrilla, crutones y aderezo César.',
                'price' => 8.99,
                'category_id' => '2',
                'image_url' => 'products_images/ensalada_cesar.webp'
            ],
            [
                'name' => 'Ensalada de marisco',
                'description' => 'Una deliciosa ensalada con tomate, mozzarella fresca, albahaca, aceite de oliva y vinagre balsámico.',
                'price' => 9.25,
                'category_id' => '2',
                'image_url' => 'products_images/ensalada_marisco.webp'
            ],
            [
                'name' => 'Agua mineral',
                'description' => 'Refrescante agua mineral natural embotellada.',
                'price' => 1.20,
                'category_id' => '3',
                'image_url' => 'products_images/agua_mineral.webp'
            ],
            [
                'name' => 'Refresco de cola',
                'description' => 'Bebida gaseosa refrescante con sabor a cola.',
                'price' => 1.80,
                'category_id' => '3',
                'image_url' => 'products_images/cola.webp'
            ],
            [
                'name' => 'Jugo de naranja natural',
                'description' => 'Delicioso jugo de naranja recién exprimido, natural y lleno de vitaminas.',
                'price' => 2.50,
                'category_id' => '3',
                'image_url' => 'products_images/zumo_naranja.webp'
            ],
            [
                'name' => 'Café espresso',
                'description' => 'Café espresso fuerte y aromático recién hecho, perfecto para empezar el día o tomar un descanso.',
                'price' => 1.80,
                'category_id' => '3',
                'image_url' => 'products_images/cafe.webp'
            ],

            [
                'name' => 'Tarta de manzana',
                'description' => 'Deliciosa tarta casera de manzana con un toque de canela.',
                'price' => 3.99,
                'category_id' => '4',
                'image_url' => 'products_images/tarta_manzana.webp'
            ],
            [
                'name' => 'Cheesecake de fresa',
                'description' => 'Cheesecake cremoso con salsa de fresa y una base crujiente de galleta.',
                'price' => 5.99,
                'category_id' => '4',
                'image_url' => 'products_images/cheesecake_fresa.webp'
            ],
            [
                'name' => 'Tiramisú',
                'description' => 'Postre italiano clásico con capas de bizcocho empapado en café, crema de mascarpone y cacao en polvo.',
                'price' => 6.50,
                'category_id' => '4',
                'image_url' => 'products_images/tiramisu.webp'
            ],

        ];

        $allergens = [
            ['name' => 'Gluten', 'img_url' => 'allergens_images/gluten.webp'],

            ['name' => 'Crustaceos', 'img_url' => 'allergens_images/crustaceos.webp'],

            ['name' => 'Huevo', 'img_url' => 'allergens_images/huevos.webp'],

            ['name' => 'Pescado', 'img_url' => 'allergens_images/pescado.webp'],

            ['name' => 'Cacahuete', 'img_url' => 'allergens_images/cacahuete.webp'],

            ['name' => 'Soja', 'img_url' => 'allergens_images/soja.webp'],

            ['name' => 'Lácteos', 'img_url' => 'allergens_images/lacteos.webp'],

            ['name' => 'Frutos de cáscara','img_url' => 'allergens_images/frutos_de_cascara.webp'],

            ['name' => 'Apio', 'img_url' => 'allergens_images/apio.webp'],

            ['name' => 'Mostaza', 'img_url' => 'allergens_images/mostaza.webp'],

            ['name' => 'Sésamo', 'img_url' => 'allergens_images/sesamo.webp'],

            ['name' => 'Dióxido de azufre y sulfitos', 'img_url' => 'allergens_images/dioxido_de_azufre_y_sulfitos.webp'],

            ['name' => 'Moluscos', 'img_url' => 'allergens_images/moluscos.webp'],

            ['name' => 'Altramuces', 'img_url' => 'allergens_images/altramuces.webp'],
        ];

        $allerrgens_products = [
            ['product_id' => 1, 'allergen_id' => 1],
            ['product_id' => 2, 'allergen_id' => 1],
            ['product_id' => 3, 'allergen_id' => 1],
            ['product_id' => 4, 'allergen_id' => 1],
            ['product_id' => 4, 'allergen_id' => 7],
            ['product_id' => 6, 'allergen_id' => 3],
            ['product_id' => 7, 'allergen_id' => 1],
            ['product_id' => 7, 'allergen_id' => 7],
            ['product_id' => 8, 'allergen_id' => 13],
            ['product_id' => 13, 'allergen_id' => 1],
            ['product_id' => 13, 'allergen_id' => 7],
            ['product_id' => 14, 'allergen_id' => 1],
            ['product_id' => 14, 'allergen_id' => 7],
            ['product_id' => 14, 'allergen_id' => 8],
            ['product_id' => 15, 'allergen_id' => 1],
            ['product_id' => 15, 'allergen_id' => 3],
            ['product_id' => 15, 'allergen_id' => 6],
        ];

        $tables = [
            ['number' => 1],
            ['number' => 2],
            ['number' => 3],
            ['number' => 4],
            ['number' => 5],
            ['number' => 6],
            ['number' => 7],
            ['number' => 8],
            ['number' => 9],
            ['number' => 10],
        ];


        foreach ($categorys as $category) {
            Category::create($category);
        }

        foreach ($products as $product) {
            Product::create($product);
        }

        foreach ($allergens as $allergen) {
            Allergen::create($allergen);
        }

        foreach ($allerrgens_products as $allergen_product) {
            ProductsAllergens::create($allergen_product);
        }

        foreach ($tables as $table) {
            Table::create($table);
        }
    }
}
