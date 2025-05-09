@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Gerenciamento de Bairros
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex">
                        <h4 class="mb-4">Bairros cadastrados</h4>
                        <button class="btn btn-primary ms-auto font-weight-bold" data-bs-toggle="modal" data-bs-target="#modalAlert"><i class="fa-solid fa-plus"></i> Novo bairro</button>
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
                                            <a href="#" class="text-secondary font-weight-bold text-xs"
                                               data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#modalAlert">
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

    <!-- Modal -->
    <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Funcionalidade desabilitada <i class="fa fa-info-circle text-primary"></i></h5>

                </div>
                <div class="modal-body">
                    <p class="text-black">
                        Pelo fato deste sistema estar aberto <span class="text-primary font-weight-bold">ao público</span> para que todos o
                        conheçam, todas as funções de cadastro foram desabilitadas para que pudesse ser evitada uma exclusão ou
                        cadastro <span class="text-danger font-weight-bold">indevido</span>, garantindo assim um perfeito funcionamento do sistema.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary font-weight-bold" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    @if(session('msg-error'))
        <script>
            $.toast({
                heading: '<b>Não foi possível cadastrar!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : 'red',
                text: '<b>{{ session('msg-error') }}</b>', // A mensagem que foi passada via session
                hideAfter : 12000,
                position: 'top-right',
                textColor: 'white',
                icon: 'error'
            });
        </script>
    @endif

    @if(session('msg'))
        <script>
            $.toast({
                heading: '<b>Bairro cadastrado com sucesso!</b>',
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

    @if(session('msg-neig-removed'))
        <script>
            $.toast({
                heading: 'Remoção concluída!',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : '#2D2D2D',
                text: '{{ session('msg-neig-removed') }}',
                hideAfter : 5000,
                position: 'top-right',
                textColor: 'white',
                icon: 'warning',
                showHideTransition: 'plain'
            });
        </script>
    @endif

    @if(session('msg-updated'))
        <script>
            $.toast({
                heading: '<b>Alterações realizadas!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : '#2ecc71',
                hideAfter : 10000,
                text: '<b>{{ session('msg-updated') }}</b>',
                position: 'top-right',
                textColor: 'white',
                icon: 'success'
            });
        </script>
    @endif
@endsection
