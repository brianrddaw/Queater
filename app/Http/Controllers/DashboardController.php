<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Allergen;
use App\Models\ProductsAllergens;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboard-views.dashboard');
    }

    public function showProducts()
    {

        $products = Product::all();
        $categories = DB::select('select id,name,position from categories order by position');
        $allergens = Allergen::all();

        foreach ($products as $product) {
            $product->allergens = ProductsAllergens::where('product_id', $product->id)->with('allergen')->get()->pluck('allergen');
        }

        $productsByCategory = [];
        foreach ($categories as $category) {
            $productsByCategory[$category->name] = [];
            foreach ($products as $product) {
                if ($product->category_name == $category->name) {
                    array_push($productsByCategory[$category->name], $product);
                }
            }
        }

        return view('dashboard-views.dashboard-products',[
            // 'products' => $products,
            'categories' => $categories,
            'allergens' => $allergens,
            'productsByCategory' => $productsByCategory
        ]);
    }

    public function showCategories()
    {
        $categories = Category::orderBy('position')->get();
        return view('dashboard-views.dashboard-categories',['categories' => $categories]);
    }

    public function showTables()
    {
        return view('dashboard-views.dashboard-tables');
    }

    public function createNewProduct(Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $category = $request->category;
        $description = $request->description;
        $image = $request->file('image');
        $allergens = JSON_decode($request->allergens);
        $imagePath = $image->storeAs('products_images', $name . '.' . $image->getClientOriginalExtension(), 'public');


        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->category_id = $category;
        $product->image_url = $imagePath;
        $product->save();

        foreach ($allergens as $allergen) {
            $productAllergen = new ProductsAllergens();
            $productAllergen->product_id = $product->id;
            $productAllergen->allergen_id = $allergen;
            $productAllergen->save();
        }
    }

    public function updateProduct(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;
        $category = $request->category;
        $description = $request->description;
        $allergens = JSON_decode($request->allergens);

        $productAllergen = ProductsAllergens::where('product_id', $id);
        $productAllergen->delete();

        foreach ($allergens as $allergen) {
                $productAllergen = new ProductsAllergens();
                $productAllergen->product_id = $id;
                $productAllergen->allergen_id = $allergen;
                $productAllergen->save();
        }
        if($request->file('image')){
            $image = $request->file('image');
            $imagePath = $image->storeAs('products_images', $name . '.' . $image->getClientOriginalExtension(), 'public');
        }
        else{
            $imagePath = Product::find($id)->image_url;
        };

        $product = Product::find($id);
        $product->name = $name;
        $product->price = $price;
        $product->category_id = $category;
        $product->description = $description;
        $product->image_url = $imagePath;
        $product->save();
    }


    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Producto eliminado correctamente']);
    }

    public function createNewCategory(Request $request)
    {
        $name = $request->name;
        $position = $request->position;

        $categories = Category::where('position', '>=', $position)->get();
        foreach ($categories as $CategoryToChange) {
            $CategoryToChange->position = $CategoryToChange->position + 1;
            $CategoryToChange->save();
        }

        $category = new Category();
        $category->name = $name;
        $category->position = $position;
        $category->save();
    }

    public function updateCategory(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $position = $request->position;

        $category = Category::find($id);

        if ($category->position != $position) {
            if($position > $category->position) {

                $categories = $categories = Category::where('position', '<=', $position)
                            ->where('position', '>', $category->position)
                            ->get();

                foreach ($categories as $CategoryToChange) {
                    $CategoryToChange->position = $CategoryToChange->position - 1;
                    $CategoryToChange->save();
                }
            }else{
                $categories = $categories = Category::where('position', '>=', $position)
                            ->where('position', '<', $category->position)
                            ->get();

                foreach ($categories as $CategoryToChange) {
                    $CategoryToChange->position = $CategoryToChange->position + 1;
                    $CategoryToChange->save();
                }
            }
        }

        $category->name = $name;
        $category->position = $position;
        $category->save();
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria no encontrada'], 404);
        }

        $categories = Category::where('position', '>', $category->position)->get();

        foreach ($categories as $CategoryToChange) {
            $CategoryToChange->position = $CategoryToChange->position - 1;
            $CategoryToChange->save();
        }

        $category->delete();

        return response()->json(['message' => 'Categoria eliminada correctamente',
                                 'category' => $category->name,
                                 'other_categories' => $categories
                                ]);
    }

}
