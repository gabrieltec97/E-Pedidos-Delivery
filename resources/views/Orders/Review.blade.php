@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card mb-4">
                    <div class="card-header pb-3">
                        <h6>Itens do pedido</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container-fluid mt-lg-3">
                            <div class="row">
                             @foreach($items as $item)
                               <div class="col-md-12" style="margin-bottom: -18px;">
                                 <div class="form-group">
                                   <label for="example-text-input" class="form-control-label">{{ $item->product }} -
                                       @if($item->ammount > 1)
                                           {{ $item->ammount }} Unidades
                                       @else
                                           {{ $item->ammount }} Unidade
                                       @endif

                                       - <i class="fa-solid fa-trash text-danger" data-bs-toggle="modal" data-bs-target="#deleteitem{{ $item->id }}" style="cursor: pointer; font-size: 12.5px;" title="Excluir do pedido"></i> <i class="fa-solid fa-file-pen text-success" data-bs-toggle="modal" data-bs-target="#edititem{{ $item->id }}" style="cursor: pointer; font-size: 12.5px;" title="Editar"></i>
                                   </label>
                                 </div>
                               </div>

                                    <!-- Modal de deleção de item-->
                                    <div class="modal fade" id="deleteitem{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Exclusão de itens</h5>
                                                    <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Deseja excluir da sua bandeja {{ $item->product }} -
                                                        @if($item->ammount > 1)
                                                            {{ $item->ammount }} Unidades?
                                                        @else
                                                            {{ $item->ammount }} Unidade?
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('cardapio.destroy',  $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mb-0">Deletar</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Modal de edição de item-->
                                    <div class="modal fade" id="edititem{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edição de itens</h5>
                                                    <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <form action="{{ route('cardapio.update',  $item->id) }}" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="example-text-input" class="form-control-label">{{ $item->product }}</label>
                                                                    <input class="form-control" type="number" name="ammount" value="{{ $item->ammount }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="submit" class="btn btn-primary mb-0">Salvar alterações</button>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach


                                 @if($taxe != 0)
                                     @if($type != 'Frete grátis')
                                         <p style="margin-bottom: 0px;">Taxa de entrega: R$ {{ $taxe }}</p>
                                     @endif
                                     <p style="margin-bottom: 0px;">Total do pedido: R$ {{ $total}}</p>
                                     @if($coupon)
                                         <p class="text-success">{{ $coupon }} - <a href="{{ route('remover-cupom') }}" style="font-size: 15px; text-decoration: none; color: grey;">Remover cupom</a></p>
                                     @endif

                                 @else
                                     <p class="text-success mb-0">Frete grátis</p>
                                     <p style="margin-bottom: 0px;">Total do pedido: R$ {{ $total }}</p>
                                     @if($coupon)
                                         <p class="text-success">{{ $coupon }} - <a href="{{ route('remover-cupom') }}" style="font-size: 15px; text-decoration: none; color: grey;">Remover cupom</a></p>
                                     @endif
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header pb-3">
                        <h6>Insira seu cupom</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container-fluid mt-lg-3">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('aplicar-cupom') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Cupom</label>
                                            <input class="form-control" type="text" style="text-transform: uppercase;" oninput="this.value = this.value.replace(/\s+/g, '');"  name="coupon"
                                            @if($coupon)
                                                value="{{ $coupon }}"
                                                readonly
                                            @endif
                                            >
                                        </div>

                                        <div class="col-12 d-flex justify-content-end mb-0">
                                            <button type="submit" class="btn btn-success
                                            @if($coupon)
                                                d-none
                                            @endif
                                            " style="margin-bottom: 0px;">Aplicar cupom</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header pb-3">
                        <h6>Dados de entrega</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container-fluid mt-lg-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Endereço</label>
                                        <input class="form-control" type="text" name="address" value="{{ $user->address }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Bairro</label>
                                        <select class="form-control" name="type">
                                            @foreach($neighborhoods as $neighborhood)
                                                <option value="{{ $neighborhood->name }}" @selected($neighborhood->name ==  $user->$neighborhood )>{{ $neighborhood->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <input class="form-control" type="text" name="name" value="{{ $user->firstname }} {{ $user->lastname }}" readonly style="cursor: not-allowed">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Contato</label>
                                        <input class="form-control" type="text" name="name" value="(21) 99798-8577">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Telefone adicional</label>
                                        <input class="form-control" type="text" name="name" value="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Ponto de referência:</label>
                                        <textarea name="ponto-referencia" class="form-control" id="" cols="10" rows="5" style="resize: none;"></textarea>
                                    </div>

                                <div class="col-12 text-end">
                                    <form action="{{ route('pedidos.store') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mb-0">Confirmar pedido</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('ammount-error'))
        <script>
            $.toast({
                heading: '<b>Oopsss, algo errado aconteceu!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : 'red',
                text: '<b>{{ session('ammount-error') }}</b>', // A mensagem que foi passada via session
                hideAfter : 12000,
                position: 'top-right',
                textColor: 'white',
                icon: 'error'
            });
        </script>
    @endif

    @if(session('msg-coupon-notApplyed'))
        <script>
            $.toast({
                heading: '<b>Oopsss, algo errado aconteceu!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : 'red',
                text: '<b>{{ session('msg-coupon-notApplyed') }}</b>', // A mensagem que foi passada via session
                hideAfter : 12000,
                position: 'top-right',
                textColor: 'white',
                icon: 'error'
            });
        </script>
    @endif

    @if(session('msg-coupon-applyed'))
        <script>
            $.toast({
                heading: '<b>Cupom aplicado com sucesso!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : '#2ecc71',
                hideAfter : 5000,
                position: 'top-right',
                textColor: 'white',
                icon: 'success'
            });
        </script>
    @endif

    @if(session('msg-coupon-removed'))
        <script>
            $.toast({
                heading: '<b>Cupom removido com sucesso!</b>',
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
