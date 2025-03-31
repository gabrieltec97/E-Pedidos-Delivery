@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Novo usuário
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4 mt-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pt-4">
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Novo usuário</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Informações do usuário</p>
                        <form action="{{ route('usuarios.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome e sobrenome</label>
                                        <input class="form-control" type="text" name="name" autocomplete="off" placeholder="Apenas o primeiro nome" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Contato</label>
                                        <input class="form-control" id="txtContato" type="text" autocomplete="off" name="contact" placeholder="Telefone com ddd" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">E-mail</label>
                                        <input class="form-control" id="email" name="email" type="email" autocomplete="off" placeholder="Ex: joao@gmail.com" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Senha</label>
                                        <input class="form-control" type="password" name="password" required>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Usuário</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user-profile" class="form-control-label">Perfil de usuário</label>
                                        <select name="user_type" id="user-profile" class="form-control" required>
                                            <option value="Operador" selected>Operador</option>
                                            <option value="Entregador">Entregador</option>
                                            <option value="Administrador">Administrador</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 d-lg-flex" style="margin-bottom: -20px;">
                                    <button type="submit" class="btn btn-primary ms-auto btn-cadastrar" style="margin-top: 10px;"><b><i class="fa-solid fa-user-plus" ></i> Cadastrar usuário</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCheck" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">E-mail duplicado</h5>
                    <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <p>O e-mail <span class="userEmail font-weight-bold"></span> já está cadastrado no sistema para outro usuário. Por favor use outro e-mail ou verifique o usuário existente.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Continuar cadastro</button>
                    <button type="button" class="btn btn-success">Ir para usuário</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            $('#txtContato').mask('(00) 0000-00009');

            $(".btn-cadastrar").on('click', function(){
                $(this).html('<b><span class="spinner-border spinner-border-sm"></span> Cadastrar usuário</b>');

                setTimeout(() => {
                    $(this).html('<b><i class="fa-solid fa-user-plus" ></i> Cadastrar usuário</b>');
                }, 4000);
            });
        });

        $("#email").on('keyup', function (){
            let email = $(this).val();

            $.ajax({
                url: '{{ route('verificar-usuario')}}',
                method: "GET",
                data: { email: email },
                success: function (response) {

                    if(response.check == true){
                        $('.btn-cadastrar').prop('disabled', 'true');

                        $(".userEmail").text(email);
                        $("#modalCheck").modal("show");
                        $("#email").val('');

                    }else{
                        $('.btn-cadastrar').removeAttr('disabled');
                    }
                },
                error: function () {
                    console.error("Erro ao verificar usuário");
                }
            });
        });
    </script>
@endsection
