<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

use App\Models\Product;

class AdminIndex extends Component
{
    public $products;
    public $tableTitle;

    public function mount()
    {
        $this->products = Product::orderBy('name')->get();
        $this->tableTitle = 'Current Products';
    }

    public function render()
    {
        return view('livewire.product.admin-index')
            ->layout('layouts.app');
    }

    public function delete($product_id)
    {
        Product::find($product_id)->delete();
        
        session()->flash('flash.banner', 'Product deleted!');
        session()->flash('flash.bannerStyle', 'success');

        $this->products = Product::orderBy('name')->get();
    }

    public function restore($product_id)
    {
        Product::withTrashed()->find($product_id)->restore();
        
        session()->flash('flash.banner', 'Product restored!');
        session()->flash('flash.bannerStyle', 'success');

        $this->products = Product::orderBy('name')->get();
        $this->tableTitle = 'Current Products';
    }

    public function destroy($product_id)
    {
        Product::withTrashed()->find($product_id)->forceDelete();
        
        session()->flash('flash.banner', 'Product permanently deleted!');
        session()->flash('flash.bannerStyle', 'success');

        $this->products = Product::orderBy('name')->onlyTrashed()->get();
        $this->tableTitle = 'Deleted Products';
    }
    
    public function currentProducts()
    {
        $this->products = Product::orderBy('name')->get();
        $this->tableTitle = 'Current Products';
    }
    
    public function deletedProducts()
    {
        $this->products = Product::orderBy('name')->onlyTrashed()->get();
        $this->tableTitle = 'Deleted Products';
    }
}
