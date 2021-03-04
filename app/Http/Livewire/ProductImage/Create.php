<?php

namespace App\Http\Livewire\ProductImage;

use Illuminate\Support\Str;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Product;

class Create extends Component
{
    use WithFileUploads;

    public $product;
    public $image;

    public function render()
    {
        return view('livewire.product-image.create');
    }

    public function create($product_id)
    {
        $filename = Str::snake($this->product->name) . '-' . Str::random(10) . '.' . $this->image->extension();
        $this->image->storeAs('public/products', $filename);

        $product = Product::find($product_id);
        $product->product_images()->create([
            'filename' => $filename,
            'sort_order' => $product->product_images->count()
        ]);

        $this->emit('relationUpdate');
    }
}
