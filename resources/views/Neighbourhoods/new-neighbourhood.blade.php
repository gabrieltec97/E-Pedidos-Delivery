@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Cadastrar bairro
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="row">
            <form action="{{ route('bairros.store') }}" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h3 class="mb-0">Novo bairro</h3>
                                <button class="btn btn-primary btn-sm ms-auto">Cadastrar</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-sm">Cadastre um novo bairro atendido para entregas</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <input class="form-control" type="text" placeholder="Nome do bairro" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Taxa de entrega</label>
                                        <input class="form-control" type="number" placeholder="Valor da entrega" name="taxe" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tempo médio de entrega</label>
                                        <select class="form-control" name="time">
                                            <option selected disabled>Selecione</option>
                                            <option value="20min a 40min">20min a 40min</option>
                                            <option value="40min a 60min">40min a 60min</option>
                                            <option value="1hora a 1h e 20min">1hora a 1h e 20min</option>
                                            <option value="1h e 20min a 1h e 40min">1h e 20min a 1h e 40min</option>
                                            <option value="1h e 40min a 2h">1h e 40min a 2h</option>
                                            <option value="Acima de 2 horas">Acima de 2 horas</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" checked>
                                        <label for="available">Atendendo agora</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
