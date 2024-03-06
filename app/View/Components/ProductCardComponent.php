<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;


class ProductCardComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $name,
        public $description,
        public $price,
        public $id
    )
    {}
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card-component');
    }
}
