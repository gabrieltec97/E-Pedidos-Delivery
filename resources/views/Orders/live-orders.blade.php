@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Authors table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
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
                                @foreach($info as $order)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                         alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $order['client'] }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $order['neighborhood'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-xs font-weight-bold mb-0">#{{ $order['id'] }}</h5>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm
                                            @if($order['status'] == 'Novo Pedido')
                                                bg-gradient-success
                                            @elseif($order['status'] == 'Em Preparação')
                                                bg-gradient-warning
                                            @elseif($order['status'] == 'Saiu para entrega')
                                                bg-gradient-primary
                                            @elseif($order['status'] == 'Cancelado')
                                                bg-gradient-danger
                                            @endif
                                           ">{{ $order['status'] }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $order['date'] }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                               data-bs-toggle="modal" data-bs-target="#pedido{{$order['id']}}">
                                                Detalhes
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="pedido{{$order['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Dados do pedido</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="text-xs text-secondary mb-0">{{ $order['date'] }}</p>
                                                        <p class="text-xs text-secondary mb-0">#{{ $order['id'] }}</p>
                                                        <hr>
                                                        <ul>
                                                            @php
                                                            $items = explode(',', $order['items']);
                                                            @endphp

                                                            @foreach($items as $item)
                                                                <li>{{ $item }}</li>
                                                            @endforeach
                                                        </ul>

                                                        <hr>
                                                        <h5 class="mb-0 text-sm">{{ $order['address'] }}</h5>
                                                        <p class="text-xs text-secondary mb-0">{{ $order['neighborhood'] }}</p>
                                                        <p class="text-xs text-success mb-0">{{ $order['client'] }}</p>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
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
            </div>
        </div>
    </div>
@endsection
