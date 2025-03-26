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
{{--                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">--}}
{{--                                        Itens</th>--}}
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
                                         $dados[] = [
                                             'id' => $coupom->id,
                                             'name' => $coupom->name,
                                             'discount' => $coupom->discount,
                                             'limit' => $coupom->limit,
                                             'role' => $coupom->role,
                                             'type' => $coupom->type,
                                             'status' => $coupom->status
                                               ];
                                         $jsonData = json_encode($dados);
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm font-weight-bold text-success">{{ $coupom->name }}</h6>
                                                    <input class="couponId" disabled hidden value="{{ $coupom->id }}">
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
{{--                                        <td class="align-middle text-center text-sm">--}}
{{--                                            <p class="text-xs font-weight-bold mb-0">{{ $coupom->products }}</p>--}}
{{--                                        </td>--}}
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
                                            <a style="text-decoration: none; cursor: pointer;" class="text-secondary font-weight-bold text-xs edit{{$coupom->id}}"
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
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                                                        <input class="form-control name{{$coupom->id}} alter{{$coupom->id}}" autocomplete="off" value="{{ $coupom->name }}" type="text" style="text-transform: uppercase;" oninput="this.value = this.value.replace(/\s+/g, '');" name="name" required>
                                                                        <span class="text-danger checkCoupon{{$coupom->id}}" style="display: none;">
                                                                            Já existe um cupom com o nome <b><span class="notName{{$coupom->id}}"></span>.</b> Por favor, escolha outro nome.
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Aplicação</label>
                                                                        <select class="form-control aplication{{$coupom->id}} select{{$coupom->id}}" name="aplication">
                                                                            <option selected disabled>Selecione</option>
                                                                            <option value="Frete grátis"  @selected($coupom->type == "Frete grátis")>Frete grátis</option>
                                                                            <option value="Porcentagem"  @selected($coupom->type == "Porcentagem")>Porcentagem</option>
                                                                            <option value="Dinheiro"  @selected($coupom->type == "Dinheiro")>Dinheiro</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-discount{{$coupom->id}}">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Desconto</label>
                                                                        <input class="form-control discount{{$coupom->id}} alter{{$coupom->id}}" type="number" placeholder="Total do desconto" name="discount" value="{{ $coupom->discount }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Limite de uso</label>
                                                                        <input class="form-control alter{{$coupom->id}} limit{{$coupom->id}}" type="number" placeholder="Quantidade de pedidos" value="{{ $coupom->limit }}" name="limit" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input" class="form-control-label">Pedidos acima de:</label>
                                                                        <input class="form-control disccountValue alter{{$coupom->id}} up{{$coupom->id}}" type="text" value="{{ $coupom->role }}" name="role" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" class="is_available" name="is_available" id="available" @checked($coupom->status)>
                                                                        <label for="available">Disponível para uso</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6"></div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletemodal{{ $coupom->id }}">
                                                        Deletar cupom
                                                    </button>
                                                    <button type="submit" class="btn btn-primary save" style="display: none;">
                                                        <div class="spinner-border spinner-border-sm loading" role="status" style="display: none;"></div>
                                                        Salvar alterações
                                                    </button>
                                                </div>

                                                <script>
                                                    var data = <?php echo $jsonData; ?>;
                                                    $(".edit{{$coupom->id}}").on('click', function(){
                                                        data.forEach((item) => {
                                                            if({{$coupom->id}} == item.id){
                                                                $(".alter{{$coupom->id}}").on('keyup', function (){
                                                                    if ($(".name{{$coupom->id}}").val().toUpperCase() != item.name
                                                                    || $(".discount{{$coupom->id}}").val() != item.discount
                                                                    || $(".limit{{$coupom->id}}").val() != item.limit
                                                                    || $(".up{{$coupom->id}}").val() != item.role){
                                                                       $(".save").fadeIn();
                                                                    }else{
                                                                        $(".save").fadeOut();
                                                                    }
                                                                });

                                                                $(".select{{$coupom->id}}").on('change', function (){
                                                                    if($(".aplication{{$coupom->id}}").val() != item.type){
                                                                        $(".save").fadeIn();
                                                                    }else{
                                                                        $(".save").fadeOut();
                                                                    }
                                                                });

                                                                $(".is_available").on('click', function (){
                                                                    let isChecked = $(this).prop('checked');

                                                                    if (isChecked == true && item.status == 0 || isChecked == false && item.status == 1){
                                                                        $(".save").fadeIn();
                                                                    }else{
                                                                        $(".save").fadeOut();
                                                                    }
                                                                });

                                                                $(".aplication{{$coupom->id}}").on('change', function (){
                                                                    if($(this).val() == 'Frete grátis'){
                                                                        $(".col-discount{{$coupom->id}}").fadeOut();
                                                                    }else{
                                                                        $(".col-discount{{$coupom->id}}").fadeIn();
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    });

                                                    $(".save").on('click',function (){
                                                        $(".loading").fadeIn();
                                                    });

                                                    //retirando o campo de desconto caso o valor venha como frete gratis
                                                    if("{{$coupom->type}}" == "Frete grátis"){
                                                        $(".col-discount{{$coupom->id}}").hide();
                                                    }

                                                    $(".name{{$coupom->id}}").on('keyup',function(){
                                                        let nome = $(this).val().toUpperCase().replace(/\s/g, '');
                                                        let id = {{ $coupom->id }};

                                                        $.ajax({
                                                            url: "{{ route('verificarNomeCupom') }}",
                                                            method: "GET",
                                                            data: {name: nome, id: id},
                                                            success: function (response) {
                                                                console.log(response.success)
                                                                if (response.success == false){
                                                                    $(".checkCoupon{{$coupom->id}}").fadeIn();
                                                                    $(".notName{{$coupom->id}}").text(nome);
                                                                    $(".name{{$coupom->id}}").val('');
                                                                    $(".save").prop("disabled", true);
                                                                    $(".loading").attr("style", "display: none !important;");
                                                                }else{
                                                                    $(".checkCoupon{{$coupom->id}}").fadeOut();
                                                                    $(".save").prop("disabled", false);
                                                                    // $(".loading").fadeIn();
                                                                }
                                                            },
                                                            error: function () {
                                                                console.error("Erro ao buscar a contagem dos itens na bandeja.");
                                                            }
                                                        });
                                                    });
                                                </script>

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
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <input class="form-control couponName" type="text" style="text-transform: uppercase;" oninput="this.value = this.value.replace(/\s+/g, '');" name="name" required>
                                        <span class="text-danger checkCoupon" style="display: none;">
                                            Já existe um cupom com o nome <b><span class="notName"></span>.</b> Por favor, escolha outro nome.
                                        </span>
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
                                        <input class="form-control discount" type="number" placeholder="Total do desconto" name="discount">
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
                    <button type="submit" class="btn btn-primary saveCoupon">Cadastrar cupom</button>
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

    @if(session('msg-coupon-updated'))
        <script>
            $.toast({
                heading: '<b>Alterações realizadas com sucesso!</b>',
                showHideTransition: 'slide',  // It can be plain, fade or slide
                bgColor: '#2ecc71',
                hideAfter: 3000,
                position: 'top-right',
                textColor: '#ecf0f1',
                icon: 'success'
            });
        </script>
    @endif

    @if(session('msg-error'))
        <script>
            $.toast({
                heading: '<b>Não foi possível cadastrar este cupom!</b>',
                showHideTransition: 'slide',  // It can be plain, fade or slide
                bgColor: '#ea1818',
                text: '{{ session('msg-error') }}',
                hideAfter: 8000,
                position: 'top-right',
                textColor: '#ecf0f1',
                icon: 'success'
            });
        </script>
    @endif

    @if(session('msg-error-upd'))
        <script>
            $.toast({
                heading: '<b>Não foi possível alterar este cupom!</b>',
                showHideTransition: 'slide',  // It can be plain, fade or slide
                bgColor: '#ea1818',
                text: '{{ session('msg-error-upd') }}',
                hideAfter: 8000,
                position: 'top-right',
                textColor: '#ecf0f1',
                icon: 'success'
            });
        </script>
    @endif

    @if(session('msg-store'))
        <script>
            $.toast({
                heading: '<b>Cupom cadastrado com sucesso!</b>',
                showHideTransition: 'slide',  // It can be plain, fade or slide
                bgColor: '#2ecc71',
                hideAfter: 3000,
                position: 'top-right',
                textColor: '#ecf0f1',
                icon: 'success'
            });
        </script>
    @endif

    @if(session('msg-delete'))
        <script>
            $.toast({
                heading: '<b>Cupom deletado com sucesso!</b>',
                showHideTransition: 'slide',  // It can be plain, fade or slide
                bgColor: '#2D2D2D',
                hideAfter: 3000,
                position: 'top-right',
                textColor: '#ecf0f1',
                icon: 'success'
            });
        </script>
    @endif

    <script>
        $(".couponName").blur(function(){
            let nome = $(this).val().toUpperCase().replace(/\s/g, '');

            $.ajax({
                url: "{{ route('verificarNomeCupom') }}",
                method: "GET",
                data: {name: nome},
                success: function (response) {
                    if (response.success == false){
                        $(".checkCoupon").fadeIn();
                        $(".notName").text(nome);
                        $(".couponName").val('');
                        $(".saveCoupon").prop("disabled", true);
                    }else{
                        $(".checkCoupon").fadeOut();
                        $(".saveCoupon").prop("disabled", false);
                    }
                },
                error: function () {
                    console.error("Erro ao buscar a contagem dos itens na bandeja.");
                }
            });
        });
    </script>

@endsection
