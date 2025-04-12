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
                                            @if($order->status == 'Novo Pedido')
                                                bg-gradient-info
                                            @elseif($order->status == 'Em Preparação')
                                                bg-gradient-warning
                                            @elseif($order->status == 'Em rota de entrega')
                                                bg-gradient-primary
                                            @elseif($order->status == 'Cancelado')
                                                bg-gradient-danger
                                            @elseif($order->status == 'Pedido Entregue')
                                                bg-gradient-success
                                            @endif
                                           ">{{ $order->status }}</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $order->created_at }}</span>
                        </td>
                        <td class="align-middle">
                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                               data-bs-toggle="modal" data-bs-target="#order{{ $order->id }}">
                                Detalhes
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade bd-example-modal-lg" id="order{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Pedido {{ $order->id }}</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col-12">
                                                <p class="my-orders">
                                                    <b> {{ $order->user_name }} - {{ $order->created_at }}</b>
                                                </p>

                                                <p class="my-status font-weight-bold
                                            @if($order->status == 'Pedido Entregue')
                                            text-success
                                            @elseif($order->status == 'Cancelado')
                                            text-danger
                                            @else
                                            text-warning
                                            @endif
                                            " style="margin-top: -15px;">
                                                    {{ $order->status }}
                                                </p>

                                            </div>

                                            
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            @foreach($items as $item)

                                            @if($item->order_id == $order->id)
                                                        <div class="col-12 tray-item">
                                                            <div class="img-product">
                                                                <img class="product-img" src="{{ asset('assets/img/cardapio/burguers/burger-au-poivre-kit-4-pack.3ca0e39b02db753304cd185638dad518.jpg') }}" />
                                                            </div>

                                                            <div class="product-data">
                                                                <p class="resume-product-title">
                                                                    <b>{{ $item->product }}</b>
                                                                </p>
                                                            </div>

                                                            <p class="resume-product-quantity">
                                                                x <b>{{ $item->ammount }}</b>
                                                            </p>
                                                        </div>
                                                        @endif
                                            @endforeach
                                        </div>

                                        <hr>

                                        <div class="col-12">
                                            <p class="text-black font-weight-bold">{{$order->userAdress}}</p>
                                            <p class="text-black font-weight-bold" style="margin-top: -15px;">
                                                @if($order->paymentMode == 'Dinheiro')
                                                    Pagamento em dinheiro, troco para R$ {{ $order->change}}
                                                @else
                                                    {{ $order->paymentMode}}
                                                @endif
                                            </p>
                                            <p class="font-weight-bold text-success" style="margin-top: -15px;">
                                                @if($order->status == 'Pedido Entregue' || $order->status == 'Em rota de entrega')
                                                Entregue por: {{ $order->delivery_man}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Imprimir</button>
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



