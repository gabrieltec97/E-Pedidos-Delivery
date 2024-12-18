@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex">
                        <h4>Itens Cadastrados</h4>

                        <a href="{{ route('produtos.create') }}" class="btn btn-primary ms-auto"><i class="fa-solid fa-plus"></i> Novo produto</a>
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
                                        Estoque</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Disponibilidade</th>
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
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <a class="mb-0 text-sm font-weight-bold" href="{{ route('produtos.edit', $product->id) }}" style="color: black; text-decoration: none;">{{ $product->name }}</a>
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
                                                <p class="text-xs font-weight-bold mb-0 d-flex justify-content-center" style="margin-left: 25px;">
                                                    @if($product->stock > 1)
                                                        {{ $product->stock }} unidades
                                                    @elseif($product->stock == 1)
                                                        1 unidade
                                                    @else
                                                        0 unidade
                                                    @endif
                                                </p>
                                            @else
                                                <td>
                                                    <p class="text-xs font-weight-bold d-flex justify-content-center">
                                                        Não se aplica
                                                    </p>
                                                </td>
                                            @endif

                                                @if($product->type != 'Comida')
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
                                            @else
                                                <td>
                                                    <p class="text-xs font-weight-bold d-flex justify-content-center">
                                                        @if($product->is_available == true)
                                                            <i class="fa-solid fa-circle-check" style="font-size: 22px; color: #0cca8a"></i>
                                                        @else
                                                            <i class="fa-solid fa-circle-xmark" style="font-size: 22px; color: #f10707"></i>
                                                        @endif
                                                    </p>
                                                </td>
                                            @endif
                                            <td class="align-right ml-5 text-right text-sm">
                                                <a href="{{ route('produtos.edit', $product->id) }}" class="text-secondary font-weight-bold text-xs d-flex justify-content-center"
                                                   data-toggle="tooltip" data-original-title="Edit user">
                                                    Editar
                                                </a>
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


    @if(session('msg'))
        <script>
            $.toast({
                heading: '<b>Item cadastrado com sucesso!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : '#2ecc71',
                text: '<b>{{ session('msg') }}</b>',
                hideAfter : 10000,
                position: 'top-right',
                textColor: 'white',
                icon: 'success'
            });
        </script>
    @endif

    @if(session('msg-removed'))
        <script>
            $.toast({
                heading: '<b>Item removido com sucesso!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : '#2D2D2D',
                hideAfter : 5000,
                position: 'top-right',
                textColor: 'white',
                icon: 'warning',
                showHideTransition: 'plain'
            });
        </script>
    @endif
@endsection
