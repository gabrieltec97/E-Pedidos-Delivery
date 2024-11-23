<?php

namespace App\Livewire;

use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithPagination;

class BuscarPedidos extends Component
{
    use WithPagination;

    public $search = ''; // Termo de busca (ID ou nome)
//    public $date = null; // Data de busca
    public $perPage = 10; // Quantidade por página

    protected $queryString = ['search']; // Filtros persistem na URL

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $pedidos = Pedido::query()
            ->when($this->search, function ($query) {
                $query->where('id', $this->search)
                    ->orWhere('nome_cliente', 'like', '%' . $this->search . '%');
            })
//            ->when($this->date, function ($query) {
//                $query->whereDate('created_at', $this->date);
//            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.buscar-pedidos', compact('pedidos'));
    }
}
