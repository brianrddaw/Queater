<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextCardComponent extends Component
{

    public function __construct(
        public string $message
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        return view('user-views.components.text-card-component');
    }
}

