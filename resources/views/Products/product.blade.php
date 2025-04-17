@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Cadastrar produto
@endsection

<style>
    .product-image{
        width: 200px;
        border-radius: 30px;
        margin-bottom: 15px;
    }
</style>

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="row">
            <form action="{{ route('produtos.update', $product->id),  }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h3 class="mb-3">{{ $product->name }}</h3>
                                <button class="btn btn-primary btn-sm ms-auto save">
                                    <div class="spinner-border spinner-border-sm loading" role="status" style="display: none;"></div>
                                    Salvar alterações</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <img src="{{ asset('products/' . $product->picture) }}" class="product-image" alt="Imagem">
                            </div>
                            <p class="text-sm">Edite os dados cadastrais deste produto</p>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <input class="form-control" type="text" placeholder="Nome do produto" name="name" value="{{ $product->name }}" required>
                                        @error('name')
                                        <span class="text-danger" style="font-size: 13.5px;"><b><i class="fa-solid fa-circle-info"></i> {{ $message }}</b></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tipo de produto</label>
                                        <select class="form-control" name="type">
                                            <option selected disabled>Selecione</option>
                                            <option value="Comida" @selected($product->type == "Comida")>Comida</option>
                                            <option value="Bebida" @selected($product->type == "Bebida")>Bebida</option>
                                            <option value="Sobremesa" @selected($product->type == "Sobremesa")>Sobremesa</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Valor</label>
                                        <input class="form-control value" type="text" placeholder="Nome do produto" name="price" value="{{ $product->price }}" required>
                                        @error('price')
                                        <span class="text-danger" style="font-size: 13.5px;"><b><i class="fa-solid fa-circle-info"></i> {{ $message }}</b></span>
                                        @enderror
                                    </div>
                                </div>

                                @if($product->type != "Comida")
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Estoque</label>
                                            <input class="form-control" type="number" name="stock" value="{{ $product->stock }}" placeholder="Quantidade em estoque">
                                            @error('stock')
                                            <span class="text-danger" style="font-size: 13.5px;"><b><i class="fa-solid fa-circle-info"></i> {{ $message }}</b></span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" @checked($product->is_available)>
                                        <label for="available">Disponível
                                            @if($product->type == "Comida")
                                                para venda
                                            @else
                                                em estoque
                                            @endif
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Alterar imagem do produto:</label>
                                        <input type="file" name="image">
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    @if(count($additionals) != 0)
                                        <hr class="horizontal dark">
                                        <p class="text-md font-weight-bold">Adicionais para este produto</p>
                                        @foreach($additionals as $additional)
                                            @if($additional->type == $product->type)
                                                <input type="checkbox" name="additionals[]" id="additionals{{ $additional->id }}" value="{{ $additional->id }}"
                                                    @php
                                                        $items = explode(',', $product->additionals);
                                                        if (in_array($additional->id, $items)){
                                                           echo 'checked';
                                                        }
                                                    @endphp>
                                                <label for="additionals{{ $additional->id }}" style="margin-right: 30px;">{{ $additional->name }}</label>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Descrição</label>
                                        <textarea name="description" value="{{ old('description') }}" id="" cols="10" rows="5" class="form-control" required>{{ $product->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-danger mb-0 font-weight-bold" type="button" data-bs-toggle="modal" data-bs-target="#deletarItem">Deletar produto</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deletarItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
                    <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <form action="{{ route('produtos.destroy', $product->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                <div class="modal-body">
                    <h5 class="text-black">Tem certeza que deseja deletar o item <span class="text-danger">{{ $product->name }}</span>?</h5>
                </div>
                <div class="modal-footer" style="margin-bottom: -20px;">
                    <button type="button" class="btn btn-primary font-weight-bold" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger delete-item font-weight-bold">Deletar Produto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function(){
            $('.value').mask('000,000,000.00', {reverse: true});

            $(".delete-item").on('click', function (){
                $(this).html('<div class="spinner-border spinner-border-sm loading"></div> Deletar Produto');
            });
        });
    </script>

    @if(session('msg-updated'))
        <script>
            $.toast({
                heading: '<b>Alterações realizadas com sucesso!</b>',
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

    @if ($errors->any())
        <script>
            $.toast({
                heading: '<b>Arquivo incompatível!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : 'red',
                text: 'Formato de imagem não suportado.',
                hideAfter : 5000,
                position: 'top-right',
                textColor: 'white',
                icon: 'warning',
                showHideTransition: 'plain'
            });
        </script>
    @endif

    <script>
        $(".save").on('click',function (){
            $(".loading").fadeIn();
        });
    </script>
@endsection
