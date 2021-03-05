<?php

namespace App\Http\Livewire\Basket;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use Basket;

use App\Models\Order;

use App\Mail\OrderPlaced;

class Show extends Component
{
    public $basket;
    public $total;
    public $tax;
    public $subtotal;
    public $name;
    public $company;
    public $address_line_1;
    public $address_line_2;
    public $address_town;
    public $address_county;
    public $address_postcode;
    public $thanks;

    protected $listeners = ['basketUpdate'];

    public function basketUpdate($message)
    {
        $this->basket = Basket::content()->toArray();
        $this->total = Basket::total();
        $this->tax = Basket::tax();
        $this->subtotal = Basket::subtotal();

        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', 'success');
    }

    public function mount()
    {
        $this->basket = Basket::content()->toArray();
        $this->total = Basket::total();
        $this->tax = Basket::tax();
        $this->subtotal = Basket::subtotal();
        $this->thanks = '';
    }

    public function render()
    {
        return view('livewire.basket.show')
            ->layout('layouts.app');
    }

    public function updated($field)
    {
        // validate on update
        $this->validateOnly($field, [
            'name' => 'required',
            'company' => 'required',
            'address_line_1' => 'required',
            'address_town' => 'required',
            'address_postcode' => 'required',
        ]);
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'company' => 'required',
            'address_line_1' => 'required',
            'address_town' => 'required',
            'address_postcode' => 'required',
        ]);
        
        $stored_basket_id = Str::uuid();
        Basket::store($stored_basket_id);

        $order = new Order;
        $order->name = $this->name;
        $order->company = $this->company;
        $order->address_line_1 = $this->address_line_1;
        $order->address_line_2 = $this->address_line_2;
        $order->address_town = $this->address_town;
        $order->address_county = $this->address_county;
        $order->address_postcode = $this->address_postcode;
        $order->stored_basket_id = $stored_basket_id;
        $order->save();

        session()->flash('flash.banner', 'Your order has been submitted!');
        session()->flash('flash.bannerStyle', 'success');

        Basket::destroy();
        $this->basket = Basket::content();

        $this->thanks = '<h1 class="text-3xl mt-4 mb-8">Thank You!</h1>';
        $this->thanks .= '<p>Your order has been stored for approval.</p>';

        Mail::to(env('SALESPERSON_EMAIL'))
            ->send(new OrderPlaced($order));
    }
}
