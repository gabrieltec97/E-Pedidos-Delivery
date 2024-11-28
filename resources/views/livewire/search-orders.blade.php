<div class="card mb-4">
    <div class="card-header pb-0">
        <h6>Busca de Pedidos</h6>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="p-4">
            <input
                type="text"
                class="form-control"
                placeholder="Digite o ID do pedido ou o nome do cliente..."
                wire:model.live.debounce.150ms="searchTerm"
            />
        </div>
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cliente</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Id do pedido</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->user_name }}</td>
                        <td>{{ $order->id }}</td>
                        <td class="text-center">{{ $order->status }}</td>
                        <td class="text-center">{{ $order->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Nenhum pedido encontrado.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
