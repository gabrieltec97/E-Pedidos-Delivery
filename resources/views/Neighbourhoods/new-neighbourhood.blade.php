@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Cadastrar bairro
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="row">
            <form action="{{ route('bairros.store') }}" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h3 class="mb-0">Novo bairro</h3>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto btn-cadastrar"><b>Cadastrar</b></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-sm">Cadastre um novo bairro atendido para entregas</p>
                            <div class="row">
                                <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cep</label>
                                        <input class="form-control" id="txtCEP" type="text" placeholder="Cep de uma rua deste bairro" name="cep">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <input class="form-control" type="text" id="txtBairro" placeholder="Nome do bairro" name="name" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Taxa de entrega</label>
                                        <input class="form-control value" type="text" placeholder="Valor da entrega" name="taxe" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tempo médio de entrega</label>
                                        <select class="form-control" name="time" required>
                                            <option value="20min a 40min">20min a 40min</option>
                                            <option value="40min a 60min">40min a 60min</option>
                                            <option value="1hora a 1h e 20min">1hora a 1h e 20min</option>
                                            <option value="1h e 20min a 1h e 40min">1h e 20min a 1h e 40min</option>
                                            <option value="1h e 40min a 2h">1h e 40min a 2h</option>
                                            <option value="Acima de 2 horas">Acima de 2 horas</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <input type="checkbox" name="is_available" id="available" checked>
                                        <label for="available">Atendendo agora</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
        
        $('#txtCEP').mask('00000-000');
        $('.value').mask('000.000.000.000.000.00', {reverse: true});

            //API de busca de cep.
        function buscarCep(){
            var cep = $('#txtCEP').val().trim().replace(/\D/g,'');
    
            if (cep != ""){
                var cepValidate = /^[0-9]{8}$/;
    
                if (cepValidate.test(cep)){
                    $.getJSON("http://viacep.com.br/ws/" + cep + "/json/?callback=?", function (data){
    
                        if (!("erro" in data)){
                            $('#txtBairro').val(data.bairro);

                            var local = data.bairro;
                            $.ajax({
                               url: '{{ route('verificar-bairro')}}',
                               method: "GET",
                               data: { local: local },
                               success: function (response) {
                                
                                $('.btn-cadastrar').prop('disabled', 'true');
                                   
                                   if(response.return == true){
                                    $.toast({
                                        heading: '<b>Bairro já cadastrado!</b>',
                                        showHideTransition: 'slide',
                                        bgColor: 'red',
                                        text: 'Este bairro já está cadastrado no sistema, verifique seu cadastro no gerenciamento de bairros.',
                                        hideAfter: 12000,
                                        position: 'top-right',
                                        textColor: 'white',
                                        icon: 'error'
                                    });

                                    
                                    
                                
                                   }else{
                                    
                                    $('.btn-cadastrar').removeAttr('disabled');
                        
                                   }
                               },
                               error: function () {
                                   console.error("Erro ao buscar a contagem dos itens na bandeja.");
                               }
                            });
    
                        }else{
                            $.toast({
                                heading: '<b>Cep inválido!</b>',
                                showHideTransition: 'slide',
                                bgColor: 'red',
                                text: 'Não conseguimos encontrar este cep, busque um cep de uma outra rua.',
                                hideAfter: 8000,
                                position: 'top-right',
                                textColor: 'white',
                                icon: 'error'
                            });

                            $('#txtBairro').val('');
                        }
                    })
                }
    
            }else{
                $('#txtCEP').focus();
            }
        }
    
        $("#txtCEP").blur(function() {
            buscarCep();
        });

        $(".btn-cadastrar").on('click', function(){
            $(this).html('<b><span class="spinner-border spinner-border-sm"></span> Cadastrar</b>');

            setTimeout(() => {
                $(this).html('<b>Cadastrar</b>');
            }, 4000);
        })
       
    });
    </script>
@endsection


