<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Allergen;
use App\Models\ProductsAllergens;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrdersLine;
use App\Models\Session;
use Illuminate\Support\Facades\Storage;



class DashboardController extends Controller
{

    //Funcion para mostrar el dashboard.
    public function index(){
        return view('dashboard-views.dashboard');
    }



    //Funcion para mostrar dashboard con todos los productos .
    public function showProducts(){

        $products = Product::all();
        $categories = DB::select('select id,name,position from categories order by position');
        $allergens = Allergen::all();




        //Enviar el nombre de la categoria por cada producto
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


    //Funcion para mostrar las categorias.
    public function showCategories(){
        //Recoge las categorias ordenadas por la posicion.
        $categories = Category::orderBy('position')->get();

        return view('dashboard-views.dashboard-categories',['categories' => $categories]);
    }

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
        $allergens = JSON_decode($request->allergens);

        //Se crean las instancias de los productos relacionados con los alergenos en la tabla products_allergens.


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

        foreach ($allergens as $allergen) {
            $productAllergen = new ProductsAllergens();
            $productAllergen->product_id = $product->id;
            $productAllergen->allergen_id = $allergen;
            $productAllergen->save();
        }
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
        //Guarda los alergenos como array.
        $allergens = JSON_decode($request->allergens);

        //Crea o elimina isntancias del producto relacionado con el allergeno en la tabla products_allergens.
        $productAllergen = ProductsAllergens::where('product_id', $id);
        $productAllergen->delete();

        foreach ($allergens as $allergen) {
                $productAllergen = new ProductsAllergens();
                $productAllergen->product_id = $id;
                $productAllergen->allergen_id = $allergen;
                $productAllergen->save();
        }
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

    //Funcion para crear una nueva categoria.
    public function createNewCategory(Request $request){
        //Se recogen los datos enviados por el formulario.
        $name = $request->name;
        $position = $request->position;

        $categories = Category::where('position', '>=', $position)->get();
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
    public function updateCategory(Request $request){
        //Se recogen los datos enviados por el formulario.
        $id = $request->id;
        $name = $request->name;
        $position = $request->position;

        $category = Category::find($id);
        //si la posicion cambia se actualizan las posiciones de las categorias.

        if ($category->position != $position) {
            if($position > $category->position){
                //Si la posicion de la categoria se cambia a una mayor se disminuye la posicion de las categorias que estan entre la categoria que se va a actualizar y la nueva posicion incluyendo la misma.

                $categories = $categories = Category::where('position', '<=', $position)
                            ->where('position', '>', $category->position)
                            ->get();


                foreach ($categories as $CategoryToChange) {
                    $CategoryToChange->position = $CategoryToChange->position - 1;
                    $CategoryToChange->save();
                }
            }else{
                //Si la posicion de la categoria se cambia a una menor se aumenta la posicion de las categorias que tienen una posicion mayor a la categoria que se va a actualizar.

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

        echo "Categoria actualizada: Id: ".$request->id. "\nNombre: ". $request->name. "\nPosicion: " . $request->position;
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
