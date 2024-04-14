<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserCartComponent extends Component
{
    public $total = 0;

    public function __construct()
    {}

    public function render(): View|Closure|string
    {
        return view('components.user-cart-component');
    }
}
