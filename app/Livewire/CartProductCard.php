<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class CartProductCard extends Component
{

    public $order;

    public function render()
    {
        return view('livewire.cart-product-card');
    }
}
