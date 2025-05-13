<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsible.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquerytoast.css') }}">
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/menu-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title>Cardápio - Seja bem vindo!</title>
</head>
<body>
   <div class="container">
       <div class="row">
           <div class="col-6">
               <a class="btn-tray-side">
                   <div class="badge-total-tray cart-count">{{ $totalItems }}</div>
                   <i class="fa fa-shopping-bag"></i>
               </a>
           </div>

           @if($liveOrder != 0)
               <div class="col-6">
                   <a class="btn-live-order" data-toggle="modal" data-target="#modalLive">
                       <div class="badge-total-tray">{{ $liveOrder }}</div>
                       <i class="fa fa-clipboard text-white"></i>
                   </a>
               </div>
           @endif
        </div>
       </div>
   </div>
    <section class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg pl-0 pr-0 col-one">
                <a href="#" class="navbar-brand"></a>
                <img class="img.logo animated flip" src="{{ asset('assets/img/logo.png') }}" width="140px">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar navbar-nav ml-auto mr-auto">
                        <li class="nav-item">
                            <a class="nav-link btn-reserve"><b>Reservas</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-services"><b>Serviços</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-cardapio"><b>Cardápio</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-myOrders" data-toggle="modal" data-target="#exampleModalCenter"><b>Meus Pedidos</b></a>
                        </li>
                    </ul>

                    <a class="btn btn-white btn-icon btn-tray">
                        Minha bandeja <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                    </a>
                </div>
            </nav>
        </div>
    </section>

    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 col-mg-6 col-sm-12 col-one">
                    <div class="d-flex text-banner">
                        <h1 class="animated fadeInLeft"><b>Escolha sua comida <b class="color-primary">favorita!</b></b></h1>
                        <p class="animated fadeInLeft delay-02s">Aproveite nosso cardápio. Escolha o que desejar e receba no conforto do seu lar de forma rápida e segura!</p>
                        <a class="btn btn-yellow mt-4 mr-3 btn-cardapio2 animated fadeInLeft delay-05s">
                            Ver cardápio
                        </a>
                    </div>

                    <a class="btn btn-sm btn-white btn-social mt-4 mr-3">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a class="btn btn-sm btn-white btn-social mt-4 mr-3">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a class="btn btn-sm btn-white btn-social mt-4">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>

                <div class="col-6 no-mobile">
                    <div class="card-banner animated fadeIn delay-03s"></div>
                    <div class="d-flex img-banner animated fadeIn delay-05s">
                        <img src="{{ asset('assets/img/burguer.png') }}">
                    </div>
                    <div class="card card-case animated fadeInRight delay-07s">
                       <b> "Entrega rápida e lanches deliciosos!
                           <br>A comida chegou quente e<br>
                           muito saborosa!"</b>
                        <span class="card-case-name">
                            <b>Joaquim Domingos</b>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="background-services"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-one text-center mb-5 wow fadeIn">
                    <span class="hint-title services"><b>Serviços</b></span>
                    <h1 class="title">
                        <b>Qual é o nosso diferencial?</b>
                    </h1>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-12 col-one mb-5 wow fadeInUp delay-02s">
                    <div class="card-icon text-center">
                        <img src="{{ asset('assets/img/icone-pedido.svg') }}" width="150">
                        <div class="card-text text-center mt-3">
                            <p><b>Fácil de pedir</b></p>
                            <span>
                                Você só precisa de alguns cliques para pedir sua comida!
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-md-4 col-sm-12 col-one mb-5 wow fadeInUp delay-02s">
                    <div class="card-icon text-center">
                        <img src="{{ asset('assets/img/icone-delivery.svg') }}" width="250">
                        <div class="card-text text-center mt-3">
                            <p><b>Entrega rápida</b></p>
                            <span>
                                Nossa entrega é sempre pontual, rápida e segura!
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-md-4 col-sm-12 col-one mb-5 wow fadeInUp delay-02s">
                    <div class="card-icon text-center">
                        <img src="{{ asset('assets/img/icone-qualidade.svg') }}" width="250">
                        <div class="card-text text-center mt-3">
                            <p><b>Melhor qualidade</b></p>
                            <span>
                                Não só a rapidez na entrega, a qualidade também é o nosso forte!
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="menu">
        <div class="background-menu"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-one text-center mb-5 cardapio wow fadeIn">
                    <span class="hint-title"><b>Cardápio</b></span>
                    <h1 class="title">
                        <b>Conheça o nosso cardápio</b>
                    </h1>
                </div>

                <div class="col-12 container-menu col-one">
                    <a class="btn btn-white btn-sm burguersBtn mr-3 active wow fadeInLeft delay-06s">
                        <i class="fas fa-hamburger"></i>&nbsp; Burgers
                    </a>

                    <a class="btn btn-white btn-sm mr-3 drinksBtn wow fadeInUp delay-06s">
                        <i class="fas fa-wine-bottle"></i>&nbsp; Bebidas
                    </a>

                    <a class="btn btn-white btn-sm dessertsBtn mr-3 wow fadeInRight delay-06s">
                        <i class="fas fa-cookie-bite"></i>&nbsp; Sobremesas
                    </a>
                </div>

                <div class="col-12 col-one">
                    <div class="row burguersDiv">
                        @foreach($burguers as $burguer)
                            <div class="col-12 col-lg-3 col-md-3 col-sm-6 mt-4 wow fadeInUp delay-05s">
                                <form class="product-form" data-product-id="{{ $burguer->id }}" action="{{ route('cardapio.store')}}" method="post">
                                    @csrf
                                    <div class="card card-item" data-toggle="modal" data-target=".modalItem{{ $burguer->id }}">
                                        <div class="product-img">
                                            <img src="{{ asset('products/' . $burguer->picture) }}"  class="product-image" alt="Imagem">
                                        </div>
                                        <p class="product-title text-center mt-4">
                                            <b>{{ $burguer->name }}</b>
                                        </p>
                                        <p class="product-price text-center">
                                            <b>R$ {{ $burguer->price }}</b>
                                        </p>
                                        <input type="hidden" name="productId" value="{{ $burguer->id }}">
                                        <input type="number" class="form-control" name="ammount" style="width: 90px" value="1" hidden="">
                                        <div class="add-tray">
{{--                                            <span class="btn-less"><i class="fas fa-minus"></i></span>--}}
{{--                                            <span class="add-number-items">1</span>--}}
{{--                                            <span class="btn-plus"><i class="fas fa-plus"></i></span>--}}
                                            <button type="button" class="btn btn-add w-100 no-mobile" data-toggle="modal" data-target=".modalItem{{ $burguer->id }}"><i class="fas fa-shopping-bag"></i></button>
                                            <input type="number" hidden class="ammount" name="ammount">
                                        </div>
                                    </div>

                                    <!-- Modal de cada item-->
                                    <div class="modal fade modalItem{{ $burguer->id }}" tabindex="-1" role="dialog" aria-labelledby="item" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title product-title" id="exampleModalLongTitle">{{ $burguer->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body modal-item">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-center">
                                                                <img src="{{ asset('products/' . $burguer->picture) }}" class="modal-image" alt="Imagem">
                                                            </div>

                                                            <div class="col-12 col-lg-6 col-md-12 col-sm-12 bg-description">
                                                                <span class="product-title">{{$burguer->description}}</span>
                                                            </div>

                                                            <div class="col-12">
                                                                <hr class="horizontal dark">
                                                                @if(count($additionals) != 0)
                                                                    <p class="text-md font-weight-bold d-flex justify-content-center">Deixe seu lanche ainda mais gostoso:</p>
                                                                    @php
                                                                        $additionalsBg = explode(",", $burguer->additionals);
                                                                    @endphp
                                                                    @foreach($additionals as $additional)
                                                                        @if($additional->type == $burguer->type)
                                                                            @if(in_array($additional->id, $additionalsBg))
                                                                                <input type="checkbox" name="additionals[]" id="additionals{{ $additional->id }}" value="{{ $additional->id }}">
                                                                                <label for="additionals{{ $additional->id }}" style="margin-right: 10px;">{{ $additional->name }}
                                                                                    <span class="text-success">+R$ {{$additional->price}}</span></label>
                                                                                <br>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>

                                                            <div class="col-12">
                                                                <hr class="horizontal dark">
                                                                <textarea class="form-control mt-3" name="comments" id="" cols="30" rows="2" resize="none;" placeholder="Comentário (Se precisar)."></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-add-final float-right add-item{{ $burguer->id }}"
                                                    @if($status == false)
                                                        disabled
                                                    @endif
                                                    ><i class="fas fa-shopping-bag mr-2"></i>Adicionar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <script>
                                $(document).ready(function(){
                                    $(".add-item{{ $burguer->id }}").click(function(){
                                        $(".modalItem{{ $burguer->id }}").modal("hide"); // Fecha o modal ao clicar no botão
                                    });
                                });
                            </script>

                        @endforeach
                    </div>

                    <div class="row drinksDiv" hidden>
                        @foreach($drinks as $drink)
                            <div class="col-12 col-lg-3 col-md-3 col-sm-6 mt-4">
                                <form class="product-form" data-product-id="{{ $drink->id }}" action="{{ route('cardapio.store')}}" method="post">
                                    @csrf
                                    <div class="card card-item" data-toggle="modal" data-target=".drinkItem{{ $drink->id }}">
                                        <div class="product-img">
                                            <img src="{{ asset('products/' . $drink->picture) }}" class="product-image" alt="Imagem">
                                        </div>
                                        <p class="product-title text-center mt-4">
                                            <b>{{ $drink->name }}</b>
                                        </p>
                                        <p class="product-price text-center">
                                            <b>R$ {{ $drink->price }}</b>
                                        </p>
                                        <input type="hidden" name="productId" value="{{ $drink->id }}">
                                        <input type="number" class="form-control" name="ammount" style="width: 90px" value="1" hidden="">
                                        <div class="add-tray">
                                            <button type="button" class="btn btn-add w-100 no-mobile" data-toggle="modal" data-target=".drinkItem{{ $burguer->id }}"><i class="fas fa-shopping-bag"></i></button>
                                            <input type="number" hidden class="ammount" name="ammount">
                                        </div>
                                    </div>

                                    <!-- Modal de cada item-->
                                    <div class="modal fade drinkItem{{ $drink->id }}" tabindex="-1" role="dialog" aria-labelledby="item" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title product-title" id="exampleModalLongTitle">{{ $drink->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body modal-item">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-center">
                                                                <img src="{{ asset('products/' . $drink->picture) }}" class="modal-image" alt="Imagem">
                                                            </div>

                                                            <div class="col-12 col-lg-6 col-md-12 col-sm-12 bg-description">
                                                                <span class="product-title">{{$drink->description}}</span>
                                                            </div>

                                                            <div class="col-12">
                                                                <hr class="horizontal dark">
                                                                @if(count($additionals) != 0)
                                                                    <p class="text-md font-weight-bold d-flex justify-content-center">Deixe sua bebida ainda mais gostosa:</p>
                                                                    @php
                                                                        $additionalsBg = explode(",", $drink->additionals);
                                                                    @endphp
                                                                    @foreach($additionals as $additional)
                                                                        @if($additional->type == $drink->type)
                                                                            @if(in_array($additional->id, $additionalsBg))
                                                                                <input type="checkbox" name="additionals[]" id="additionals{{ $additional->id }}" value="{{ $additional->id }}">
                                                                                <label for="additionals{{ $additional->id }}" style="margin-right: 10px;">{{ $additional->name }}
                                                                                    <span class="text-success">+R$ {{$additional->price}}</span></label>
                                                                                <br>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>

                                                            <div class="col-12">
                                                                <hr class="horizontal dark">
                                                                <textarea class="form-control mt-3" name="comments" id="" cols="30" rows="2" resize="none;" placeholder="Comentário (Se precisar)."></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-add-final float-right add-item{{ $drink->id }}"><i class="fas fa-shopping-bag mr-2"
                                                    @if($status == false)
                                                        disabled
                                                    @endif
                                                    ></i>Adicionar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <script>
                                $(document).ready(function(){
                                    $(".add-item{{ $drink->id }}").click(function(){
                                        $(".drinkItem{{ $drink->id }}").modal("hide"); // Fecha o modal ao clicar no botão
                                    });
                                });
                            </script>
                        @endforeach
                    </div>

                    <div class="row dessertsDiv" hidden>
                        @foreach($desserts as $dessert)
                            <div class="col-12 col-lg-3 col-md-3 col-sm-6 mt-4">
                                <form class="product-form" data-product-id="{{ $dessert->id }}" action="{{ route('cardapio.store')}}" method="post">
                                    @csrf
                                    <div class="card card-item">
                                        <div class="product-img">
                                            <img src="{{ asset('products/' . $dessert->picture) }}" class="product-image" alt="Imagem">
                                        </div>
                                        <p class="product-title text-center mt-4">
                                            <b>{{ $dessert->name }}</b>
                                        </p>
                                        <p class="product-price text-center">
                                            <b>R$ {{ $dessert->price }}</b>
                                        </p>
                                        <input type="hidden" name="productId" value="{{ $dessert->id }}">
                                        <input type="number" class="form-control" name="ammount" style="width: 90px" value="1" hidden="">
                                        <div class="add-tray">
                                            <span class="btn-less"><i class="fas fa-minus"></i></span>
                                            <span class="add-number-items">1</span>
                                            <span class="btn-plus"><i class="fas fa-plus"></i></span>
                                            <button type="submit" class="btn btn-add"><i class="fas fa-shopping-bag"></i></button>
                                            <input type="number" hidden class="ammount" name="ammount">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="reserve">
        <div class="container">
            <div class="row">
                <div class="col-12 col-one">
                    <div class="card-secondary">
                        <div class="row">
                            <div class="col-12 col-lg-7 col-md-7 col-sm-12">
                               <span class="hint-title wow fadeInLeft delay-02s reserves"><b>Reservas</b></span>
                                <h1 class="title wow fadeInLeft delay-02s">
                                <b>Quer reservar um horário?</b>
                                </h1>
                                <p class="pr-5 wow fadeInLeft delay-06s">
                                    Mande uma mensagem clicando no botão abaixo!
                                    <br>
                                    Reserve sua data e horário de forma simples e rápida.
                                </p>

                                <a class="btn btn-yellow mt-4 wow jackInTheBox delay-07s">
                                    <b>Fazer reserva</b>
                                </a>
                            </div>

                            <div class="col-5 no-mobile">
                                <div class="card-reserve wow fadeInRight delay-02s"></div>
                                <div class="d-flex img-banner wow fadeInRight delay-06s">
                                    <img src="{{ asset('assets/img/icone-reserva.svg') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3 col-md-3 col-sm-12 col-one container-logo-footer">
                   <img class="logo-footer wow fadeInLeft delay-04s" src="{{ asset('assets/img/logo.png') }}" />
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12 container-footer-text wow fadeInUp">
                    <p class="mb-0">
                        <b>E-Pedidos Delivery</b> &copy; Todos os direitos reservados.
                    </p>
                </div>
                <div class="col-12 col-lg-3 col-md-3 col-sm-12 container-media-footer">
                   <a class="btn btn-sm btn-white btn-social mr-3 wow fadeInRight">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a class="btn btn-sm btn-white btn-social mr-3 wow fadeInRight">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a class="btn btn-sm btn-white btn-social wow fadeInRight delay-04s">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal-full animated fadeIn" hidden>
        <div class="m-header">
            <div class="container">
                <a class="btn btn-white btn-sm float-right fechar-modal">Fechar</a>

                <div class="steps">
                    <div class="step step1 active">1</div>
                    <div class="step step2">2</div>
                    <div class="step step3">3</div>
                    <div class="step step4">4</div>
                </div>
                <p class="tray-title mt-4">
                    <b id="lbl-stepTitle">Sua bandeja:</b>
                </p>
            </div>
        </div>
        <div class="m-body">
            <div class="container">
                <div id="trayItems" class="row tray-container">

                </div>

                <form id="formAddress" method="post">
                    @csrf
                    <div id="deliveryPlace" class="row" hidden="">

                        <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group container-cep">
                                <label for="txtCEP"><b>Cep:</b></label>
                                <input type="text" id="txtCEP" name="cep" value="{{ $tray[0]->cep ?? '' }}" class="form-control">
                                <a class="btn btn-yellow btn-sm buscar-cep">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="txtNome"><b>Nome:</b></label>
                                <input type="text" id="txtNome" name="name" value="{{ $tray[0]->name ?? '' }}" placeholder="Nome e sobrenome" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="txtContato"><b>Contato:</b></label>
                                <input type="text" id="txtContato" name="contact" value="{{ $tray[0]->contact ?? '' }}" class="form-control" placeholder="Contato com ddd" required>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="txtEndereco"><b>Endereço:</b></label>
                                <input type="text" id="txtEndereco" name="address" value="{{ $tray[0]->address ?? '' }}"  class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="txtBairro"><b>Bairro:</b></label>
                                <input type="text" id="txtBairro" name="neighbourhood" value="{{ $tray[0]->neighbourhood ?? '' }}"  class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-lg-2 col-md-2 col-sm-12">
                            <div class="form-group">
                                <label for="txtNumero"><b>Número:</b></label>
                                <input type="text" id="txtNumero" name="number" value="{{ $tray[0]->number ?? '' }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="txtCity"><b>Cidade:</b></label>
                                <input type="text" id="txtCity" name="city" value="{{ $tray[0]->city ?? '' }}"  class="form-control" required>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="txtComplement"><b>Complemento:</b></label>
                                <input type="text" id="txtComplement" name="complement" value="{{ $tray[0]->complement ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>


                    <div id="paymentStep" hidden>
                        <form id="formPayment" method="post">
                            <div class="row">
                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 valor-entregue mt-sm-0">
                                    <div class="form-group">
                                        <label for="valorPagamento"><b>Precisa de Troco?</b></label>
                                        <input type="text" id="valorPagamento" name="change" placeholder="O valor que você irá entregar" value="{{ $tray[0]->change ?? '' }}"  class="form-control mb-2">
                                        <span class="text-danger alerta-troco"><b>O valor entregue não pode ser menor que o valor total do pedido!</b></span>
                                        <span class="text-success valor-troco"><b></b></span>
                                    </div>
                                </div>
                            @csrf
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="pagamento"><b>Forma de pagamento:</b></label>
                                    <select name="paymentMode" id="pagamento" class="form-control">
                                        <option disabled selected>Selecione</option>
                                        <option value="Dinheiro" @selected(isset($tray[0]) && $tray[0]->paymentMode == 'Dinheiro')>Dinheiro</option>
                                        <option value="Mastercard - crédito" @selected(isset($tray[0]) && $tray[0]->paymentMode == 'Mastercard - crédito')>Mastercard - crédito</option>
                                        <option value="Mastercard - débito" @selected(isset($tray[0]) && $tray[0]->paymentMode == 'Mastercard - débito')>Mastercard - débito</option>
                                        <option value="Elo - crédito" @selected(isset($tray[0]) && $tray[0]->paymentMode == 'Elo - crédito')>Elo - crédito</option>
                                        <option value="Elo - débito" @selected(isset($tray[0]) && $tray[0]->paymentMode == 'Elo - débito')>Elo - débito</option>
                                    </select>

                                </div>
                            </div>
                            </div>
                        </form>

                        <form id="formCoupon" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <label for="coupon"><b>Cupom:</b></label>
                                    <input type="text" id="coupon" name="coupon" value="{{ $tray[0]->coupon_apply ?? '' }}" class="form-control mb-2" {{ isset($tray[0]->coupon_apply) ? 'disabled' : '' }} oninput="this.value = this.value.toUpperCase().replace(/\s+/g, '');" style="{{ isset($tray[0]->coupon_apply) ? 'cursor: not-allowed;' : '' }}">
                                </div>
                        </form>
                        <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-3">
                            <a class="btn btn-yellow mt-5 text-white" style="{{ isset($tray[0]->coupon_apply) ? 'display: none;' : '' }}" id="cadastrarCupom">Aplicar cupom</a>
                            <a class="btn btn-danger mt-5 text-white" id="removerCupom" title="Remover cupom" style="{{ !isset($tray[0]->coupon_apply) ? 'display: none;' : '' }}"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>

                <div id="trayResume" hidden class="row mx-0" >

                    <div class="col-12">
                        <p class="tray-tittle">
                            <b>Itens do pedido:</b>
                        </p>
                    </div>

                    <div class="col-12">
                        <div class="row" id="resumeItemsList">

                        </div>
                    </div>

                    <div class="col-12">
                        <p class="tray-tittle mt-4">
                            <b>Dados da entrega:</b>
                        </p>
                    </div>

                    <div class="col-12 tray-item resume">
                        <div class="img-map">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>

                        <div class="product-data">
                            <p class="address-text">
                                <b id="addressResume">Carregando...</b>
                            </p>
                            <p class="cityAddress" id="cityAddress">Carregando...</p>
                        </div>
                    </div>

                    <div class="col-12 tray-item resumeUser">
                        <div class="img-user">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="product-data">
                            <p class="address-text">
                                <b id="userResume">Carregando...</b>
                            </p>
                            <p class="userData" id="userData">Carregando...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-footer">
            <div class="container">
                <div class="container-total text-right mb-4">
                    <p class="mb-0 mt-4">
                        <span id="lbl-sb">Subtotal: </span>
                        <span id="lbl-subtotal"></span>
                    </p>

                    <p class="mb-0 cupom">
                        <span><i class="fa fa-ticket-alt text-primary"></i> Cupom:</span>
                        <span class="cupomUtilizado"></span>
                    </p>

                    <p class="mb-0 delivery-text text-success">
                        <span id="lbl-time"></span>
                        <br>
                        <span><i class="fas fa-motorcycle"></i> Entrega: </span>
                        <span id="lbl-deliveryValue">+ R$ 5,00</span>


                    </p>

                    <p class="mb-0 total-text">
                        <span><b>Total: </b></span>
                        <span class="totalValue" id="lbl-totalValue" hidden><b></b></span>
                        <span class="totalValue" id="lbl-totalValueFront"><b></b></span>
                    </p>
                </div>

                <a class="btn btn-yellow float-right" id="btnOrderStep">Continuar</a>
                <a class="btn btn-yellow float-right" id="btnAddressStep">Continuar</a>
                <a class="btn btn-yellow float-right" id="btnCheck">Revisar pedido</a>
                <a href="{{ route('novo-pedido') }}" class="btn btn-yellow float-right" id="btnResumeStep">Enviar pedido</a>
                <a class="btn btn-white float-right mr-3" id="btnBack">Voltar</a>
                <a class="btn btn-white float-right mr-3" id="btnSecondBack">Voltar</a>
                <a class="btn btn-white float-right mr-3" id="btnLastBack">Voltar</a>
            </div>
        </div>
    </div>

{{--    <form id="confirmarPedido" action="{{ route('novo-pedido') }}">@csrf</form>--}}
    <script type="text/javascript" src="{{ asset('assets/js/jquery-1.12.4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/modernizr-3.5.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dados.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
   <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('assets/js/jquerytoast.js') }}"></script>
    <script>new WOW().init();</script>


   <div class="modal fade bd-example-modal-lg" id="modalLive" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">

               <div class="modal-header">
                   <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Acompanhe seu pedido!</h5>
                   <button type="button" class="close close-modalLive" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="container-fluid">
                       @if($liveOrder == 1)
                           <div class="row">
                               <div class="col-12">
                                   <div class="steps d-flex justify-content-center">
                                       <div class="step step1{{ $myOrder[0]->id }} active">1</div>
                                       <div class="step step2{{ $myOrder[0]->id }}">2</div>
                                       <div class="step step3{{ $myOrder[0]->id }}">3</div>
                                       <div class="step step4{{ $myOrder[0]->id }}">4</div>
                                   </div>
                               </div>

                               <div class="col-12 col-lg-6 col-md-6 col-sm-12 mt-3">
                                   <div class="table-row">
                                       <i class="fa fa-check-circle first-live{{ $myOrder[0]->id }}" style="color: var(--color-primary) !important;"></i>
                                       <span class="text">Pedido Registrado</span>
                                   </div>

                                   <div class="table-row">
                                       <i class="fa fa-check-circle second-live{{ $myOrder[0]->id }}"></i>
                                       <span class="text">Em preparo</span>
                                   </div>
                                   <div class="table-row">
                                       <i class="fa fa-check-circle third-live{{ $myOrder[0]->id }}"></i>
                                       <span class="text">Em rota de entrega</span>
                                   </div>
                                   <div class="table-row">
                                       <i class="fa fa-check-circle fourth-live{{ $myOrder[0]->id }}"></i>
                                       <span class="text">Pedido Entregue</span>
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <div class="col-12 mt-3">
                                   <div class="product-data">
                                       <h5 class="lbl-details">Veja os detalhes do seu pedido:</h5>
                                   </div>
                               </div>
                               @foreach($items as $item)
                                   @if($myOrder[0]->id == $item->order_id)
                                   <div class="col-12 col-lg-3 col-md-12 col-sm-12 mt-4">
                                    <div class="col-12 order-items">
                                        <div class="img-product">
                                            <img style="width: 50px; height: 50px; border-radius: 10px" src="{{ asset('products/' . $item->product_img) }}" />
                                        </div>
                                        <div>
                                            <p class="resume-product-title">
                                                <b>{{ $item->product }}</b>
                                            </p>

                                            <p class="resume-product-quantity">
                                                x <b>{{ $item->ammount }}</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                               @endforeach

                               @if($myOrder != '')
                                   <div class="col-12 mt-5 live-delivery">
                                       <div class="img-map">
                                           <i class="fas fa-map-marked-alt"></i>
                                       </div>

                                       <div class="live-product-data">
                                           <p class="live-address-text">
                                               <b id="live-addressResume">{{ $myOrder[0]->userAdress }} - {{ $myOrder[0]->user_name }}</b>
                                           </p>
                                           <p class="live-cityAddress" id="live-cityAddress"><b class="text-success">R$: </b> <span class="text-success">{{ $myOrder[0]->value }}</span> - {{ $myOrder[0]->paymentMode }}</p>
                                       </div>
                                   </div>

                                   <div class="col-12 mt-5 order-info d-flex justify-content-center">
                                       <p class="details-order"><i class="fa fa-check-circle mr-2 text-success"></i>Pedido n°{{ $myOrder[0]->id }} - <i class="fa fa-calendar-week text-primary mx-1"></i> {{ $myOrder[0]->created_at }} - <i class="fa fa-clock mx-1 text-warning"></i> {{ $time }}</p>
                                   </div>

                                   <div class="mb-only">
                                       <div class="col-12 mt-5">
                                           <p class="details-order"><i class="fa fa-check-circle mr-2 text-success"></i>Pedido n°{{ $myOrder[0]->id }}</p>
                                       </div>
                                       <div class="col-12 mt-3">
                                           <p><i class="fa fa-calendar-week text-primary mx-1"></i> {{ $myOrder[0]->created_at }}</p>
                                           <p><i class="fa fa-clock mx-1 text-warning"></i> {{ $time }}</p>
                                       </div>
                                   </div>

                                   <div class="col-12 d-flex justify-content-center mt-3 helper">
                                       <span class="help"><span class="text-primary font-weight-bold">Ajuda</span> com o pedido? Fale conosco
                                           <a href="https://wa.me/5521997467377?text=Ol%C3%A1%2C%20gostaria%20de%20falar%20sobre%20meu%20pedido." target="_blank"><i class="fab fa-whatsapp ml-1 text-success i-help"></i></a>
                                           <a href="tel:+5521997467377">
                                                <i class="fa fa-phone-volume text-primary i-phone"></i>
                                           </a>
                                       </span>
                                   </div>
                               @endif
                           </div>
                       @elseif($liveOrder > 1)
                          <div class="row">
                             @foreach($myOrder as $order)
                                  <div class="col-12 mt-3">
                                      <button class="btn btn-warning w-100 text-white font-weight-bold d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#pedido{{$order->id}}" aria-expanded="false" aria-controls="collapseExample">
                                          Pedido #{{$order->id}}
                                          <i class="fas fa-plus"></i>
                                      </button>
                                      <div class="collapse mt-3" id="pedido{{$order->id}}">
                                          <div class="card card-body">
                                              <div class="row">
                                                  <div class="col-12">
                                                      <div class="table-row">
                                                          <i class="fa fa-check-circle first-live{{$order->id}}" style="color: var(--color-primary) !important;"></i>
                                                          <span class="text">Pedido Registrado</span>
                                                      </div>

                                                      <div class="table-row">
                                                          <i class="fa fa-check-circle second-live{{$order->id}}"></i>
                                                          <span class="text">Em preparo</span>
                                                      </div>
                                                      <div class="table-row">
                                                          <i class="fa fa-check-circle third-live{{$order->id}}"></i>
                                                          <span class="text">Em rota de entrega</span>
                                                      </div>
                                                      <div class="table-row">
                                                          <i class="fa fa-check-circle fourth-live{{$order->id}}"></i>
                                                          <span class="text">Pedido Entregue</span>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="mt-5">
                                                  <ul>
                                              @foreach($orderItems as $items)
                                                  @if($items->order_id == $order->id)
                                                        <li>{{ $items->product }}</li>
                                                  @endif
                                              @endforeach
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                             @endforeach

                                 <div class="col-12 mt-5 live-delivery">
                                     <div class="img-map">
                                         <i class="fas fa-map-marked-alt"></i>
                                     </div>

                                     <div class="live-product-data">
                                         <p class="live-address-text">
                                             <b id="live-addressResume">{{ $myOrder[0]->userAdress }} - {{ $myOrder[0]->user_name }}</b>
                                         </p>
                                         <p class="live-cityAddress" id="live-cityAddress"><b class="text-success">R$: </b> <span class="text-success">{{ $myOrder[0]->value }}</span> - {{ $myOrder[0]->paymentMode }}</p>
                                     </div>
                                 </div>
                          </div>
                       @endif
                   </div>
               </div>
           </div>
       </div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title font-weight-bold historic-header" id="exampleModalLongTitle">
                       Histórico de Pedidos
                       <i class="fa fa-info-circle text-primary"
                          title="Aqui você encontra os pedidos referentes aos últimos 30 dias."></i>
                   </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="container-fluid">
                       <div class="row">
                          @if(!isset($historic[0]))
                              <div class="col-12 text-center">
                                  <h3 class="no-orders-text font-weight-bold">Você não fez <span class="text-warning">nenhum</span> pedido nos últimos 30 dias.</h3>

                                  <img src="{{ asset('img/icons/triste-sem-pedidos.png') }}" class="no-orders">
                              </div>
                          @else
                               @foreach($historic as $order)
                                   @if($order->user_id == $user)
                                       <div class="col-12 mt-3">
                                           <button class="btn btn-white w-100 text-white d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#order{{ $order->id }}" aria-expanded="false" aria-controls="collapseExample">
                                               Pedido #{{ $order->id }}
                                               <i class="fas fa-plus"></i>
                                           </button>
                                           <div class="collapse mt-3" id="order{{ $order->id }}">
                                               <div class="card card-body">
                                                   <div class="container-fluid">
                                                       <div class="row">
                                                           <div class="col-12 mt-5">
                                                               <p class="my-orders">
                                                                   <b> {{ $order->user_name }}</b>
                                                               </p>

                                                               <p class="my-status{{ $order->id }} font-weight-bold
                                                       @if($order->status == 'Pedido Entregue')
                                                       text-success
                                                       @elseif($order->status == 'Cancelado')
                                                       text-danger
                                                       @else
                                                       text-warning
                                                       @endif
                                                       ">
                                                                   {{ $order->status }}
                                                               </p>

                                                               <hr class="hr-my-orders">
                                                           </div>

                                                           <ul>
                                                               @foreach($historicItems as $myItems)
                                                                   @if($myItems->order_id == $order->id)
                                                                       <li>{{ $myItems->product }}</li>
                                                                   @endif
                                                               @endforeach
                                                           </ul>

                                                           <div class="col-12">
                                                               <hr class="hr-my-orders">
                                                           </div>

                                                           <div class="col-12 mt-3">
                                                               <p class="my-orders">
                                                                   <b>{{ $order->userAdress }}.</b>
                                                               </p>

                                                               <p class="my-payment">
                                                                   <b class="text-success">R$: </b>
                                                                   <span class="text-success">{{ $order->value }}</span>
                                                                   - {{ $order->paymentMode }}
                                                               </p>

                                                               <p class="my-data">
                                                                   {{ $order->created_at }}
                                                               </p>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   @endif
                               @endforeach
                          @endif
                       </div>
                   </div>
               </div>
           </div>

    @if($status == false)
        <script>
            $.toast({
                heading: '<b>Não estamos disponíveis no momento!</b>',
                showHideTransition: 'slide',
                bgColor: 'red',
                text: 'Infelizmente não estamos recebendo pedidos no momento. Tente novamente mais tarde!',
                hideAfter: 12000,
                position: 'top-right',
                textColor: 'white',
                icon: 'error'
            });
        </script>
    @endif

    @if(session('new-order'))
        <script>
            $.toast({
                heading: '<b>Que legal, seu pedido foi registrado!</b>',
                showHideTransition: 'slide',  // It can be plain, fade or slide
                bgColor: '#2ecc71',
                text: 'Acompanhe o andamento do seu pedido em tempo real clicando no ícone que está no canto inferior direito.',
                hideAfter: 15000,
                position: 'top-right',
                textColor: '#ecf0f1',
                icon: 'success'
            });
        </script>
    @endif

   @if($liveOrder != 0 && $totalItems == 0)
       <script>
           $(".btn-live-order").css("bottom", "20px").css("important", "true");
       </script>
   @endif

    <script>
        $(document).ready(function () {
            let contador = 0;
           setInterval(function(){
               $.ajax({
                   url: "{{ route('orders.realTime') }}",
                   method: "GET",
                   success: function (response) {
                       let refreshHistoric = true;
                       if(response[0]){
                           response.forEach((item, index) => {
                               if (item.status == "Novo Pedido"){
                                   $(`.my-status${item.id}`).addClass('text-warning');

                               } else if (item.status == "Em Preparação") {
                                   $(`.second-live${item.id}`).css("color", "#FFBF00FF");
                                   $(`.step2${item.id}`).addClass("active");
                                   $(`.my-status${item.id}`).text(item.status);

                                   if (contador === 0) {
                                       $.toast({
                                           heading: '<b>Seu pedido já está sendo preparado!</b>',
                                           showHideTransition: 'slide',
                                           bgColor: '#2ecc71',
                                           text: 'Nossa equipe já está preparando seu pedido com todo o carinho!',
                                           hideAfter: 15000,
                                           position: 'top-right',
                                           textColor: '#ecf0f1',
                                           icon: 'success'
                                       });
                                       contador++;
                                   }

                               } else if (item.status == "Em rota de entrega") {
                                   $(`.third-live${item.id}`).css("color", "#25f4ab");
                                   $(`.step3${item.id}`).addClass("active");
                                   $(`.my-status${item.id}`).text(item.status);

                                   if (contador === 1) {
                                       $.toast({
                                           heading: '<b>Seu pedido já está indo até você!</b>',
                                           showHideTransition: 'slide',
                                           bgColor: '#2ecc71',
                                           text: 'Fique atento(a), o entregador já estará chegando com seu pedido!',
                                           hideAfter: 15000,
                                           position: 'top-right',
                                           textColor: '#ecf0f1',
                                           icon: 'success'
                                       });
                                       contador++;
                                   }
                               }else if (item.status == "Pedido Entregue"){
                                   $(`.fourth-live${item.id}`).css("color", "#25f4ab");
                                   $(`.step4${item.id}`).addClass("active");
                                   $(`.my-status${item.id}`).text(item.status);

                               }else{
                                   $(`.my-status${item.id}`).removeClass('text-warning');
                                   $(`.my-status${item.id}`).addClass('text-danger');
                                   $(`.my-status${item.id}`).text(item.status);
                               }

                               if (item.status != "Pedido Entregue"){
                                   refreshHistoric = false;
                               }

                               if (item.status == "Cancelado"){
                                   refreshHistoric = true;
                                   $(".close-modalLive").click();
                               }
                           });
                       }

                       if (refreshHistoric == true){
                           $(".btn-live-order").fadeOut();
                       }
                   },
                   error: function () {
                       console.error("Erro ao atualizar pedidos");
                   }
               });
           }, 10000)

            let totalItems = {{ $totalItems }};

            if (totalItems == 0) {
                $('.btn-tray-side').hide();
            }

             if($("#valorPagamento").val() != ''){
                 $(".valor-entregue").fadeIn();
             }

            $('.btn-cardapio, .btn-cardapio2').click(function() {
                $('html, body').animate({
                    scrollTop: $('.cardapio').offset().top
                }, 1000);
            });

            $('.btn-services').click(function() {
                $('html, body').animate({
                    scrollTop: $('.services').offset().top
                }, 1000);
            });

            $('.btn-reserve').click(function() {
                $('html, body').animate({
                    scrollTop: $('.reserves').offset().top
                }, 1000);
            });

            function vibrarBandeja() {
                $('.btn-tray-side').addClass('vibrar');

                // Após 500ms, remove a classe para parar a vibração
                setTimeout(function() {
                    $('.btn-tray-side').removeClass('vibrar');
                }, 500); // Duração da vibração
            }

            // A cada 2 segundos, a função vibrarItem será chamada
            setInterval(vibrarBandeja, 1700);

             function fecharBandeja(){
                 $('.modal-full, .tray-container, #trayResume, #deliveryPlace, #paymentStep, #btnBack, #btnLastBack, #btnAddressStep, #btnResumeStep, ' +
                     '#btnSecondBack, #btnCheck, .alerta-troco, .valor-troco').fadeOut();
                 $('.step2, .step3, .step4').removeClass('active')
                 $('.tray-container').html('');
                 $(".btn-tray-side").fadeIn();
             }

            $('.fechar-modal').on('click', function (){
                fecharBandeja();
                atualizarContagemBandeja();
                $(".btn-live-order").css("bottom", "90px").css("important", "true");
            });

            $('#btnOrderStep').on('click', function (){

                var items = []; // Array para armazenar as informações dos produtos

                // Loop para pegar as quantidades de todos os itens na bandeja
                $('.tray-item').each(function() {
                    var productName = $(this).find('.product-title b').text();  // Nome do produto
                    var quantity = parseInt($(this).find('.add-number-items').text(), 10);  // Quantidade do produto

                    // Adiciona o item ao array
                    items.push({
                        product_name: productName,
                        quantity: quantity
                    });
                });

                $.ajax({
                    url: '{{ route('atualizar-quantidade') }}',  // Rota Laravel para armazenar as quantidades
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',  // Token CSRF para proteção
                        items: items  // Dados dos itens e quantidades
                    },
                    success: function(response) {
                        if(response.success) {
                            $('#btnOrderStep').fadeOut();
                            $('#trayItems').fadeOut();
                            $('#deliveryPlace').removeAttr('hidden');
                            $('#btnAddressStep, #deliveryPlace').fadeIn();
                            $('#btnBack').fadeIn(2700);
                            $('.step1').removeClass('active');
                            $('.step2').addClass('active');

                            atualizarPreco();
                        } else {
                            $.toast({
                                heading: '<b>Oopsss, algo errado aconteceu!</b>',
                                showHideTransition: 'slide',
                                bgColor: 'red',
                                text: 'Ocorreu uma falha com o seu pedido. Tente novamente em alguns minutos!',
                                hideAfter: 8000,
                                position: 'top-right',
                                textColor: 'white',
                                icon: 'error'
                            });
                        }
                    },
                    error: function() {
                        $.toast({
                            heading: '<b>Oopsss, algo errado aconteceu!</b>',
                            showHideTransition: 'slide',
                            bgColor: 'red',
                            text: 'Não foi possível se comunicar com o servidor. Entre em contato com a loja.',
                            hideAfter: 8000,
                            position: 'top-right',
                            textColor: 'white',
                            icon: 'error'
                        });
                    }
                });
            });

            function atualizarContagemBandeja() {
                const countUrl = "{{ route('cardapio.count') }}";
                $.ajax({
                    url: countUrl,
                    method: "GET",
                    success: function (response) {
                        $(".cart-count").text(response.count);
                        $('.btn-tray-side').fadeIn();
                    },
                    error: function () {
                        console.error("Erro ao buscar a contagem dos itens na bandeja.");
                    }
                });
            }

            $('.product-form').on('submit', function (e) {
                e.preventDefault(); // Impede o envio padrão do formulário

                const form = $(this);
                const url = "{{ route('cardapio.store') }}"; // URL do backend para adicionar item
                const formData = form.serialize(); // Serializa os dados do formulário, incluindo o `productId`

                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    success: function (response) {
                        form.find("input[type='checkbox']").prop("checked", false);

                        // Reseta outros campos, se necessário
                        form[0].reset();

                        $.toast({
                            heading: '<b>Que legal!</b>',
                            showHideTransition: 'slide',  // It can be plain, fade or slide
                            bgColor: '#2ecc71',
                            text: 'Item adicionado à sua bandeja.',
                            hideAfter: 3000,
                            position: 'top-right',
                            textColor: '#ecf0f1',
                            icon: 'success'
                        });

                        $(".btn-live-order").css("bottom", "90px").css("important", "true");

                        // Após adicionar, faz uma nova requisição para contar os itens
                        atualizarContagemBandeja();
                    },
                    error: function (xhr, status, error) {
                        $.toast({
                            heading: '<b>Oopsss, algo errado aconteceu!</b>',
                            showHideTransition: 'slide',
                            bgColor: 'red',
                            text: 'Não foi possível adicionar este item à sua bandeja.',
                            hideAfter: 8000,
                            position: 'top-right',
                            textColor: 'white',
                            icon: 'error'
                        });
                    }
                });
            });

            function atualizarPreco(){
                $.ajax({
                    url: "{{ route('price.data') }}",
                    method: "GET",
                    success: function (response) {
                        $("#lbl-totalValueFront").text('R$: ' + response.total.toFixed(2));
                        $("#lbl-totalValue").text(response.total.toFixed(2));
                        $("#lbl-subtotal").text("R$: " + response.subtotal.toFixed(2));

                        if(response.sendingValue != null){
                            if(response.sendingValue == 0){
                                $(".delivery-text").fadeIn();
                                $("#lbl-deliveryValue").text("Frete grátis");
                                $("#lbl-time").html('<i class="fa fa-clock mr-1"></i>' + response.time);
                            }else{
                              $(".delivery-text").fadeIn();
                              $("#lbl-deliveryValue").text("+ R$: " + response.sendingValue);
                              $("#lbl-time").html('<i class="fa fa-clock mr-1"></i>' + response.time);
                            }

                        }

                        if(response.discount == 'Frete grátis'){
                            $(".delivery-text").fadeIn();
                            $("#lbl-deliveryValue").text("Frete grátis");
                        }

                        if (response.usedCoupon != null){
                            $(".cupom").fadeIn();
                            $(".cupomUtilizado").text(response.usedCoupon);
                        }

                    },
                    error: function () {
                        console.error("Erro ao buscar valor total");
                    }
                });
            }

            function atualizarBandeja() {
                const baseImageUrl = "{{ asset('products') }}";

                $.ajax({
                    url: '{{ route('tray.data') }}',
                    method: 'GET',
                    success: function(response) {
                        response.forEach(function(item) {
                            // Verifica se existem adicionais
                            var adicionaisHTML = item.additionals ? `<p class="text-success"><b>+ ${item.additionals}</b></p>` : '';

                            var produtoHTML = `
                <div class="col-12 tray-item" data-id="${item.id}">
                    <div class="img-product">
                        <img src="${baseImageUrl}/${item.picture}" class="product-img" alt="Imagem">
                    </div>

                    <div class="product-data">
                        <p class="product-title"><b>${item.product}</b></p>
                        <p class="product-price"><b>R$ ${item.value}</b></p>
                        ${adicionaisHTML} <!-- Adicionais aparecem aqui se existirem -->
                    </div>

                    <div class="add-tray">
                        <span class="btn-less"><i class="fas fa-minus"></i></span>
                        <span class="add-number-items">${item.ammount}</span>
                        <span class="btn-plus"><i class="fas fa-plus"></i></span>
                        <span class="btn btn-remove"><i class="fas fa-times"></i></span>
                    </div>
                </div>
            `;

                            $('.tray-container').append(produtoHTML);
                        });

                        // Aumentar a quantidade
                        $('.btn-plus').click(function() {
                            var itemDiv = $(this).closest('.tray-item');
                            var quantityBox = itemDiv.find('.add-number-items');
                            var quantity = parseInt(quantityBox.text(), 10);
                            quantityBox.text(quantity + 1); // Aumentar a quantidade
                        });

                        // Diminuir a quantidade
                        $('.btn-less').click(function() {
                            var itemDiv = $(this).closest('.tray-item');
                            var quantityBox = itemDiv.find('.add-number-items');
                            var quantity = parseInt(quantityBox.text(), 10);

                            if (quantity > 1) { // Alterado de 0 para 1
                                quantityBox.text(quantity - 1);
                            }
                        });


                        // Remover o item e enviar o nome para o backend
                        $('.btn-remove').click(function() {
                            var itemDiv = $(this).closest('.tray-item');
                            var productName = itemDiv.find('.product-title b').text(); // Captura o nome do produto

                            // Envia o nome para o backend via AJAX
                            $.ajax({
                                url: '{{ route('tray.remove') }}',  // Defina a rota para remover o item
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',  // Inclui o token CSRF
                                    product_name: productName      // Envia o nome do produto
                                },
                                success: function(response) {
                                    // Se a remoção for bem-sucedida no backend, remove o item da interface
                                    if(response.success) {
                                        $.toast({
                                            heading: '<b>Item removido!</b>',
                                            showHideTransition: 'slide',  // It can be plain, fade or slide
                                            bgColor: 'red',
                                            text: response.success,
                                            hideAfter: 3000,
                                            position: 'top-right',
                                            textColor: '#ecf0f1',
                                            icon: 'success'
                                        });
                                        itemDiv.fadeOut();  // Remove o item da bandeja na interface
                                        $(".btn-live-order").css("bottom", "20px").css("important", "true");
                                        atualizarPreco();
                                        recuperarBandeja();
                                    } else {
                                        $.toast({
                                            heading: '<b>Opsss, tivemos um erro!</b>',
                                            showHideTransition: 'slide',
                                            bgColor: 'red',
                                            text: 'Tivemos um erro ao remover este item. Entre em contato com o restaurante.',
                                            hideAfter: 7000,
                                            position: 'top-right',
                                            textColor: 'white',
                                            icon: 'error'
                                        });
                                    }
                                },
                                error: function() {
                                    $.toast({
                                        heading: '<b>Opsss, tivemos um erro!</b>',
                                        showHideTransition: 'slide',
                                        bgColor: 'red',
                                        text: 'Tente dentro de alguns minutos ou entre em contato com o restaurante.',
                                        hideAfter: 7000,
                                        position: 'top-right',
                                        textColor: 'white',
                                        icon: 'error'
                                    });
                                }
                            });
                        });
                    }
                });
            }

            function recuperarBandeja(){
                $.ajax({
                    url: '{{ route('tray.check')}}',
                    method: 'GET',
                    success: function(response) {
                        if(response.count == 0){
                            fecharBandeja();
                            $(".btn-tray-side").fadeOut();
                            $.toast({
                                heading: '<b>Oopsss, bandeja vazia!</b>',
                                showHideTransition: 'slide',
                                bgColor: 'red',
                                text: 'Você precisa adicionar itens à sua bandeja.',
                                hideAfter: 7000,
                                position: 'top-right',
                                textColor: 'white',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Erro ao buscar o endereço:", error);
                    }
                });
            }

            $('.btn-tray, .btn-tray-side').on('click', function (){

                $(".btn-live-order").css("bottom", "20px").css("important", "true");

                $.ajax({
                    url: '{{ route('tray.check')}}',
                    method: 'GET',
                    success: function(response) {
                        if(response.count > 0){
                            $('.modal-full, #btnOrderStep').removeAttr('hidden').fadeIn();
                            $('.step1').addClass('active');
                            atualizarBandeja();
                            atualizarPreco();
                            setTimeout(() => {
                                $('.tray-container').fadeIn();
                            }, 700);
                        }else{
                            $.toast({
                                heading: '<b>Oopsss, bandeja vazia!</b>',
                                showHideTransition: 'slide',
                                bgColor: 'red',
                                text: 'Você precisa adicionar itens à sua bandeja.',
                                hideAfter: 7000,
                                position: 'top-right',
                                textColor: 'white',
                                icon: 'error'
                            });
                        }

                    },
                    error: function(xhr, status, error) {
                        alert("Erro ao buscar o endereço:", error);
                    }
                });


                $(".btn-tray-side").fadeOut();
            });

            function manterSubtotal(){
                $.ajax({
                    url: "{{ route('price.data') }}",
                    method: "GET",
                    success: function (response) {
                        $("#lbl-totalValue").text(response.total.toFixed(2));
                        $("#lbl-totalValueFront").text("R$ " + response.total.toFixed(2));
                    },
                    error: function () {
                        console.error("Erro ao buscar valor total");
                    }
                });
            }

    $('#btnAddressStep').on('click', function(e) {
        e.preventDefault();

        function verificarPedido(){
            $.ajax({
                url: '{{ route('tray.data') }}',
                method: 'GET',
                success: function(response) {
                    const baseImageUrl = "{{ asset('products') }}";
                    if (response.length > 0) {
                        $('#resumeItemsList').empty();

                        // Loop para criar os campos para cada produto
                        response.forEach(function(tray) {
                            // Verifica se existem adicionais
                            var adicionaisHTML = tray.additionals ? `<p class="text-success"><b>+ ${tray.additionals}</b></p>` : '';

                            var produtoHTML = `
                    <div class="col-12 tray-item">
                        <div class="img-product">
                            <img src="${baseImageUrl}/${tray.picture}" class="product-img" alt="Imagem">
                        </div>

                        <div class="product-data">
                            <p class="resume-product-title">
                                <b>${tray.product}</b>
                            </p>

                            <p class="resume-product-price">
                                <b>R$ ${tray.value}</b>
                            </p>
                            ${adicionaisHTML} <!-- Adicionais aparecem aqui se existirem -->
                        </div>

                        <p class="resume-product-quantity">
                            x <b>${tray.ammount}</b>
                        </p>
                    </div>
                `;

                            // Adiciona o HTML do produto no contêiner
                            $('#resumeItemsList').append(produtoHTML);
                        });
                    } else {
                        alert('Nenhum produto encontrado');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Erro ao buscar produtos:", error);
                }
            });
        }

        function cadastrarEndereço (){
            var form = $('#formAddress');

            var formData = new FormData(form[0]);

            $.ajax({
                url: '{{ route('capturar-endereco') }}',
                type: 'POST',
                data: formData,
                processData: false,  // Impede que o jQuery processe os dados (necessário para enviar arquivos)
                contentType: false,  // Impede que o jQuery defina o content-type (necessário para FormData)
                error: function(xhr, status, error) {
                    $.toast({
                        heading: '<b>Oopsss, tivemos um erro!</b>',
                        showHideTransition: 'slide',
                        bgColor: 'red',
                        text: 'Não foi possível registrar seu endereço. Entre em contato com o restaurante para fazer seu pedido.',
                        hideAfter: 10000,
                        position: 'top-right',
                        textColor: 'white',
                        icon: 'error'
                    });
                }
            });
        }

        var local = $('#txtBairro').val();
        $.ajax({
            url: '{{ route('calcular-frete')}}',
            method: 'GET',
            data: { local: local },
            success: function(response) {

                if(response.taxe != 'no'){

                    let nome = $("#txtNome").val();
                    let endereco = $("#txtEndereco").val();
                    let bairro = $("#txtBairro").val();
                    let numero = $("#txtNumero").val();
                    let cidade = $("#txtCity").val();
                    let contato = $("#txtContato").val();

                    function toastTrigger(message){
                        $.toast({
                            heading: '<b>Preencha todos os campos!</b>',
                            showHideTransition: 'slide',
                            bgColor: 'red',
                            text: `${message}`,
                            hideAfter: 10000,
                            position: 'top-right',
                            textColor: 'white',
                            icon: 'error'
                        });
                    }

                    if(endereco === ''){
                        let message = "o campo endereço não foi preenchido corretamente.";
                        toastTrigger(message);
                        $("#txtEndereco").focus();
                    }else if(bairro === ''){
                        let message = "o campo bairro não foi preenchido corretamente.";
                        toastTrigger(message);
                        $("#txtBairro").focus();
                    }else if(numero === ''){
                        let message = "o campo de número da residência não foi preenchido corretamente.";
                        toastTrigger(message);
                        $('#txtNumero').focus();
                    }else if(cidade === ''){
                        let message = "o campo cidade não foi preenchido corretamente.";
                        toastTrigger(message);
                        $("#txtCity").focus();
                    }else if(nome === ''){
                        let message = "o campo nome não foi preenchido corretamente.";
                        toastTrigger(message);
                        $("#txtNome").focus();
                    }else if(contato === ''){
                        let message = "o campo contato não foi preenchido corretamente.";
                        toastTrigger(message);
                        $("#txtContato").focus();
                    }else{
                        $('#deliveryPlace').fadeOut();
                        $('#btnBack, #btnAddressStep').fadeOut();
                        $('#paymentStep').removeAttr('hidden');
                        $('.step2').removeClass('active');
                        $('.step3').addClass('active');
                        $('#btnCheck, #btnSecondBack, #paymentStep').fadeIn();

                        $(".delivery-text").fadeIn();
                        if(response.taxe == 0 || response.discount == 'Frete grátis'){
                            $("#lbl-deliveryValue").text("Frete grátis");
                            $("#lbl-time").html('<i class="fa fa-clock mr-1"></i>' + response.time);
                        }else{
                            $("#lbl-deliveryValue").text("+ R$ " + response.taxe);
                            $("#lbl-time").html('<i class="fa fa-clock mr-1"></i>' + response.time);
                        }

                        cadastrarEndereço();
                        verificarPedido();
                        manterSubtotal();
                    }
                }else{
                    $.toast({
                        heading: '<b>Endereço fora da área de entregas!</b>',
                        showHideTransition: 'slide',
                        bgColor: 'red',
                        text: 'Infelizmente não entregamos nesta localidade.',
                        hideAfter: 10000,
                        position: 'top-right',
                        textColor: 'white',
                        icon: 'error'
                    });
                }

            },
            error: function(xhr, status, error) {
                alert("Falha ao calcular frete", error);
            }
        });
    });

    $("#cadastrarCupom").on('click', function(){
        var form = $('#formCoupon'); // Seleciona o formulário com ID 'formAddress'

            var formData = new FormData(form[0]); // Cria o objeto FormData com os dados do formulário

            $.ajax({
                url: '{{ route('verificar-cupom') }}',
                type: 'POST',
                data: formData,  // Dados do formulário
                processData: false,  // Impede que o jQuery processe os dados (necessário para enviar arquivos)
                contentType: false,  // Impede que o jQuery defina o content-type (necessário para FormData)
                success: function(response) {

                   if(response.found == true && response.error == false){

                    $.toast({
                        heading: '<b>Tudo certo!</b>',
                        showHideTransition: 'slide',  // It can be plain, fade or slide
                        bgColor: '#2ecc71',
                        text: response.message,
                        hideAfter: 8000,
                        position: 'top-right',
                        textColor: '#ecf0f1',
                        icon: 'success'
                    });

                        if(response.type == 'Frete grátis'){
                            let valor = parseFloat($("#lbl-totalValue").text()) - response.sendingValue;

                            $("#lbl-totalValueFront").text("R$ " + valor.toFixed(2));
                            $("#lbl-totalValue").text(valor.toFixed(2));
                            $("#lbl-deliveryValue").text("Frete grátis");
                            $("#cadastrarCupom").fadeOut();
                            $("#removerCupom, .cupom").fadeIn();
                            $(".cupomUtilizado").text(response.usedCoupon);
                            $("#coupon").prop('disabled', true).css('cursor', 'not-allowed');

                        }else if(response.type == 'Porcentagem'){
                            let valor = parseFloat($("#lbl-totalValue").text()) - (parseFloat($("#lbl-totalValue").text()) / parseInt(response.discount));

                            $("#lbl-totalValueFront").text("R$ " + parseFloat(valor.toFixed(2)));
                            $("#lbl-totalValue").text(valor.toFixed(2));
                            $("#cadastrarCupom").fadeOut();
                            $("#removerCupom, .cupom").fadeIn();
                            $(".cupomUtilizado").text(response.usedCoupon);
                            $("#coupon").prop('disabled', true).css('cursor', 'not-allowed');

                        }else if(response.type == 'Dinheiro'){
                            let valor = parseFloat($("#lbl-totalValue").text()) - parseInt(response.discount);

                            $("#lbl-totalValueFront").text("R$ " + valor.toFixed(2));
                            $("#lbl-totalValue").text(valor.toFixed(2));
                            $("#cadastrarCupom").fadeOut();
                            $("#removerCupom, .cupom").fadeIn();
                            $(".cupomUtilizado").text(response.usedCoupon);
                            $("#coupon").prop('disabled', true).css('cursor', 'not-allowed');
                        }
                   }else{
                    $("#coupon").val('');
                    $.toast({
                        heading: `<b>${response.heading}</b>`,
                        showHideTransition: 'slide',
                        bgColor: 'red',
                        text: response.message,
                        hideAfter: 10000,
                        position: 'top-right',
                        textColor: 'white',
                        icon: 'error'
                    });
                   }
                },
                error: function(xhr, status, error) {
                    $.toast({
                        heading: '<b>Oopsss, tivemos um erro!</b>',
                        showHideTransition: 'slide',
                        bgColor: 'red',
                        text: 'Não foi possível inserir seu cupom!',
                        hideAfter: 10000,
                        position: 'top-right',
                        textColor: 'white',
                        icon: 'error'
                    });
                }
            });
    });


    $("#removerCupom").on('click', function(){
            $.ajax({
                url: '{{ route('removerCupom')}}',
                method: 'GET',
                success: function(response) {
                    $.toast({
                        heading: '<b>Tudo certo!</b>',
                        showHideTransition: 'slide',  // It can be plain, fade or slide
                        bgColor: '#2ecc71',
                        text: response.message,
                        hideAfter: 8000,
                        position: 'top-right',
                        textColor: '#ecf0f1',
                        icon: 'success'
                    });

                    $("#coupon").removeAttr('disabled').css('cursor', 'inherit').val('');
                    $("#cadastrarCupom").fadeIn();
                    $("#removerCupom, .cupom").fadeOut();
                    $("#lbl-totalValueFront").text("R$ " + response.value.toFixed(2));
                    $("#lbl-totalValue").text(response.value.toFixed(2));
                    $("#lbl-subtotal").text("R$ " + response.subtotal.toFixed(2));

                    if(response.taxe == 0){
                        $("#lbl-deliveryValue").text("Frete grátis");
                    }else{
                        $("#lbl-deliveryValue").text("+ R$ " + response.taxe);
                    }

                },
                error: function(xhr, status, error) {
                    alert("Erro ao buscar o endereço:", error);
                }
            });
    });


    $("#btnCheck").on('click', function (){

        function buscarEndereco(){
            $.ajax({
                url: '{{ route('recuperar-endereco')}}',
                method: 'GET',
                success: function(response) {
                    $("#addressResume").text(response.address + ', '+ response.number + ' - ' + response.neighbourhood);
                    $("#userResume").text(response.name);

                    let valorEntregue = parseFloat(response.change);
                    valorEntregue = valorEntregue.toFixed(2)

                    if(response.paymentMode == 'Dinheiro'){
                        $("#userData").text(`Troco para R$: ${valorEntregue}`);
                    }else{
                        $("#userData").text(response.paymentMode);
                    }

                    if($("#txtCEP").val() == ''){
                        $("#cityAddress").text(response.city);
                    }else{
                        $("#cityAddress").text(response.city + ' / ' + $("#txtCEP").val());
                    }

                },
                error: function(xhr, status, error) {
                    alert("Erro ao buscar o endereço:", error);
                }
            });
        }

        function armazenarMetodoPagamento(){
            var form = $('#formPayment'); // Seleciona o formulário com ID 'formAddress'

            var formData = new FormData(form[0]); // Cria o objeto FormData com os dados do formulário

            $.ajax({
                url: '{{ route('adicionar-pagamento') }}',
                type: 'POST',
                data: formData,  // Dados do formulário
                processData: false,  // Impede que o jQuery processe os dados (necessário para enviar arquivos)
                contentType: false,  // Impede que o jQuery defina o content-type (necessário para FormData)
                success: function(response) {

                    $.toast({
                        heading: '<b>Tudo certo!</b>',
                        showHideTransition: 'slide',  // It can be plain, fade or slide
                        bgColor: '#2ecc71',
                        text: 'Revise o pedido antes de enviar ao restaurante.',
                        hideAfter: 8000,
                        position: 'top-right',
                        textColor: '#ecf0f1',
                        icon: 'success'
                    });
                },
                error: function(xhr, status, error) {
                    $.toast({
                        heading: '<b>Oopsss, tivemos um erro!</b>',
                        showHideTransition: 'slide',
                        bgColor: 'red',
                        text: 'Não foi possível registrar seu meio de pagamento. Entre em contato com o restaurante para fazer seu pedido.',
                        hideAfter: 10000,
                        position: 'top-right',
                        textColor: 'white',
                        icon: 'error'
                    });
                }
            });
        }

        function avancarSt4(){
            $('.step3').removeClass('active');
            $('.step4').addClass('active');
            $('#btnSecondBack, #paymentStep, #btnCheck').fadeOut();
            $('#trayResume').removeAttr('hidden')
            $('#btnLastBack, #btnResumeStep, #trayResume').fadeIn();
            armazenarMetodoPagamento();

            setTimeout(function(){
                buscarEndereco();
            }, 1000);
        }

        if ($("#pagamento").val() != null){

            if ($("#pagamento").val() == 'Dinheiro'){
                if ($("#valorPagamento").val() == '' || $("#valorPagamento").val() < parseFloat($('#lbl-totalValue').text())){
                    $.toast({
                        heading: '<b>Verifique valor a ser entregue!</b>',
                        showHideTransition: 'slide',
                        bgColor: 'red',
                        text: 'O valor a ser entregue não pode ser vazio ou menor que o valor total do pedido.',
                        hideAfter: 10000,
                        position: 'top-right',
                        textColor: 'white',
                        icon: 'error'
                    });
                }else{
                    avancarSt4();
                }
            }else{
                avancarSt4();
            }
        }else{
            $.toast({
                heading: '<b>Preencha os campos de pagamento!</b>',
                showHideTransition: 'slide',
                bgColor: 'red',
                text: 'É necessário que você escolha um método de pagamento.',
                hideAfter: 10000,
                position: 'top-right',
                textColor: 'white',
                icon: 'error'
            });
        }
    });

    // $("#btnResumeStep").on('click', function (){
    //     $("#confirmarPedido").submit();
    // });
});
    </script>
</body>
</html>
