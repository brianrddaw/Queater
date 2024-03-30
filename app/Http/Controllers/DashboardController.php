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

    //Funcion para mostrar el dashboard.
    public function index(){
        return view('dashboard-views.dashboard');
    }



    //Funcion para mostrar dashboard con todos los productos .
    public function showProducts(){

        $products = Product::all();
        $categories = Category::all();
        $allergens = Allergen::all();

        //Enviar el nombre de la categoria por cada producto
        foreach ($products as $product) {
            $product->allergens = ProductsAllergens::where('product_id', $product->id)->with('allergen')->get()->pluck('allergen');
        }



        return view('dashboard-views.dashboard-products',['products' => $products, 'categories' => $categories, 'allergens' => $allergens]);
    }


    //TODO: Hacer logica y views para las categorias en dashboard
    //Funcion para mostrar las categorias.
    public function showCategories(){

        $categories = Category::all();

        return view('dashboard-views.dashboard-categories',['categories' => $categories]);
    }

    //TODO: Hacer logica y views para las mesas en dashboard
    //Funcion para mostrar las mesas.
    public function showTables(){
        return view('dashboard-views.dashboard-tables');
    }

    //Funcion para crear un nuevo producto.
    public function createNewProduct(Request $request){
        //Se recogen los datos enviados por el formulario.
        $name = $request->name;
        $price = $request->price;
        $category = $request->category;
        $description = $request->description;
        $image = $request->file('image');

        //Se guarda la imagen en la carpeta public/products_images con el nombre del producto y su extension.
        $imagePath = $image->storeAs('products_images', $name . '.' . $image->getClientOriginalExtension(), 'public');

        //Se crea un nuevo producto con los datos recogidos.
        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->category_id = $category;
        $product->image_url = $imagePath;
        $product->save();

        echo "Producto creado: Nombre: ". $request->name . "\nDescripcion: " . $request->description . "\nPrecio: " . $request->price . "\nCategoria: " . $request->category . "\nImagen: " . $imagePath;
    }

    //Funcion para actualizar un producto.
    public function updateProduct(Request $request){

        //Se recogen los datos enviados por el formulario.
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;
        $category = $request->category;
        $description = $request->description;

        //Si se recibe una imagen se guarda en la carpte public/products_images con el nombre del producto y su extension.
        if($request->file('image')){
            $image = $request->file('image');
            $imagePath = $image->storeAs('products_images', $name . '.' . $image->getClientOriginalExtension(), 'public');
            echo "Imagen recibida: " . $imagePath;
        }
        else{
            $imagePath = Product::find($id)->image_url;
            echo "No se recibio una imagen: " . $imagePath;
        };

        $product = Product::find($id);
        $product->name = $name;
        $product->price = $price;
        $product->category_id = $category;
        $product->description = $description;
        $product->image_url = $imagePath;
        $product->save();

        echo "Producto actalizado";
    }


    public function deleteProduct($id) {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Producto eliminado correctamente']);
    }


    ////////////////////////////////
    //                            //
    //         Categories         //
    //                            //
    ////////////////////////////////

    //FIXME: No se si funciona bien, no se ha probado.
    //Funcion para crear una nueva categoria.
    public function createNewCategory(Request $request){
        //Se recogen los datos enviados por el formulario.
        $name = $request->name;
        $position = $request->position;

        //Se seleccionan las categorias que tienen una posicion mayor o igual a la categoria que se va a crear.
        $categories = Category::where('position', '>=', $position)->get();

        //Se aumenta la posicion de las categorias que tienen una posicion mayor o igual a la categoria que se va a crear.
        foreach ($categories as $CategoryToChange) {
            $CategoryToChange->position = $CategoryToChange->position + 1;
            $CategoryToChange->save();
        }

        //Se crea una nueva categoria con los datos recogidos.
        $category = new Category();
        $category->name = $name;
        $category->position = $position;
        $category->save();

        echo "Categoria creada: Nombre: ". $request->name. "\nPosicion: " . $request->position;
    }


    //Funcion para editar una categoria.
    //TODO: Hacer logica para editar una categoria.
    public function updateCategory(Request $request){
        //Se recogen los datos enviados por el formulario.
        $id = $request->id;
        $name = $request->name;
        $position = $request->position;

        $category = Category::find($id);
        $category->name = $name;
        $category->position = $position;
        $category->save();

        echo "Categoria actualizada";
    }



    //Funcion para eliminar una categoria.
    public function deleteCategory($id) {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria no encontrada'], 404);
        }
        //Seleccion las categorias que tienen una posicion mayor a la categoria que se va a eliminar y se excluye la categoria guardada.
        $categories = Category::where('position', '>', $category->position)->get();

        //Se disminuye la posicion de las categorias que tienen una posicion mayor a la categoria que se va a eliminar.
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
