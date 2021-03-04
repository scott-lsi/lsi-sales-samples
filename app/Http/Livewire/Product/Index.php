<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

use App\Models\Product;

class Index extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.product.index');
    }
}
