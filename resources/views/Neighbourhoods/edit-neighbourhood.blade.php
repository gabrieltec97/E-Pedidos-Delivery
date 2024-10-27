@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Editar bairro - {{ $neighbourhood->name }}
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="row">
            <form action="{{ route('bairros.destroy', $neighbourhood->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h3 class="mb-4">{{ $neighbourhood->name }}</h3>
                                    <button type="submit" class="btn btn-danger btn-sm ms-auto font-weight-bold">Deletar bairro</button>
                            </div>
                        </div>
            </form>
                        <form action="{{ route('bairros.update', $neighbourhood->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                        <div class="card-body">
                            <p class="text-sm">Edite este bairro anteriormente cadastrado</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <input class="form-control" type="text" name="name" value="{{ $neighbourhood->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Taxa de entrega</label>
                                        <input class="form-control" type="number" name="taxe" value="{{ $neighbourhood->taxe }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tempo médio de entrega</label>
                                        <select class="form-control" name="time">
                                            <option selected disabled>Selecione</option>
                                            <option value="20min a 40min" @selected($neighbourhood->time == "20min a 40min")>20min a 40min</option>
                                            <option value="40min a 60min" @selected($neighbourhood->time == "40min a 60min")>40min a 60min</option>
                                            <option value="1hora a 1h e 20min" @selected($neighbourhood->time == "1hora a 1h e 20min")>1hora a 1h e 20min</option>
                                            <option value="1h e 20min a 1h e 40min" @selected($neighbourhood->time == "1h e 20min a 1h e 40min")>1h e 20min a 1h e 40min</option>
                                            <option value="1h e 40min a 2h" @selected($neighbourhood->time == "1h e 40min a 2h")>1h e 40min a 2h</option>
                                            <option value="Acima de 2 horas" @selected($neighbourhood->time == "Acima de 2 horas")>Acima de 2 horas</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" @checked($neighbourhood->is_available)>
                                        <label for="available">Atendendo agora</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-4 d-flex" style="margin-bottom: -20px;">
                                    <button class="btn btn-success btn-sm ms-auto font-weight-bold">Salvar alterações</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
