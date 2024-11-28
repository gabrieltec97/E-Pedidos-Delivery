<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SearchOrders extends Component
{
    public $searchTerm = ''; // Termo de busca
    public $orders;// Resultados da busca


    public function render()
    {
        $this->orders = Order::where('id', 'like', '%'.$this->searchTerm.'%')
            ->orwhere('user_name', 'like', '%'.$this->searchTerm.'%')
            ->get();
        return view('livewire.search-orders');
    }
}
