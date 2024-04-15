<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Allergen;
use App\Models\ProductsAllergens;
use App\Models\Category;


class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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
                'description' => 'Lechuga, tomate, salsa barbacoa',
                'price' => 7.75,
                'category_id' => '1',
            ],
            [
                'name' => 'Hamburguesa clásica',
                'description' => 'Carne de res, queso cheddar, lechuga, tomate, cebolla, salsa especial',
                'price' => 8.99,
                'category_id' => '1',
            ],
            [
                'name' => 'Hamburguesa pescado',
                'description' => 'Pescado, queso cheddar, lechuga, tomate, cebolla, salsa marina',
                'price' => 8.99,
                'category_id' => '1',
            ],
            [
                'name' => 'Ensalada César',
                'description' => 'Lechuga romana, pollo a la parrilla, crutones, aderezo César',
                'price' => 9.50,
                'category_id' => '2',
            ],
            [
                'name' => 'Refresco de cola',
                'description' => 'Bebida gaseosa con sabor a cola',
                'price' => 2.50,
                'category_id' => '3',
            ],
            [
                'name' => 'Tarta de manzana',
                'description' => 'Tarta de manzana casera con canela',
                'price' => 4.99,
                'category_id' => '4',
            ],
            [
                'name' => 'Ensalada de quinoa',
                'description' => 'Quinoa, espinacas, aguacate, tomate, garbanzos, aderezo de limón',
                'price' => 10.25,
                'category_id' => '2',
            ],
            [
                'name' => 'Agua mineral',
                'description' => 'Agua mineral natural embotellada',
                'price' => 1.50,
                'category_id' => '3',
            ],
            [
                'name' => 'Cheesecake de fresa',
                'description' => 'Cheesecake con salsa de fresa y base de galleta',
                'price' => 6.99,
                'category_id' => '4',
            ],
            [
                'name' => 'Hamburguesa vegetariana',
                'description' => 'Falafel, aguacate, lechuga, tomate, cebolla caramelizada, tahini',
                'price' => 9.75,
                'category_id' => '1',
            ],
            [
                'name' => 'Ensalada caprese',
                'description' => 'Tomate, mozzarella fresca, albahaca, aceite de oliva, vinagre balsámico',
                'price' => 8.50,
                'category_id' => '2',
            ],
            [
                'name' => 'Jugo de naranja natural',
                'description' => 'Jugo de naranja recién exprimido',
                'price' => 3.25,
                'category_id' => '3',
            ],
            [
                'name' => 'Tiramisú',
                'description' => 'Postre italiano con capas de bizcocho, café, mascarpone y cacao',
                'price' => 7.50,
                'category_id' => '4',
            ],
            [
                'name' => 'Hamburguesa de salmón',
                'description' => 'Salmón a la parrilla, espinacas, aguacate, mayonesa de wasabi',
                'price' => 10.99,
                'category_id' => '1',
            ],
            [
                'name' => 'Ensalada griega',
                'description' => 'Tomate, pepino, pimiento, cebolla roja, aceitunas, queso feta, aderezo de limón',
                'price' => 9.25,
                'category_id' => '2',
            ],
            [
                'name' => 'Café espresso',
                'description' => 'Café espresso recién hecho',
                'price' => 2.00,
                'category_id' => '3',
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
            [
            'product_id' => '1',
            'allergen_id' => '1'

            ],
            [
            'product_id' => '1',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '1',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '2',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '2',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '2',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '2',
            'allergen_id' => '7'
            ],
            [
            'product_id' => '3',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '3',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '3',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '4',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '4',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '4',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '5',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '5',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '5',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '6',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '6',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '6',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '6',
            'allergen_id' => '7'
            ],
            [
            'product_id' => '7',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '7',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '7',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '8',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '8',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '8',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '9',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '9',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '9',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '10',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '10',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '10',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '11',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '11',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '11',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '12',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '12',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '12',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '13',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '13',
            'allergen_id' => '2'
            ],
            [

            'product_id' => '13',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '14',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '14',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '14',
            'allergen_id' => '3'
            ],
            [
            'product_id' => '15',
            'allergen_id' => '1'
            ],
            [
            'product_id' => '15',
            'allergen_id' => '2'
            ],
            [
            'product_id' => '15',
            'allergen_id' => '3'
            ]
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
    }
}
