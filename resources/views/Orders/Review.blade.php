@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Itens do pedido</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container-fluid mt-lg-3">
                            <div class="row">
                             @foreach($items as $item)
                               <div class="col-md-6">
                                 <div class="form-group">
                                   <label for="example-text-input" class="form-control-label">{{ $item->product }}</label>
                                   <input class="form-control" type="number" name="address" value="{{ $item->ammount }}">
                                 </div>
                               </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
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
                                    <a href="{{ route('review') }}" type="button" class="btn btn-primary" style="margin-bottom: 0px;">Finalizar pedido</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
