<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrdersLine;
use App\Models\Session;
use Illuminate\Support\Facades\Storage;


class DashboardController extends Controller
{
    public function index()

    {
        return view('dashboard-views.dashboard');
    }

    public function showProducts()
    {

        $products = Product::all();
        //Enviar el nombre de la categoria por cada producto
        foreach ($products as $product) {
            $product->category_name = Category::find($product->category_id)->name;
        }
        $categories = Category::all();
        return view('dashboard-views.dashboard-products',['products' => $products, 'categories' => $categories]);
    }


    //Funcion para mostrar las categorias.
    public function showCategories()
    {
        return view('dashboard-views.dashboard-categories');
    }

    //Funcion para mostrar las mesas.
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



        $nombreArchivo = $name . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('products_images', $nombreArchivo, 'public');


        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->category_id = $category;
        $product->image_url = $imagePath;
        $product->save();

        echo "Producto creado: Nombre: ". $request->name . "\nDescripcion: " . $request->description . "\nPrecio: " . $request->price . "\nCategoria: " . $request->category_id . "\nImagen: " . $request->imagePath;
    }

    public function updateProduct(Request $request){

        // editar producto en la base de datos
        echo "Producto creado: Id: " . $request->id . "\n Nombre: " . $request->name . "\nDescripcion: " . $request->description . "\nPrecio: " . $request->price . "\nCategoria: " . $request->category_id . "\nImagen: " . $request->imagePath;

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        // $product->image_url = $request->imagePath;
        // $product->category_id = $request->category_id;
        $product->description = $request->description;


        $product->save();

    }

}
