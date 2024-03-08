<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Counter extends Component
{

    public $count = 0;
    public $products;


    public function increment()
    {
        $this->count++;
    }


    public function decrement()
    {
        $this->count--;
    }


    public function getProducts(){

        $this->products = Product::all();



        return $this->products;

    }


    public function mount()
    {
        $this->products = $this->getProducts();
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
