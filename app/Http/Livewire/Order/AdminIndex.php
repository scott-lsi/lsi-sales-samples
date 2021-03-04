<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;

use App\Models\Order;

class AdminIndex extends Component
{
    public $orders;
    public $tableTitle;

    public function mount()
    {
        $this->orders = Order::latest()->get();
        $this->tableTitle = 'All orders';
    }

    public function render()
    {
        return view('livewire.order.admin-index');
    }

    public function allOrders()
    {
        $this->orders = Order::latest()->get();
        $this->tableTitle = 'All orders';
    }

    public function unsubmittedOrders()
    {
        $this->orders = Order::where('submitted_to_gateway', false)->latest()->get();
        $this->tableTitle = 'Unsubmitted orders';
    }

    public function submittedOrders()
    {
        $this->orders = Order::where('submitted_to_gateway', true)->latest()->get();
        $this->tableTitle = 'Submitted orders';
    }
    
    public function deletedOrders()
    {
        $this->orders = Order::onlyTrashed()->latest()->get();
        $this->tableTitle = 'Deleted Orders';
    }

    public function delete($order_id)
    {
        Order::find($order_id)->delete();
        
        session()->flash('flash.banner', 'Order deleted!');
        session()->flash('flash.bannerStyle', 'success');

        if($this->tableTitle === 'Unsubmitted Orders'){
            $this->orders = Order::where('submitted_to_gateway', false)->latest()->get();
        } else {
            $this->orders = Order::latest()->get();
        }
    }

    public function restore($order_id)
    {
        Order::withTrashed()->find($order_id)->restore();
        
        session()->flash('flash.banner', 'Order restored!');
        session()->flash('flash.bannerStyle', 'success');

        $this->orders = Order::latest()->get();
        $this->tableTitle = 'Current Orders';
    }

    public function destroy($order_id)
    {
        Order::withTrashed()->find($order_id)->forceDelete();
        
        session()->flash('flash.banner', 'Order permanently deleted!');
        session()->flash('flash.bannerStyle', 'success');

        $this->orders = Order::onlyTrashed()->latest()->get();
        $this->tableTitle = 'Deleted Orders';
    }
}
