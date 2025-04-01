@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid" style="margin-top: -200px;">
        <div class="card shadow-lg mx-4 card-profile-bottom">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="/img/logos/user.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm h-75">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $user->firstname }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ $user->user_type }} | {{ $user->created_at }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-3">Editar usuário</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">Informações do usuário</p>
                            <form action="{{ route('usuarios.update', $user->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nome</label>
                                            <input class="form-control" type="text" name="name" value="{{ $user->firstname }}" required>
                                            @error('name')
                                            <span class="text-danger" style="font-size: 13.5px;"><b><i class="fa-solid fa-circle-info"></i> {{ $message }}</b></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Sobrenome</label>
                                            <input class="form-control" type="text" name="surname" autocomplete="off" placeholder="Apenas um sobrenome" value="{{ $user->surname }}" required>
                                            @error('surname')
                                            <span class="text-danger" style="font-size: 13.5px;"><b><i class="fa-solid fa-circle-info"></i> {{ $message }}</b></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Contato</label>
                                            <input class="form-control" id="txtContato" name="contact" type="text" value="{{ $user->contact }}" required>
                                        </div>
                                        @error('contact')
                                        <span class="text-danger" style="font-size: 13.5px;"><b><i class="fa-solid fa-circle-info"></i> {{ $message }}</b></span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">E-mail</label>
                                            <input class="form-control" id="email" name="email" type="email" value="{{ $user->email }}" required>
                                            @error('email')
                                            <span class="text-danger" style="font-size: 13.5px;"><b><i class="fa-solid fa-circle-info"></i> {{ $message }}</b></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Senha</label>
                                            <input class="form-control" type="password" name="password" placeholder="Digite nova senha">
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
                                                <option value="Administrador" @selected($user->user_type == "Administrador")> Administrador</option>
                                                <option value="Operador" @selected($user->user_type == "Operador")>Operador</option>
                                                <option value="Entregador" @selected($user->user_type == "Entregador")>Entregador</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-end mt-5">
                                        <button type="submit" class="btn btn-primary mb-0 btn-cadastrar">Salvar alterações</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                    <a type="button" class="btn btn-success btn-redirect">Ir para usuário</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            $('#txtContato').mask('(00) 0000-00009');

            $(".btn-cadastrar").on('click', function(){
                $(this).html('<b><span class="spinner-border spinner-border-sm"></span> Salvar alterações</b>');

                setTimeout(() => {
                    $(this).html('<b><i class="fa-solid fa-user-plus" ></i> Salvar alterações</b>');
                }, 4000);
            });
        });

        $("#email").on('keyup', function (){
            let email = $(this).val();
            let user = '{{ $user->email }}';

            $.ajax({
                url: '{{ route('verificar-usuario')}}',
                method: "GET",
                data: { email: email, user: user },
                success: function (response) {
                    console.log(response.id);
                    if(response.checkUserId == true){
                        let url = `/usuarios/${response.id}`;
                        $('.btn-cadastrar').prop('disabled', 'true');

                        $(".userEmail").text(email);
                        $("#modalCheck").modal("show");
                        $("#email").val('');
                        $(".btn-redirect").attr("href", url);

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
