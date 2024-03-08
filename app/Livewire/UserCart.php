<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\OrdersLine;
use Illuminate\Support\Facades\DB;

class UserCart extends Component
{


public function render()
{
    $orders = OrdersLine::all();

    $total = OrdersLine::join('products', 'orders_lines.product_id', '=', 'products.id')
    ->sum(\DB::raw('products.price * orders_lines.quantity'));

    return view('livewire.user-cart', [
        'orders' => $orders,
        'total' => $total
    ]);
}
}
