@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div>
            <div class="mb-4">
                <input
                    type="text"
                    wire:model="search"
                    placeholder="Buscar por ID ou nome do cliente"
                    class="form-input"
                >
                <input
                    type="date"
                    wire:model="date"
                    class="form-input"
                >
            </div>

            <table class="table-auto w-full border-collapse">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Cliente</th>
                    <th>Data</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->nome_cliente }}</td>
                        <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                        <td>{{ $pedido->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Nenhum pedido encontrado</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $pedidos->links() }}
            </div>
        </div>

    </div>
@endsection
