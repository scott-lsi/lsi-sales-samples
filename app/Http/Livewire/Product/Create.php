<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

use App\Models\Product;

class Create extends Component
{
    public Product $product;
    public $name;
    public $sku;
    public $description;
    public $gateway_id;
    public $gateway_dropship_id;
    public $gateway_config;
    
    public function render()
    {
        return view('livewire.product.create')
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

    public function create()
    {
        // validate the input
        $this->validate([
            'name' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'gateway_id' => 'required|integer',
            'gateway_dropship_id' => 'integer|nullable',
        ]);

        // create the product
        Product::create([
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'gateway_id' => $this->gateway_id,
            'gateway_dropship_id' => $this->gateway_dropship_id,
            'gateway_config' => $this->gateway_config,
        ]);

        // clear the input fields
        $this->name = '';
        $this->sku = '';
        $this->description = '';
        $this->gateway_id = '';
        $this->gateway_dropship_id = null;
        $this->gateway_config = null;

        session()->flash('flash.banner', 'Product created!');
        session()->flash('flash.bannerStyle', 'success');
    }
}
