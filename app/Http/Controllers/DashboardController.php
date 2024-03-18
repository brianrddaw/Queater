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

        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust validation rules as needed
        //     'name' => 'required|string',
        //     'price' => 'required|numeric',
        //     'category' => 'required|exists:categories,id', // Assuming you have a categories table
        //     'description' => 'string',
        // ]);

        $name = $request->name;
        $price = $request->price;
        $category = $request->category;
        $description = $request->description;
        $image = $request->file('image');


        $nombreArchivo = $name . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('products_images', $nombreArchivo, 'public');


        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->image_url = $imagePath;
        $product->save();

        echo "Producto creado: Nombre: ". $request->name . "\nDescripcion: " . $request->description . "\nPrecio: " . $request->price . "\nCategoria: " . $request->category_id . "\nImagen: " . $request->imagePath;
    }

    public function updateProduct(Request $request){

        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        //     'category' => 'required',
        //     'description' => 'required',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // editar producto en la base de datos
        echo "Producto creado: Nombre: ". $request->name . "\nDescripcion: " . $request->description . "\nPrecio: " . $request->price . "\nCategoria: " . $request->category_id . "\nImagen: " . $request->imagePath;
        // $product->update($validatedData);

    }

}
