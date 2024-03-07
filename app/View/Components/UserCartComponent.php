<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\OrdersLine;
use Illuminate\Support\Facades\DB;

class UserCartComponent extends Component
{
    // Inicializamos el total en 0 para evitar errores de variables vacías
    public $total = 0;

    /**
     * Create a new component instance.
     */

    public function __construct()
    {


        $this->total = OrdersLine::join('products', 'orders_lines.product_id', '=', 'products.id')
            ->select(DB::raw('SUM(orders_lines.quantity * products.price) as total'))
            ->where('order_id', session('order_id'))
            ->first()->total;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-cart-component');
    }
}
