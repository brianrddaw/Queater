<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductCard extends Component
{

    public $product;

    public function render()
    {
        return view('livewire.product-card');
    }
}
