<?php

namespace App\Http\Livewire\ProductImage;

use Livewire\Component;

use App\Models\ProductImage;

class Edit extends Component
{
    public $product;
    public $product_image;

    public function render()
    {
        return view('livewire.product-image.edit');
    }
}
