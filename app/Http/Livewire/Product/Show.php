<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

use App\Models\Product;

class Show extends Component
{
    public Product $product;
    public $main_product_image;

    public function mount()
    {
        $this->main_product_image = $this->product->main_product_image;
    }

    public function render()
    {
        return view('livewire.product.show')
            ->layout('layouts.app');
    }
}
