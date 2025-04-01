@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Editar bairro - {{ $neighbourhood->name }}
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h3 class="mb-4">{{ $neighbourhood->name }}</h3>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modaldelete" class="btn btn-danger btn-sm ms-auto font-weight-bold">Deletar bairro</button>
                            </div>
                        </div>
                        <form action="{{ route('bairros.update', $neighbourhood->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                        <div class="card-body">
                            <p class="text-sm">Edite este bairro anteriormente cadastrado</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <input class="form-control name" type="text" name="name" value="{{ $neighbourhood->name }}" required>
                                        @error('name')
                                        <span class="text-danger" style="font-size: 13.5px;"><b><i class="fa-solid fa-circle-info"></i> {{ $message }}</b></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Taxa de entrega</label>
                                        <input class="form-control value" type="text" name="taxe" value="{{ $neighbourhood->taxe }}" required>
                                        @error('taxe')
                                        <span class="text-danger" style="font-size: 13.5px;"><b><i class="fa-solid fa-circle-info"></i> {{ $message }}</b></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tempo médio de entrega</label>
                                        <select class="form-control" name="time">
                                            <option selected disabled>Selecione</option>
                                            <option value="20min a 40min" @selected($neighbourhood->time == "20min a 40min")>20min a 40min</option>
                                            <option value="40min a 60min" @selected($neighbourhood->time == "40min a 60min")>40min a 60min</option>
                                            <option value="1hora a 1h e 20min" @selected($neighbourhood->time == "1hora a 1h e 20min")>1hora a 1h e 20min</option>
                                            <option value="1h e 20min a 1h e 40min" @selected($neighbourhood->time == "1h e 20min a 1h e 40min")>1h e 20min a 1h e 40min</option>
                                            <option value="1h e 40min a 2h" @selected($neighbourhood->time == "1h e 40min a 2h")>1h e 40min a 2h</option>
                                            <option value="Acima de 2 horas" @selected($neighbourhood->time == "Acima de 2 horas")>Acima de 2 horas</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" @checked($neighbourhood->is_available)>
                                        <label for="available">Atendendo agora</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-4 d-flex" style="margin-bottom: -20px;">
                                    <button class="btn btn-success btn-sm ms-auto font-weight-bold btn-cadastrar">Salvar alterações</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


  <!-- Modal -->
  <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
            <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
        </div>
        <div class="modal-body">
            <form action="{{ route('bairros.destroy', $neighbourhood->id) }}" method="post">
                @csrf
                @method('DELETE')
                <p>Tem certeza que deseja deletar o bairro <b>{{$neighbourhood->name}}</b>?</p>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-danger btn-remove">Deletar bairro</button>
        </form>
        </div>
      </div>
    </div>
  </div>

    <script>
       $(document).ready(function(){
           $('.value').mask('000.000.000.000.000.00', {reverse: true});
           function verificarBairro(){
               let local = $(".name").val();
               let id = {{ $neighbourhood->id}}
               $.ajax({
                   url: '{{ route('verificar-bairro')}}',
                   method: "GET",
                   data: { local: local, id: id },
                   success: function (response) {

                       $('.btn-cadastrar').prop('disabled', 'true');

                       if(response.return == true && response.name != local){
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
           }

           $(".name").blur(function(){
               verificarBairro();
           });

           $(".btn-cadastrar").on('click', function(){
               $(this).html('<b><span class="spinner-border spinner-border-sm"></span> Salvar Alterações</b>');

               setTimeout(() => {
                   $(this).html('<b>Salvar Alterações</b>');
               }, 4000);
           });

           $(".btn-remove").on('click', function(){
               $(this).html('<b><span class="spinner-border spinner-border-sm"></span> Deletar bairro</b>');
           });
       });
    </script>
@endsection
