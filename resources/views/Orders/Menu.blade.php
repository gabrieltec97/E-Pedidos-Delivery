@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Escolha nossos itens</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container-fluid mt-lg-3">
                           <div class="row">
                               @foreach($products as $product)
                                       <div class="col-4">
                                           <form action="{{ route('cardapio.store') }}" method="post">
                                               @csrf
                                           <div>
                                               <img src="/img/team-2.jpg" class="avatar avatar-lg"
                                                    alt="user1">

                                               <label for="Name" style="font-size: 20px;">{{ $product->name }}</label><br>
                                               <label for="Name" style="font-size: 15px;">R$ <span class="text-success">{{ $product->price }}</span></label>
                                               <input type="number" class="form-control" name="ammount" style="width: 90px" value="1">
                                               <button type="submit" class="btn btn-success" name="productId" value="{{ $product->id }}"><i class="fa-solid fa-cart-shopping"></i></button>
                                           </div>
                                           </form>
                                       </div>
                               @endforeach

                               <div class="col-12 text-end">
                                   <a href="{{ route('review') }}" type="button" class="btn btn-primary">Finalizar pedido</a>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])--}}

{{--@section('content')--}}
{{--    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])--}}
{{--    <div class="container-fluid py-4">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card mb-4">--}}
{{--                    <div class="card-header pb-0">--}}
{{--                        <h6>Escolha nossos itens</h6>--}}
{{--                    </div>--}}
{{--                    <div class="card-body px-0 pt-0 pb-2">--}}
{{--                        <div class="container-fluid mt-lg-3">--}}
{{--                            <div class="row">--}}
{{--                                @foreach($products as $product)--}}
{{--                                    <div class="col-4">--}}
{{--                                        <form action="{{ route('cardapio.store') }}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            <div>--}}
{{--                                                <img src="/img/team-2.jpg" class="avatar avatar-lg"--}}
{{--                                                     alt="user1">--}}

{{--                                                <label for="Name" style="font-size: 20px;">{{ $product->name }}</label><br>--}}
{{--                                                <label for="Name" style="font-size: 15px;">R$ <span class="text-success">{{ $product->price }}</span></label>--}}
{{--                                                <input type="number" class="form-control" name="ammount" style="width: 90px" value="1">--}}
{{--                                                <a href="javascript:;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" value="{{ $product->id }}"><i class="fa-solid fa-cart-shopping"></i></a>--}}
{{--                                            </div>--}}

{{--                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                                                <div class="modal-dialog">--}}
{{--                                                    <div class="modal-content">--}}
{{--                                                        <div class="modal-header">--}}
{{--                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Dados do pedido</h1>--}}
{{--                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="modal-body">--}}
{{--                                                            <div class="container">--}}
{{--                                                                <div class="row">--}}
{{--                                                                    <div class="col-12">--}}
{{--                                                                        <label for="Name" style="font-size: 20px;">{{ $product->name }}</label><br>--}}
{{--                                                                        <label for="Name" style="font-size: 15px;">R$ <span class="text-success">{{ $product->price }}</span></label>--}}
{{--                                                                        <input type="number" class="form-control" name="ammount" style="width: 90px" value="1">--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="modal-footer">--}}
{{--                                                            <button type="submit" class="btn btn-primary">Adicionar à bandeja</button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}

{{--                                    <!-- Modal -->--}}

{{--                                @endforeach--}}

{{--                                <div class="col-12 text-end">--}}
{{--                                    <form action="{{ route('pedidos.store') }}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="btn btn-primary">Finalizar pedido</button>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}



