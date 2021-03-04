<?php

namespace App\Http\Livewire\Basket;

use Livewire\Component;

use Basket;

use App\Models\Product;

class Row extends Component
{
    public $row;
    public $quantity;
    public $price;

    public function mount($row)
    {
        $this->row = $row;
        $this->quantity = $this->row['qty'];
    }

    public function render()
    {
        return view('livewire.basket.row');
    }

    public function updateQuantity()
    {
        $row = Basket::update($this->row['rowId'], [
            'qty' => $this->quantity,
            'price' => 0,
        ])->toArray();

        $this->row = $row;
        
        $this->emit('basketUpdate', 'Quantity updated!');
    }

    public function delete()
    {
        Basket::remove($this->row['rowId']);
        
        $this->emit('basketUpdate', 'Item removed!');
    }
}
