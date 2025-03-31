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
                                        <input class="form-control" type="text" name="name" placeholder="Apenas o primeiro nome">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Contato</label>
                                        <input class="form-control" type="text" name="contact" placeholder="Telefone com ddd">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">E-mail</label>
                                        <input class="form-control" name="email" type="email" placeholder="Ex: joao@gmail.com">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Senha</label>
                                        <input class="form-control" type="password" name="password">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Usuário</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user-profile" class="form-control-label">Perfil de usuário</label>
                                        <select name="user_type" id="user-profile" class="form-control">
                                            <option selected disabled>Selecione</option>
                                            <option value="Administrador">Administrador</option>
                                            <option value="Operador">Operador</option>
                                            <option value="Entregador">Entregador</option>
                                        </select>
                                    </div>
                                </div>

{{--                                <div class="col-12">--}}
{{--                                    <label for="profile-photo">Foto de perfil</label><br>--}}
{{--                                    <input type="file" class="form-control" name="profile-photo" id="profile-photo">--}}
{{--                                </div>--}}

                                <div class="col-md-12 d-flex" style="margin-bottom: -20px;">
                                    <button type="button" class="btn btn-primary ms-auto btn-cadastrar" style="margin-top: 10px;"><b><i class="fa-solid fa-user-plus" ></i> Cadastrar usuário</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            $(".btn-cadastrar").on('click', function(){
                $(this).html('<b><span class="spinner-border spinner-border-sm"></span> Cadastrar usuário</b>');

                setTimeout(() => {
                    $(this).html('<b><i class="fa-solid fa-user-plus" ></i> Cadastrar usuário</b>');
                }, 4000);
            });
        });
    </script>
@endsection
