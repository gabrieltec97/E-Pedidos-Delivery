<div class="card mb-4">
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Cliente</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Id do pedido</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Status</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Data</th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
                </thead>
                <tbody>
    @foreach($orders as $order)
    <tr>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $order->user_name }}</h6>
                    <p class="text-xs text-secondary mb-0">{{ $order->neighborhood }}</p>
                </div>
            </div>
        </td>
        <td>
            <h5 class="text-xs font-weight-bold mb-0">#{{ $order->id }}</h5>
        </td>
        <td class="align-middle text-center text-sm">
            <span class="badge badge-sm
                @if($order->status == 'Novo Pedido') bg-gradient-info
                @elseif($order->status == 'Em Preparação') bg-gradient-warning
                @elseif($order->status == 'Em rota de entrega') bg-gradient-primary
                @elseif($order->status == 'Cancelado') bg-gradient-danger
                @elseif($order->status == 'Pedido Entregue') bg-gradient-success
                @endif
            ">{{ $order->status }}</span>
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{ $order->created_at }}</span>
        </td>
        <td class="align-middle">
        <a href="javascript:;" 
   data-bs-toggle="modal" 
   data-bs-target="#abrirModal"
   data-id="{{ $order->id }}"
   data-nome="{{ $order->user_name }}"
   data-bairro="{{ $order->neighborhood }}"
   data-status="{{ $order->status }}"
   data-data="{{ $order->created_at }}"
   class="text-secondary font-weight-bold text-xs abrir-detalhes">
   Detalhes
</a>

        </td>
    </tr>

@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('abrirModal');

        // Escuta quando o modal vai ser mostrado
        modal.addEventListener('show.bs.modal', function (event) {
            const botao = event.relatedTarget;

            // Pega os dados
            const id = botao.getAttribute('data-id');
            const nome = botao.getAttribute('data-nome');
            const bairro = botao.getAttribute('data-bairro');
            const status = botao.getAttribute('data-status');
            const data = botao.getAttribute('data-data');

            // Atualiza o conteúdo do modal
            modal.querySelector('.modal-title').textContent = `Pedido #${id}`;
            modal.querySelector('.modal-body').innerHTML = `
                <p><strong>Cliente:</strong> ${nome}</p>
                <p><strong>Bairro:</strong> ${bairro}</p>
                <p><strong>Status:</strong> ${status}</p>
                <p><strong>Data:</strong> ${data}</p>
            `;
        });
    });
</script>

</tbody>

            </table>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="abrirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>







