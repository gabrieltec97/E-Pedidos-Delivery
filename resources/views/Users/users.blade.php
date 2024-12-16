@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">

            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Gerenciamento de usuários</h6>
                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary ms-auto"><i class="fa-solid fa-user-plus"></i> Novo usuário</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Usuário</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Data de criação</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div>
                                                    <img src="./img/team-1.jpg" class="avatar me-3" alt="image">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0">{{ $user->firstname }}</h6>
                                                    <p class="mb-0 text-sm">{{ $user->lastname }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->user_type }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->created_at }}</p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <form action="{{ route('usuarios.show', $user->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button title="Editar" type="submit" style="cursor: pointer; border: none; margin-right: 15px" class="badge badge-sm bg-gradient-success"><i class="fa-solid fa-pen-to-square"></i></button>
                                                </form>
                                                <form action="{{ route('usuarios.destroy', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Deletar" style="cursor: pointer; border: none;" class="badge badge-sm bg-gradient-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('msg-success'))
        <script>
            $.toast({
                heading: '<b>Cadastro realizado com sucesso!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : '#2ecc71',
                hideAfter : 5000,
                position: 'top-right',
                textColor: 'white',
                icon: 'success'
            });
        </script>
    @endif
@endsection

