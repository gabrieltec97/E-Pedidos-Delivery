@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Cupons')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex">
                        <h4>Cupons Cadastrados</h4>

                        <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalCadastro"><i class="fa-solid fa-plus"></i> Novo cupom</button>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nome</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Desconto</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Itens</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Uso</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupons as $coupom)
                                    @php
                                        $percent = round(($coupom->used / $coupom->limit) * 100, 0);
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm font-weight-bold text-success">{{ $coupom->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($coupom->type == "Porcentagem")
                                                <p class="text-xs font-weight-bold mb-0">{{ $coupom->discount }}% de desconto</p>
                                            @elseif($coupom->type == "Dinheiro")
                                                <p class="text-xs font-weight-bold mb-0">{{ $coupom->discount }}reais de desconto</p>
                                            @else
                                                <p class="text-xs font-weight-bold mb-0">Frete grátis</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $coupom->products }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">({{ $coupom->used }}/{{ $coupom->limit }}) {{ $percent }}%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar

                                                        @if($percent <= 30)
                                                        bg-gradient-success
                                                        @elseif($percent > 30 && $percent <= 60)
                                                        bg-gradient-info
                                                        @elseif($percent > 60 && $percent <= 90)
                                                        bg-gradient-warning
                                                        @else
                                                        bg-gradient-danger
                                                        @endif

                                                        " role="progressbar"
                                                             aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"
                                                             style="width: {{ $percent }}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($coupom->status == true)
                                                <span class="badge badge-sm bg-gradient-success">Disponível</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">Indisponível</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                               data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
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

    <!-- Modal -->
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastro" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar cupom</h5>
                    <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('cupons.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <input class="form-control" type="text" style="text-transform: uppercase;" oninput="this.value = this.value.replace(/\s+/g, '');" name="name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Items</label>
                                        <select class="form-control" name="items">
                                            <option selected disabled>Selecione</option>
                                            <option value="Todos">Todos</option>
                                            <option value="Comida">Comida</option>
                                            <option value="Bebida">Bebida</option>
                                            <option value="Sobremesa">Sobremesa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Aplicação</label>
                                        <select class="form-control" name="aplication">
                                            <option selected disabled>Selecione</option>
                                            <option value="Frete grátis">Frete grátis</option>
                                            <option value="Porcentagem">Porcentagem</option>
                                            <option value="Dinheiro">Dinheiro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Desconto</label>
                                        <input class="form-control" type="number" placeholder="Total do desconto" name="discount" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Limite de uso</label>
                                        <input class="form-control" type="number" placeholder="Quantidade de pedidos" name="limit" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" checked>
                                        <label for="available">Disponível para uso</label>
                                    </div>
                                </div>
                                <div class="col-lg-6"></div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
