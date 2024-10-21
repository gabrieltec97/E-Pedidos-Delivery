@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Cadastro de adicionais
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-md"><b>Cadastro de novos adicionais</b></h4>
                        <form action="#" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <input class="form-control" type="text" placeholder="Nome do adicional" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="product" class="form-control-label">Produto beneficiado</label>
                                        <select name="product" id="product" class="form-control">
                                            <option disabled selected>Selecione</option>
                                            <option value="Comida">Comida</option>
                                            <option value="Bebida">Bebida</option>
                                            <option value="Sobremesa">Sobremesa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Valor</label>
                                        <input class="form-control" type="text" name="price" placeholder="Ex: 3.99" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" checked>
                                        <label for="available">Disponível no momento</label>
                                    </div>
                                </div>

                                <hr class="horizontal dark">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0"></h3>
                                    <button class="btn btn-primary align-center btn-sm ms-auto">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nome</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($registereds as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $item->benefitedProduct }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm
                                            @if($item->is_available == 1)
                                                bg-gradient-success
                                            @else
                                                bg-gradient-secondary
                                            @endif
                                           ">{{ $item->is_available == 1 ? 'Disponível' : 'Desativado' }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a class="text-secondary font-weight-bold text-xs"
                                               data-bs-toggle="modal" data-bs-target="#additional{{$item->id}}" style="cursor: pointer;">
                                                Detalhes
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="additional{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">{{ $item->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('adicionais.update', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="example-text-input" class="form-control-label">Nome</label>
                                                                    <input class="form-control" type="text" name="name" value="{{$item->name}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="product" class="form-control-label">Produto beneficiado</label>
                                                                    <select name="product" id="product" class="form-control">
                                                                        <option disabled>Selecione</option>
                                                                        <option value="Comida" {{ $item->benefitedProduct == 'Comida' ? 'selected' : '' }}>Comida</option>
                                                                        <option value="Bebida" {{ $item->benefitedProduct == 'Bebida' ? 'selected' : '' }}>Bebida</option>
                                                                        <option value="Sobremesa" {{ $item->benefitedProduct == 'Sobremesa' ? 'selected' : '' }}>Sobremesa</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="example-text-input" class="form-control-label">Valor</label>
                                                                    <input class="form-control" type="text" name="price" value="{{ $item->price }}" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" {{ $item->is_available == 1 ? 'checked' : ''}}>
                                                                    <label for="available">Disponível no momento</label>
                                                                </div>
                                                            </div>

                                                            <hr class="horizontal dark">
                                                            <div class="d-flex align-items-center">
                                                                <h3 class="mb-0"></h3>
                                                                <button class="btn btn-primary align-center btn-sm ms-auto" style="margin-bottom: 0px;">Salvar alterações</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                    <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                                                </div>--}}
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
