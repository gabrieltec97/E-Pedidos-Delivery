<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SearchOrders extends Component
{
    public $searchTerm = ''; // Termo de busca
    public $orders;// Resultados da busca
    public $items;// Resultados da busca

    protected $listeners = ['abrirModalPedido' => 'abrirModal'];

    public function abrirModal($orderId)
{
    $this->dispatch('abrir-modal', orderId: $orderId);
}

    


    public function render()
    {
        $this->items = OrderItems::all();
        $this->orders = Order::where('id', 'like', '%'.$this->searchTerm.'%')
            ->orwhere('user_name', 'like', '%'.$this->searchTerm.'%')
            ->get();
        return view('livewire.search-orders');
    }
}
