@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Gerenciamento de usuários
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <style>
        a:hover {
            color: white; /* Mantém a cor original */
        }
    </style>
    <div class="row mt-4 mx-4">
        <div class="col-12">

            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h3>Gerenciamento de usuários</h3>
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
{{--                                                <div>--}}
{{--                                                    <img src="./img/logos/user.png" style="height: 40px; width: 45px; border-radius: 15px; margin-right: 14px; margin-left: -8px;" alt="image">--}}
{{--                                                </div>--}}
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
                                                    <a href="{{ route('usuarios.show', $user->id) }}" title="Editar" style="cursor: pointer; border: none; margin-right: 15px" class="badge badge-sm bg-gradient-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <a title="Deletar" style="cursor: pointer; border: none;" class="badge badge-sm bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $user->id }}"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>


                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDelete{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><b>Atenção!</b></h5>
                                                    <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tem certeza que deseja excluir o usuário <b>{{ $user->firstname }}</b>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('usuarios.destroy', $user->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-deletar"><b>Deletar usuário</b></button>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
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
                bgColor : '#2D2D2D',
                hideAfter : 5000,
                position: 'top-right',
                textColor: 'white',
                icon: 'success'
            });
        </script>
    @endif

    @if(session('msg-del'))
        <script>
            $.toast({
                heading: '<b>Usuário deletado com sucesso!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : '#2D2D2D',
                hideAfter : 5000,
                position: 'top-right',
                textColor: 'white',
                icon: 'success'
            });
        </script>
    @endif

    @if(session('msg-upd'))
        <script>
            $.toast({
                heading: '<b>Alterações realizadas com sucesso!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : '#2D2D2D',
                hideAfter : 5000,
                position: 'top-right',
                textColor: 'white',
                icon: 'success'
            });
        </script>
    @endif

    <script>
        $(".btn-deletar").on('click', function(){
            $(this).html('<b><span class="spinner-border spinner-border-sm"></span> Deletar usuário</b>');
        });
    </script>
@endsection

