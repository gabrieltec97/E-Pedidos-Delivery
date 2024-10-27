@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex">
                        <h4 class="mb-4">Bairros cadastrados</h4>
                        <a href="{{ route('bairros.create') }}" class="btn btn-primary ms-auto font-weight-bold"><i class="fa-solid fa-plus"></i> Novo bairro</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Bairro</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Taxa de entrega</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tempo médio</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Disponibilidade</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($neighbourhoods as $neighbourhood)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm font-weight-bold">{{ $neighbourhood->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $neighbourhood->taxe }}</p>
                                            @if($neighbourhood->taxe == '0')
                                                <p class="text-xs text-success mb-0 font-weight-bold">Entrega gratuita</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $neighbourhood->time }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($neighbourhood->is_available == true)
                                                <span class="badge badge-sm bg-gradient-success" style="cursor: pointer;" title="Entregas disponíveis para este bairro">Disponível</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger" style="cursor: pointer;" title="Bairro não atendido hoje">Indisponível</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('bairros.edit', $neighbourhood->id) }}" class="text-secondary font-weight-bold text-xs"
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
@endsection
