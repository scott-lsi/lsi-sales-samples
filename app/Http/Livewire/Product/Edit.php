<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

use App\Models\Product;
use App\Models\ProductImage;

class Edit extends Component
{
    public Product $product;
    public $product_id;
    public $name;
    public $sku;
    public $description;
    public $gateway_id;
    public $gateway_dropship_id;
    public $gateway_config;
    public $image;
    public $image_order;

    protected $listeners = ['relationUpdate'];

    public function relationUpdate()
    {
        $this->product = $this->product->refresh();
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->product_id = $product->product_id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->description = $product->description;
        $this->gateway_id = $product->gateway_id;
        $this->gateway_dropship_id = $product->gateway_dropship_id;
        $this->gateway_config = $product->gateway_config;
    }

    public function render()
    {
        return view('livewire.product.edit')
            ->layout('layouts.app');
    }

    public function updated($field)
    {
        // validate on update
        $this->validateOnly($field, [
            'name' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'gateway_id' => 'required|integer',
            'gateway_dropship_id' => 'integer|nullable',
        ]);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'gateway_id' => 'required|integer',
            'gateway_dropship_id' => 'integer|nullable',
        ]);

        $updatedProduct = $this->product->updateOrCreate(
            ['id' => $this->product_id],
            [
                'name' => $this->name,
                'sku' => $this->sku,
                'description' => $this->description,
                'gateway_id' => $this->gateway_id,
                'gateway_dropship_id' => $this->gateway_dropship_id,
                'gateway_config' => $this->gateway_config,
            ]
        );
        
        $this->product = $updatedProduct;

        session()->flash('flash.banner', 'Product updated!');
        session()->flash('flash.bannerStyle', 'success');
    }

    public function updateImageOrder()
    {
        if($this->image_order){
            foreach(json_decode($this->image_order, true) as $i=>$image_id){
                $this->product->product_images->find($image_id)->update([
                    'sort_order' => $i
                ]);
            }

            $this->emit('relationUpdate');
        }
    }
}
