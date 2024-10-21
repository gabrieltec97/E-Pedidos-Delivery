@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Itens Cadastrados</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Item</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tipo</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Qt. Estoque</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Estoque</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        @php
                                            $stockPercent = number_format(($product->stock * 100 ) / 50);
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                             alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <a class="mb-0 text-sm" href="{{ route('produtos.edit', $product->id) }}">{{ $product->name }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $product->type }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if($product->is_available == 1)
                                                    <span class="badge badge-sm bg-gradient-success">Disponível</span>
                                                @elseif($product->is_available == null && $product->stock >=1)
                                                    <span class="badge badge-sm bg-gradient-secondary">Desativado</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger">Indisponível</span>
                                                @endif
                                            </td>
                                            @if($product->type != 'Comida')
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0" style="margin-left: 25px;">
                                                    @if($product->stock > 1)
                                                        {{ $product->stock }} unidades
                                                    @elseif($product->stock == 1)
                                                        1 unidade
                                                    @else
                                                        0 unidade
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center"
                                                     @if($stockPercent <=30)
                                                         title="Item com baixa quantidade em estoque podendo ficar indisponível no cardápio. Verifique o estoque imediatamente!".
                                                        style="cursor: pointer";
                                                     @endif
                                                >
                                                    <span class="me-2 text-xs font-weight-bold">
                                                        {{ $stockPercent }}%
                                                    </span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar
                                                            @if($stockPercent > 70)
                                                            bg-gradient-success
                                                            @elseif($stockPercent > 30 && $stockPercent < 70)
                                                            bg-gradient-info
                                                            @else
                                                            bg-gradient-danger
                                                            @endif

                                                            " role="progressbar"
                                                                 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                                 style="width: {{ $stockPercent }}%;"></div>
                                                        </div>
                                                    </div>

                                                    @if($stockPercent <= 30)
                                                        <i class="fa-solid fa-triangle-exclamation" style="margin-left: 15px; color: #ecec0f;"></i>
                                                    @endif
                                                </div>
                                            </td>
                                            @endif
                                            <td class="align-right ml-5 text-right text-sm">
                                                <form action="{{ route('produtos.edit', $product->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button title="Editar" type="submit" style="cursor: pointer; border: none;" class="badge badge-sm bg-gradient-success"><i class="fa-solid fa-pen-to-square"></i></button>
                                                </form>


                                                <form action="{{ route('produtos.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Deletar" style="cursor: pointer; border: none;" class="badge badge-sm bg-gradient-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
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
