<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use Illuminate\Support\Facades\DB;

class EatHereController extends Controller
{

    public function eatHere($table)
    {
        //Verificar si la mesa existe.
        $tableExist = DB::select('select id from tables where id = ?', [$table]);
        if (empty($tableExist)) {
            return redirect()->route('error', [
                'error' => 'Ruta no encontrada',
                'code' => '404',
                'message' => 'La mesa a la que intentas acceder no existe.'
            ]);
        }






        $categorys = DB::select('select id,name,position from categories order by position');
        $productsByCategory = [];

        foreach ($categorys as $category) {
            $products = DB::select('select id,name,description,price,availability,image_url from products where availability = 1 and category_id = ?', [$category->id]);
            foreach ($products as $product) {
                $product->allergens = DB::select('
                SELECT allergens.name, allergens.img_url
                FROM allergens
                INNER JOIN products_allergens ON allergens.id = products_allergens.allergen_id
                WHERE products_allergens.product_id = ?
                ',
                [$product->id]);
            }
            $productsByCategory[$category->name] = $products;
        }

        return view(
            'user-views.menu',
            [
                'productsByCategory' => $productsByCategory,
                'takeAway' => 0,
                'tableId' => $table,
            ],
        );
    }
}
