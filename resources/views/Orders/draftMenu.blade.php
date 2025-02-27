<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquerytoast.css') }}">
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/menu-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title>Cardápio - Seja bem vindo!</title>
</head>
<body>
    <a class="btn-tray-side">
        <div class="badge-total-tray cart-count">{{ $totalItems }}</div>
        <i class="fa fa-shopping-bag"></i>
    </a>
    <section class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg pl-0 pr-0">
                <a href="#" class="navbar-brand"></a>
                <img class="img.logo" src="{{ asset('assets/img/logo.png') }}" width="140px">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar navbar-nav ml-auto mr-auto">
                        <li class="nav-item">
                            <a href="#reservas" class="nav-link"><b>Reservas</b></a>
                        </li>
                        <li class="nav-item">
                            <a href="#serviços" class="nav-link"><b>Serviços</b></a>
                        </li>
                        <li class="nav-item">
                            <a href="#cardápio" class="nav-link"><b>Cardápio</b></a>
                        </li>
                        <li class="nav-item">
                            <a href="#depoimentos" class="nav-link"><b>Depoimentos</b></a>
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
                <div class="col-6">
                    <div class="d-flex text-banner">
                        <h1><b>Escolha sua comida <b class="color-primary">favorita!</b></b></h1>
                        <p>Aproveite nosso cardápio. Escolha o que desejar e receba no conforto do seu lar de forma rápida e segura!</p>

                        <div>
                            <a class="btn btn-yellow mt-4 mr-3">
                                Ver cardápio
                            </a>
                            <a href="" class="btn btn-white btn-icon-left mt-4 contact">
                                <span class="icon-left">
                                    <i class="fa fa-phone"></i>
                                </span>
                                (21) 99746-7377
                            </a>
                        </div>
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

                <div class="col-6">
                    <div class="card-banner"></div>
                    <div class="d-flex img-banner">
                        <img src="{{ asset('assets/img/burguer.png') }}"">
                    </div>
                    <div class="card card-case">
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
                <div class="col-12 text-center mb-5">
                    <span class="hint-title"><b>Serviços</b></span>
                    <h1 class="title">
                        <b>Qual é o nosso diferencial?</b>
                    </h1>
                </div>
                <div class="col-4 mb-5">
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

                <div class="col-4 mb-5">
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

                <div class="col-4 mb-5">
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
                <div class="col-12 text-center mb-5">
                    <span class="hint-title"><b>Cardápio</b></span>
                    <h1 class="title">
                        <b>Conheça o nosso cardápio</b>
                    </h1>
                </div>

                <div class="col-12 container-menu">
                    <a class="btn btn-white btn-sm burguersBtn mr-3 active">
                        <i class="fas fa-hamburger"></i>&nbsp; Burgers
                    </a>

                    <a class="btn btn-white btn-sm mr-3">
                        <i class="fas fa-hamburger"></i>&nbsp; Artesanais
                    </a>

                    <a class="btn btn-white btn-sm mr-3 drinksBtn">
                        <i class="fas fa-wine-bottle"></i>&nbsp; Bebidas
                    </a>

                    <a class="btn btn-white btn-sm dessertsBtn mr-3">
                        <i class="fas fa-cookie-bite"></i>&nbsp; Sobremesas
                    </a>
                </div>

                <div class="col-12">
                    <div class="row burguersDiv">
                        @foreach($burguers as $burguer)
                            <div class="col-3 mt-4">
                                <form class="product-form" data-product-id="{{ $burguer->id }}" action="{{ route('cardapio.store')}}" method="post">
                                    @csrf
                                    <div class="card card-item">
                                        <div class="product-img">
                                            <img src="{{ asset('assets/img/cardapio/burguers/burger-au-poivre-kit-4-pack.3ca0e39b02db753304cd185638dad518.jpg') }}" />
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

                    <div class="row drinksDiv" hidden>
                        @foreach($drinks as $drink)
                            <div class="col-3 mt-4">
                                <form class="product-form" data-product-id="{{ $drink->id }}" action="{{ route('cardapio.store')}}" method="post">
                                    @csrf
                                    <div class="card card-item">
                                        <div class="product-img">
                                            <img src="{{ asset('assets/img/cardapio/burguers/burger-au-poivre-kit-4-pack.3ca0e39b02db753304cd185638dad518.jpg') }}" />
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

                    <div class="row dessertsDiv" hidden>
                        @foreach($desserts as $dessert)
                            <div class="col-3 mt-4">
                                <form class="product-form" data-product-id="{{ $dessert->id }}" action="{{ route('cardapio.store')}}" method="post">
                                    @csrf
                                    <div class="card card-item">
                                        <div class="product-img">
                                            <img src="{{ asset('assets/img/cardapio/burguers/burger-au-poivre-kit-4-pack.3ca0e39b02db753304cd185638dad518.jpg') }}" />
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

                <div class="col-12 text-center">
                   <a class="btn btn-white btn-sm mt-5"><b>Ver mais</b></a>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">

    </section>

    <section class="reserve">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card-secondary">
                        <div class="row">
                            <div class="col-7">
                               <span class="hint-title"><b>Reservas</b></span>
                                <h1 class="title">
                                <b>Quer reservar um horário?</b>
                                </h1>
                                <p class="pr-5">
                                    Mande uma mensagem clicando no botão abaixo!
                                    <br>
                                    Reserve sua data e horário de forma simples e rápida.
                                </p>

                                <a class="btn btn-yellow mt-4">
                                    <b>Fazer reserva</b>
                                </a>
                            </div>

                            <div class="col-5">
                                <div class="card-reserve"></div>
                                <div class="d-flex img-banner">
                                    <img src="{{ asset('assets/img/icone-reserva.svg') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tray">

    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-3 container-logo-footer">
                   <img class="logo-footer" src="{{ asset('assets/img/logo.png') }}" />
                </div>
                <div class="col-6 container-footer-text">
                    <p class="mb-0">
                        <b>E-Pedidos Delivery</b> &copy; Todos os direitos reservados.
                    </p>
                </div>
                <div class="col-3 container-media-footer">
                   <a class="btn btn-sm btn-white btn-social mr-3">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a class="btn btn-sm btn-white btn-social mr-3">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a class="btn btn-sm btn-white btn-social">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal-full" hidden>
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

                        <div class="col-4">
                            <div class="form-group container-cep">
                                <label for="txtCEP"><b>Cep:</b></label>
                                <input type="text" id="txtCEP" name="cep" value="{{ $tray[0]->cep }}" class="form-control">
                                <a class="btn btn-yellow btn-sm buscar-cep">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="txtNome"><b>Nome:</b></label>
                                <input type="text" id="txtNome" name="name" value="{{ $tray[0]->name }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="txtContato"><b>Contato:</b></label>
                                <input type="number" id="txtContato" name="contact" value="{{ $tray[0]->contact }}"  class="form-control" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtEndereco"><b>Endereço:</b></label>
                                <input type="text" id="txtEndereco" name="address" value="{{ $tray[0]->address }}"  class="form-control">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="txtBairro"><b>Bairro:</b></label>
                                <input type="text" id="txtBairro" name="neighbourhood" value="{{ $tray[0]->neighbourhood }}"  class="form-control">
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <label for="txtNumero"><b>Número:</b></label>
                                <input type="text" id="txtNumero" name="number" value="{{ $tray[0]->number }}"  class="form-control">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="txtCity"><b>Cidade:</b></label>
                                <input type="text" id="txtCity" name="city" value="{{ $tray[0]->city }}"  class="form-control" required>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="form-group">
                                <label for="txtComplement"><b>Complemento:</b></label>
                                <input type="text" id="txtComplement" name="complement" value="{{ $tray[0]->complement }}"  class="form-control">
                            </div>
                        </div>
                    </div>
                </form>

                <div id="paymentStep" hidden>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="pagamento"><b>Forma de pagamento:</b></label>
                            <select name="payment" id="pagamento" class="form-control">
                                <option disabled selected>Selecione</option>
                                <option value="Dinheiro">Dinheiro</option>
                                <option value="Mastercard - crédito">Mastercard - crédito</option>
                                <option value="Mastercard - débito">Mastercard - débito</option>
                                <option value="Elo - crédito">Elo - crédito</option>
                                <option value="Elo - débito">Elo - débito</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6 valor-entregue">
                        <div class="form-group">
                            <label for="valorPagamento"><b>Quanto você irá entregar:</b></label>
                            <input type="number" id="valorPagamento" name="change" value="{{ $tray[0]->complement }}"  class="form-control mb-2">
                            <span class="text-danger alerta-troco"><b>O valor entregue não pode ser menor que o valor total do pedido!</b></span>
                            <span class="text-success valor-troco"><b></b></span>
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
                            <b>Local da entrega:</b>
                        </p>
                    </div>

                    <div class="col-12 tray-item resume">
                        <div class="img-map">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>

                        <div class="product-data">
                            <p class="address-text">
                                <b id="addressResume">Rua de teste, 100, bairro teste</b>
                            </p>

                            <p class="cityAddress" id="cityAddress">
                                Cidade-RJ / 14711-000
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-footer">
            <div class="container">
                <div class="container-total text-right mb-4">
                    <p class="mb-0">
                        <span>Subtotal: </span>
                        <span id="lbl-subtotal"></span>
                    </p>

                    <p class="mb-0 delivery-text">
                        <span><i class="fas fa-motorcycle"></i> Entrega: </span>
                        <span id="lbl-deliveryValue">+ R$ 5,00</span>
                    </p>

                    <p class="mb-0 total-text">
                        <span><b>Total: </b></span>
                        <span class="totalValue" id="lbl-totalValue">R$: <b></b></span>
                    </p>
                </div>

                <a class="btn btn-yellow float-right" id="btnOrderStep">Continuar</a>
                <a class="btn btn-yellow float-right" id="btnAddressStep">Continuar</a>
                <a class="btn btn-yellow float-right" id="btnCheck">Revisar pedido</a>
                <a class="btn btn-yellow float-right" id="btnResumeStep">Enviar pedido</a>
                <a class="btn btn-white float-right mr-3" id="btnBack">Voltar</a>
                <a class="btn btn-white float-right mr-3" id="btnSecondBack">Voltar</a>
                <a class="btn btn-white float-right mr-3" id="btnLastBack">Voltar</a>
            </div>
        </div>
    </div>

    <form id="confirmarPedido" action="{{ route('pedidos.store') }}" method="post">@csrf</form>

    <script type="text/javascript" src="{{ asset('assets/js/jquery-1.12.4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/modernizr-3.5.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dados.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/jquerytoast.js') }}"></script>

    <script>
        $(document).ready(function () {
            function atualizarContagemBandeja() {
                const countUrl = "{{ route('cardapio.count') }}";
                $.ajax({
                    url: countUrl,
                    method: "GET",
                    success: function (response) {
                        // Atualiza o contador no HTML (exemplo: um <span id="cart-count">)
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
                        // Exibe uma mensagem de sucesso
                        $.toast({
                            heading: '<b>Que legal!</b>',
                            showHideTransition: 'slide',  // It can be plain, fade or slide
                            bgColor: '#2ecc71',
                            text: 'Item adicionado à sua bandeja.',
                            hideAfter: 8000,
                            position: 'top-right',
                            textColor: '#ecf0f1',
                            icon: 'success'
                        });

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
                        $("#lbl-subtotal, #lbl-totalValue").text(response);
                    },
                    error: function () {
                        console.error("Erro ao buscar valor total");
                    }
                });
            }

            function atualizarBandeja(){

                $.ajax({
                url: '{{ route('tray.data') }}',
                method: 'GET',
                success: function(response) {

                response.forEach(function(item) {
                var produtoHTML = `
                    <div class="col-12 tray-item">
                        <div class="img-product">
                             <img class="product-img" src="{{ asset('assets/img/cardapio/burguers/burger-au-poivre-kit-4-pack.3ca0e39b02db753304cd185638dad518.jpg') }}" />
                        </div>

                        <div class="product-data">
                            <p class="product-title"><b>${item.product}</b></p>
                            <p class="product-price"><b>R$ ${item.value}</b></p>
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
        },
            error: function() {
                $.toast({
                    heading: '<b>Oopsss, algo errado aconteceu!</b>',
                    showHideTransition: 'slide',
                    bgColor: 'red',
                    text: 'Não foi possível carregar os itens da sua bandeja. Entre em contato com o restaurante!',
                    hideAfter: 10000,
                    position: 'top-right',
                    textColor: 'white',
                    icon: 'error'
                });
            }
    });
            }

            $('.btn-tray, .btn-tray-side').on('click', function (){

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


    $('#btnAddressStep').on('click', function(e) {
        e.preventDefault();

        function buscarEndereco(){
            $.ajax({
                url: '{{ route('recuperar-endereco')}}',
                method: 'GET',
                success: function(response) {
                    $("#addressResume").text(response.address + ', '+ response.number + ' - ' + response.neighbourhood);

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

        function verificarPedido(){
            $.ajax({
                url: '{{ route('tray.data') }}',
                method: 'GET',
                success: function(response) {
                    if (response.length > 0) {
                        // Limpar o contêiner de produtos antes de adicionar novos
                        $('#resumeItemsList').empty();

                        // Loop para criar os campos para cada produto
                        response.forEach(function(tray) {
                            var produtoHTML = `
                            <div class="col-12 tray-item">
                                <div class="img-product">
                                    <img class="product-img" src="{{ asset('assets/img/cardapio/burguers/burger-au-poivre-kit-4-pack.3ca0e39b02db753304cd185638dad518.jpg') }}" />
                                </div>

                                <div class="product-data">
                                    <p class="resume-product-title">
                                        <b>${tray.product}</b>
                                    </p>

                                    <p class="resume-product-price">
                                        <b>R$ ${tray.value}</b>
                                    </p>
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
            var form = $('#formAddress'); // Seleciona o formulário com ID 'formAddress'

            var formData = new FormData(form[0]); // Cria o objeto FormData com os dados do formulário

            $.ajax({
                url: '{{ route('capturar-endereco') }}',  // Rota para onde os dados serão enviados no backend
                type: 'POST',  // Método HTTP
                data: formData,  // Dados do formulário
                processData: false,  // Impede que o jQuery processe os dados (necessário para enviar arquivos)
                contentType: false,  // Impede que o jQuery defina o content-type (necessário para FormData)
                success: function(response) {

                    $.toast({
                        heading: '<b>Endereço salvo com sucesso!</b>',
                        showHideTransition: 'slide',  // It can be plain, fade or slide
                        bgColor: '#2ecc71',
                        text: 'Agora vamos finalizar o pedido.',
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

                if(response != 'no'){

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
                    }else if(bairro === ''){
                        let message = "o campo bairro não foi preenchido corretamente.";
                        toastTrigger(message);
                        console.log(bairro)
                    }else if(numero === ''){
                        let message = "o campo de número da residência não foi preenchido corretamente.";
                        toastTrigger(message);
                    }else if(cidade === ''){
                        let message = "o campo cidade não foi preenchido corretamente.";
                        toastTrigger(message);
                    }else if(contato === ''){
                        let message = "o campo contato não foi preenchido corretamente.";
                        toastTrigger(message);
                    }else{
                        $('#deliveryPlace').fadeOut();
                        $('#btnBack, #btnAddressStep').fadeOut();
                        $('#paymentStep').removeAttr('hidden');
                        $('.step2').removeClass('active');
                        $('.step3').addClass('active');
                        $('#btnCheck, #btnSecondBack, #paymentStep').fadeIn();

                        $(".delivery-text").fadeIn();
                        if (response != 0){
                            $("#lbl-deliveryValue").text("+ R$ " + response);
                        }else{
                            $("#lbl-deliveryValue").text("Frete grátis");
                        }

                        cadastrarEndereço();
                        verificarPedido();
                        buscarEndereco();
                        atualizarPreco();
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
    $("#btnResumeStep").on('click', function (){
        $("#confirmarPedido").submit();
    });
});
    </script>
</body>
</html>
