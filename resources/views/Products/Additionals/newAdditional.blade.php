@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Gerenciamento de Adicionais')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex">
                        <h4>Adicionais cadastrados</h4>

                        <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalAlert"><i class="fa-solid fa-plus"></i> Novo Adicional</button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nome</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Valor</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aplicação</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach($registereds as $registered)
                                            <tr>
                                            <td class="align-middle text-center text-sm">
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm font-weight-bold"  style="color: black; text-decoration: none;">{{ $registered->name }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $registered->price }}</td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm font-weight-bold"  style="color: black; text-decoration: none;">{{ $registered->type }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($registered->is_available == true)
                                                    <span class="badge badge-sm bg-gradient-success" style="cursor: pointer;" title="Entregas disponíveis para este bairro">Disponível</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger" style="cursor: pointer;" title="Bairro não atendido hoje">Indisponível</span>
                                                @endif
                                            </td>

                                            <td>
                                                <p data-bs-toggle="modal" style="margin-bottom: 0px; cursor: pointer; color: #515050;" data-bs-target="#modalItem{{$registered->id}}">Detalhes</p>
                                            </td>
                                            </tr>

                                            <!-- Modal de edição-->
                                            <div class="modal fade" id="modalItem{{$registered->id}}" tabindex="-1" role="dialog" aria-labelledby="modalCadastro" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{ route('adicionais.update', $registered->id )}}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar adicional</h5>
                                                                <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                    <div class="row">
                                                                        <p class="text-sm">Edite um item adicional já cadastrado para incrementar os itens do seu cardápio.</p>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input" class="form-control-label">Nome</label>
                                                                                    <label class="form-control-label nameHd{{$registered->id}}" hidden>{{ $registered->name }}</label>
                                                                                    <input class="form-control name{{$registered->id}} alter{{$registered->id}}" type="text" value="{{ $registered->name }}" name="name" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input" class="form-control-label">Valor</label>
                                                                                    <label class="form-control-label valueHd{{$registered->id}}" hidden>{{ $registered->price }}</label>
                                                                                    <input class="form-control value{{$registered->id}} alter{{$registered->id}}" type="text" name="price" value="{{ $registered->price }}" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input" class="form-control-label">Aplicação em</label>
                                                                                    <label class="form-control-label typeHd{{ $registered->id }}" hidden>{{ $registered->type }}</label>
                                                                                    <select class="form-control type{{ $registered->id }}" name="type">
                                                                                        <option value="Comida" <?= ($registered->type == "Comida") ? 'selected' : '' ?>>Comida</option>
                                                                                        <option value="Bebida" <?= ($registered->type == "Bebida") ? 'selected' : '' ?>>Bebida</option>
                                                                                        <option value="Sobremesa" <?= ($registered->type == "Sobremesa") ? 'selected' : '' ?>>Sobremesa</option>
                                                                                    </select>

                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" name="is_available" id="available{{ $registered->id }}" style="margin-top: 45px;" <?= ($registered->is_available == true) ? 'checked' : '' ?>>
                                                                                    <label for="available">Disponível para uso.</label>
                                                                                    <label class="available{{ $registered->id }}" hidden>{{ $registered->is_available }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $registered->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Exclusão de item.</h5>
                                                            <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tem certeza que deseja excluir o item <b>{{ $registered->name }}</b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('adicionais.destroy', $registered->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> Deletar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function(){
                                                    $('.value{{$registered->id}}').mask('000,000,000.00', {reverse: true});
                                                });
                                            </script>

                                            <script>
                                                $(".alter{{$registered->id}}").on('keyup', function (){
                                                    if ($(".name{{$registered->id}}").val() != $(".nameHd{{$registered->id}}").text() ||
                                                        $(".value{{$registered->id}}").val() != $(".valueHd{{$registered->id}}").text() ){
                                                        $(".save").fadeIn(1000);
                                                    }else{
                                                        $(".save").fadeOut();
                                                    }
                                                })

                                                $(".type{{$registered->id}}").on('change', function (){
                                                    if ($(".type{{$registered->id}}").val() != $(".typeHd{{$registered->id}}").text()){
                                                        $(".save").fadeIn(1000);
                                                    }else{
                                                        $(".save").fadeOut();
                                                    }
                                                });

                                                $("#available{{ $registered->id }}").on('click', function (){
                                                    let status = $(".available{{ $registered->id }}").text();
                                                    if ($("#available{{ $registered->id }}").prop("checked") && status != 1) {
                                                        $(".save").fadeIn(1000);
                                                    } else if($("#available{{ $registered->id }}").prop("checked") == false && status != 0){
                                                        $(".save").fadeIn(1000);
                                                    }else{
                                                        $(".save").fadeOut();
                                                    }
                                                });

                                                $(".save").on('click',function (){
                                                    $(".loading").fadeIn();
                                                });

                                            </script>
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

    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastro" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="#" method="post">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar adicional</h5>
                    <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <div class="row">
                                <p class="text-sm">Cadastre um novo adicional para incrementar os itens do seu cardápio.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nome</label>
                                            <input class="form-control" type="text" placeholder="Nome do adicional" name="name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Valor</label>
                                            <input class="form-control value" type="text" name="price" placeholder="Valor do adicional.">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Aplicação em</label>
                                            <select class="form-control" name="type">
                                                <option selected disabled>Selecione</option>
                                                <option value="Comida">Comida</option>
                                                <option value="Bebida">Bebida</option>
                                                <option value="Sobremesa">Sobremesa</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Checkboxes para opções -->
                                    <div class="col-md-6 mt-3" id="checkbox-container">
                                        <!-- As opções aparecerão dinamicamente aqui -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" checked>
                                            <label for="available">Disponível para uso.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            </form>
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
                        Pelo fato deste sistema estar aberto <span class="text-primary font-weight-bold">ao público</span> para que todos o conheçam, todas as opções de cadastro foram
                        desabilitadas para que pudesse ser evitada uma exclusão ou cadastro <span class="text-danger font-weight-bold">indevido</span>,
                        garantindo assim um perfeito funcionamento do sistema.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary font-weight-bold" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    @if(session('msg'))
        <script>
            $.toast({
                heading: '<b>Exclusão concluída!</b>',
                showHideTransition: 'slide',  // It can be plain, fade or slide
                bgColor: '#2ecc71',
                text: 'Adicional excluído com sucesso!',
                hideAfter: 8000,
                position: 'top-right',
                textColor: '#ecf0f1',
                icon: 'success'
            });
        </script>
    @endif

    @if(session('msg-ok'))
        <script>
            $.toast({
                heading: '<b>Cadastro concluído!</b>',
                showHideTransition: 'slide',  // It can be plain, fade or slide
                bgColor: '#2ecc71',
                text: 'Adicional cadastrado com sucesso!',
                hideAfter: 8000,
                position: 'top-right',
                textColor: '#ecf0f1',
                icon: 'success'
            });
        </script>
    @endif

    @if(session('msg-upd'))
        <script>
            $.toast({
                heading: '<b>Alterações realizadas!</b>',
                showHideTransition: 'slide',  // It can be plain, fade or slide
                bgColor: '#2ecc71',
                text: 'Alterações realizadas com sucesso!',
                hideAfter: 8000,
                position: 'top-right',
                textColor: '#ecf0f1',
                icon: 'success'
            });
        </script>
    @endif

    <script>
        $(document).ready(function(){
            $('.value').mask('000,000,000.00', {reverse: true});
        });
    </script>
@endsection
