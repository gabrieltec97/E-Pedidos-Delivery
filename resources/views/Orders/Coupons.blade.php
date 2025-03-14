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
                                            <a style="text-decoration: none; cursor: pointer;" class="text-secondary font-weight-bold text-xs"
                                               data-bs-toggle="modal" data-bs-target="#editmodal{{$coupom->id}}">
                                                Editar
                                            </a>
                                            <a style="text-decoration: none; cursor: pointer;" class="text-secondary font-weight-bold text-xs"
                                               data-bs-toggle="modal" data-bs-target="#deletemodal{{$coupom->id}}">
                                                &nbsp;Deletar
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deletemodal{{ $coupom->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
                                                    <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                                                </div>
                                                <div class="modal-body">
                                                    <h6>Tem certeza que deseja excluir o cupom <b>{{ $coupom->name }} ?</b></h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('cupons.destroy', $coupom->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Deletar cupom</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal de edição de cupom-->
                                    <div class="modal fade" id="editmodal{{$coupom->id}}" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edição de cupom</h5>
                                                    <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <form action="{{ route('cupons.update', $coupom->id) }}" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                                                        <input class="form-control" value="{{ $coupom->name }}" type="text" style="text-transform: uppercase;" oninput="this.value = this.value.replace(/\s+/g, '');" name="name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Items</label>
                                                                        <select class="form-control" name="items">
                                                                            <option selected disabled>Selecione</option>
                                                                            <option value="Todos"  @selected($coupom->products == "Todos")>Todos</option>
                                                                            <option value="Comida"  @selected($coupom->products == "Comida")>Comida</option>
                                                                            <option value="Bebida"  @selected($coupom->products == "Bebida")>Bebida</option>
                                                                            <option value="Sobremesa"  @selected($coupom->products == "Sobremesa")>Sobremesa</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Aplicação</label>
                                                                        <select class="form-control" name="aplication">
                                                                            <option selected disabled>Selecione</option>
                                                                            <option value="Frete grátis"  @selected($coupom->type == "Frete grátis")>Frete grátis</option>
                                                                            <option value="Porcentagem"  @selected($coupom->type == "Porcentagem")>Porcentagem</option>
                                                                            <option value="Dinheiro"  @selected($coupom->type == "Dinheiro")>Dinheiro</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Desconto</label>
                                                                        <input class="form-control" type="number" placeholder="Total do desconto" name="discount" value="{{ $coupom->discount }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Limite de uso</label>
                                                                        <input class="form-control" type="number" placeholder="Quantidade de pedidos" value="{{ $coupom->limit }}" name="limit" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Pedidos acima de:</label>
                                                                        <input class="form-control disccountValue" type="text" value="{{ $coupom->role }}" name="role" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" @checked($coupom->status)>
                                                                        <label for="available">Disponível para uso</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6"></div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                                </form>
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

    <!-- Modal de novo cupom-->
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
                                        <select class="form-control application" name="aplication">
                                            <option selected disabled>Selecione</option>
                                            <option value="Frete grátis">Frete grátis</option>
                                            <option value="Porcentagem">Porcentagem</option>
                                            <option value="Dinheiro">Dinheiro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 disccount">
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
                                        <label for="example-text-input" class="form-control-label">Pedidos acima de:</label>
                                        <input class="form-control disccountValue" type="text" placeholder="Insira o valor" name="role" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="checkbox" name="is_available" id="available" checked>
                                        <label for="available">Disponível para uso</label>
                                    </div>
                                </div>
                                <div class="col-lg-6"></div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        $('.disccountValue').mask('000.000.000.000.000.00', {reverse: true});

        $(".application").on('change', function(){
            if ($(this).val() == 'Frete grátis'){
                $(".disccount").fadeOut();
            }else{
                $(".disccount").fadeIn();
            }
        })


    });
    </script>

@endsection
