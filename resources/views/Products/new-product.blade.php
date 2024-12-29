@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Cadastrar produto
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="row">
            <form action="{{ route('produtos.store') }}" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h3 class="mb-0">Novo produto</h3>
                                <button class="btn btn-primary btn-sm ms-auto">Cadastrar</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-sm">Cadastre um novo produto para o cardápio</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <input class="form-control" type="text" placeholder="Nome do produto" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tipo de produto</label>
                                        <select class="form-control" name="type">
                                            <option selected disabled>Selecione</option>
                                            <option value="Comida">Comida</option>
                                            <option value="Bebida">Bebida</option>
                                            <option value="Sobremesa">Sobremesa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Estoque</label>
                                        <input class="form-control" type="number" name="stock" placeholder="Quantidade em estoque">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" checked>
                                        <label for="available">Disponível em estoque</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Valor</label>
                                        <input class="form-control" type="text" name="price" placeholder="Preço deste item">
                                    </div>
                                </div>

                                <hr class="horizontal dark">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Descrição</label>
                                        <textarea name="description" id="" cols="10" rows="5" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
@endsection
