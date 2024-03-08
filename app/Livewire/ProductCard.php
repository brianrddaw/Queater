<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductCard extends Component
{

    public $product;

    public function render()
    {

        return view('user-views.user-product.product-card');

    }

    public function addToCart($productId)
    {
        //Transformo el producto a un array

        echo json_encode($productId);
    }
}
