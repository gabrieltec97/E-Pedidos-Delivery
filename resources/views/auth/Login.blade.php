<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Pedidos | Administração</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
{{--    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquerytoast.css') }}">
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">

            <div class="row">
                <div class="col-8 d-sm-none d-lg-block">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="img/img-01.png" class="img-login" alt="IMG">
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-sm-12">
                    <div class="div-login">
                        <form class="login100-form validate-form" action="{{ route('login.perform') }}" method="post">
                            @csrf
                            <span class="login100-form-title text-black">
                           <b>Área de membros</b>
                        </span>

                            <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                                <input class="input100" type="text" name="email" placeholder="Email">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                <input class="input100" type="password" name="password" placeholder="Senha">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn" type="submit">
                                    <span class="login-label">Login</span>
                                </button>
                            </div>

                            <div class="text-center p-t-12">
                            <span class="txt1">
                                Esqueceu
                            </span>
                                <a class="txt2 pass-recover">
                                    sua senha?
                                </a>
                            </div>

                            <div class="text-center p-t-136">
                                <a class="txt2" href="#">
                                    Suporte E-Pedidos
                                    <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 col-sm-12">
                <div class="div-recover">
                    <span class="login100-form-title text-black font-weight-bold">
                        Recuperação de senha:
                    </span>
                    <div class="wrap-input100 validate-input mt-3" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100 myEmail" type="email" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                    </div>
                    <button class="btn btn-primary mt-2 w-100 font-weight-bold send-code">Enviar código</button>

                    <div class="text-center p-t-12">
                            <span class="txt1">
                                Voltar
                            </span>
                        <a class="txt2 back-login">
                            ao login.
                        </a>
                    </div>
                </div>

                <div class="div-insert">
                    <form id="recover-form" method="post">
                        @csrf
                        <span class="login100-form-title text-black font-weight-bold">
                        Insira seu código:
                    </span>
                        <div class="wrap-input100 validate-input mt-3" data-validate = "Valid email is required: ex@abc.xyz">
                            <input class="input100 myCode" type="number" name="code" placeholder="Código enviado ao e-mail" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input class="input100 pass1" type="password" name="password" placeholder="Insira a nova senha">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input class="input100 pass2" type="password" name="password2" placeholder="Confirme sua senha">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        </div>

                        <button class="btn btn-primary mt-2 w-100 font-weight-bold change-pass">Salvar</button>
                    </form>

                    <div class="text-center p-t-12">
                            <span class="txt1">
                                Voltar
                            </span>
                        <a class="txt2 back-login">
                            ao login.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
{{--<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/tilt.jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/login-script.js') }}"></script>
<script src="{{ asset('assets/js/jquerytoast.js') }}"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<script src="js/main.js"></script>

@if(session('error'))
<script>
    $.toast({
        heading: '<b>Não foi possível realizar o login!</b>',
        showHideTransition : 'slide',  // It can be plain, fade or slide
        bgColor : 'red',
        text: 'Os dados de entrada fornecidos estão incorretos.',
        hideAfter : 8000,
        position: 'top-right',
        textColor: 'white',
        icon: 'warning',
        showHideTransition: 'plain'
    });
</script>
@endif

<script>
    $(".send-code").on('click', function (){
        let email = $(".myEmail").val();

        $.ajax({
            url: "{{ route('enviar-email') }}",
            method: "GET",
            data: { email: email },
            success: function (response) {
                if (response.exist == true){

                    $(".div-recover").fadeOut();
                    $(".div-insert").fadeIn();

                    $.toast({
                        heading: '<b>Código enviado!</b>',
                        showHideTransition: 'slide',
                        bgColor: '#2ecc71',
                        text: 'Enviamos um código para você, verifique sua caixa de e-mail.',
                        hideAfter: 10000,
                        position: 'top-right',
                        textColor: 'white',
                        icon: 'error'
                    });

                    setTimeout(function (){
                        $(".send-code").html('Enviar código');
                        $(".myEmail").val('');
                    }, 2000);
                }else{
                    $(".send-code").html('Enviar código');

                    $.toast({
                        heading: '<b>Preencha corretamente!</b>',
                        showHideTransition: 'slide',
                        bgColor: 'red',
                        text: 'O e-mail inserido não foi encontrado na base de dados.',
                        hideAfter: 7000,
                        position: 'top-right',
                        textColor: 'white',
                        icon: 'error'
                    });
                }
            },
            error: function () {
                console.error("Erro na comunicação com o backend. Entre em contato com o suporte.");
            }
        });
    });


    $('#recover-form').on('submit', function(e) {
        e.preventDefault();

        let code = $(".myCode").val();

        if(code.length < 6){
            $.toast({
                heading: '<b>Código inválido!</b>',
                showHideTransition: 'slide',
                bgColor: 'red',
                text: 'O código enviado ao seu e-mail possui 6 dígitos, verifique o código corretamente.',
                hideAfter: 7000,
                position: 'top-right',
                textColor: 'white',
                icon: 'error'
            });
        }else{
            $.ajax({
                url: "{{ route('alterar-senha') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if(response.status == 'success'){

                        $(".div-recover, .div-insert").fadeOut();

                        setTimeout(function(){
                            $(".div-login").fadeIn();
                        }, 1000)

                        $.toast({
                            heading: '<b>Senha alterada com sucesso!</b>',
                            showHideTransition: 'slide',
                            bgColor: '#2ecc71',
                            text: 'Agora você pode utilizar o sistema com a sua nova senha. Bom trabalho!',
                            hideAfter: 10000,
                            position: 'top-right',
                            textColor: 'white',
                            icon: 'error'
                        });

                    }else{
                        $.toast({
                            heading: '<b>Falha ao alterar senha!</b>',
                            showHideTransition: 'slide',
                            bgColor: 'red',
                            text: response.status,
                            hideAfter: 10000,
                            position: 'top-right',
                            textColor: 'white',
                            icon: 'error'
                        });
                    }
                },
                error: function () {
                    console.error("Erro na comunicação com o backend. Entre em contato com o suporte.");
                }
            });
        }
    });
</script>
</body>
</html>
