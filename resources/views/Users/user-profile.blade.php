@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid" style="margin-top: -200px;">
        <div class="card shadow-lg mx-4 card-profile-bottom">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="/img/team-1.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $user->firstname }}
                                {{ $user->lastname }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ $user->user_type }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-8">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Login Rápido</label>
                                            <input class="form-control" type="text" name="username" value="{{ $user->username }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">E-mail</label>
                                            <input class="form-control" name="email" type="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nome</label>
                                            <input class="form-control" type="text" name="name" value="{{ $user->firstname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Sobrenome</label>
                                            <input class="form-control" type="text" name="surname" value="{{ $user->lastname }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Senha</label>
                                            <input class="form-control" type="password" name="password" placeholder="Senha já cadastrada">
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Informações geográficas</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Endereço</label>
                                            <input class="form-control" type="text" name="address" value="{{ $user->address }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Cidade</label>
                                            <input class="form-control" name="city" type="text" value="{{ $user->city }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Bairro</label>
                                            <select class="form-control" name="type">
                                                @foreach($neighborhoods as $neighborhood)
                                                    <option value="{{ $neighborhood->name }}" @selected($neighborhood->name ==  $user->$neighborhood )>{{ $neighborhood->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Contato</label>
                                            <input class="form-control" name="contact" type="text">
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

                                    <div class="col-12">
                                        <label for="profile-photo">Foto de perfil</label><br>
                                        <input type="file" class="form-control" name="profile-photo" id="profile-photo">
                                    </div>

                                    <div class="col-md-12 d-flex mt-5">
                                        <button type="submit" class="btn btn-primary btn-sm ms-auto">Salvar alterações</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <img src="/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
                        <div class="row justify-content-center">
                            <div class="col-4 col-lg-4 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                    <a href="javascript:;">
                                        <img src="/img/team-2.jpg"
                                             class="rounded-circle img-fluid border border-2 border-white">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex justify-content-center">
                                        <div class="d-grid text-center">
                                            <span class="text-lg font-weight-bolder">22</span>
                                            <span class="text-sm opacity-8">Pedidos</span>
                                        </div>
                                        <div class="d-grid text-center mx-4">
                                            <span class="text-lg font-weight-bolder">10</span>
                                            <span class="text-sm opacity-8">Avaliações</span>
                                        </div>
                                        <div class="d-grid text-center">
                                            <span class="text-lg font-weight-bolder">89</span>
                                            <span class="text-sm opacity-8">Comments</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <h5>
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </h5>
                                <div class="h6">
                                    <i class="ni business_briefcase-24 mr-2"></i>{{ $user->city }} - {{ $user->neighbourhood }}
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>Cliente desde - {{ $user->created_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
