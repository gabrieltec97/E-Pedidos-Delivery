@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Adicionais')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex">
                        <h4>Adicionais Cadastrados</h4>

                        <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalCadastro"><i class="fa-solid fa-plus"></i> Novo Adicional</button>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nome</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Valor</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aplicação</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ação</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach($registereds as $registered)
                                            <tr>
                                            <td class="align-middle text-center text-sm">
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm font-weight-bold"  style="color: black; text-decoration: none;">{{ $registered->name }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $registered->price }}</td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm font-weight-bold"  style="color: black; text-decoration: none;">{{ $registered->type }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($registered->is_available == true)
                                                    <span class="badge badge-sm bg-gradient-success" style="cursor: pointer;" title="Entregas disponíveis para este bairro">Disponível</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger" style="cursor: pointer;" title="Bairro não atendido hoje">Indisponível</span>
                                                @endif
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
    </div>

    <!-- Modal de novo cupom-->
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastro" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('adicionais.store') }}" method="post">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar adicional</h5>
                    <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <div class="row">
                                <p class="text-sm">Cadastre um novo adicional para incrementar os itens do seu cardápio.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nome</label>
                                            <input class="form-control" type="text" placeholder="Nome do adicional" name="name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Valor</label>
                                            <input class="form-control" type="text" name="price" placeholder="Valor do adicional.">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Aplicação em</label>
                                            <select class="form-control" name="type">
                                                <option selected disabled>Selecione</option>
                                                <option value="Comida">Comida</option>
                                                <option value="Bebida">Bebida</option>
                                                <option value="Sobremesa">Sobremesa</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Checkboxes para opções -->
                                    <div class="col-md-6 mt-3" id="checkbox-container">
                                        <!-- As opções aparecerão dinamicamente aqui -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="checkbox" name="is_available" id="available" style="margin-top: 45px;" checked>
                                            <label for="available">Disponível para uso.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Inclua o jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Variáveis de opções em PHP
            var foods = <?php echo json_encode($foods); ?>; // Exemplo: ["Pizza", "Hambúrguer", "Salada"]
            var drinks = <?php echo json_encode($drinks); ?>; // Exemplo: ["Refrigerante", "Suco", "Água"]
            var desserts = <?php echo json_encode($desserts); ?>; // Exemplo: ["Sorvete", "Bolo", "Pudim"]

            // Monitorar alterações no select
            $('#type-select').on('change', function () {
                var selectedType = $(this).val(); // Valor selecionado
                var container = $('#checkbox-container'); // Contêiner para os checkboxes
                container.empty(); // Limpa o contêiner antes de adicionar novas opções

                var options = []; // Array para armazenar as opções
                if (selectedType === "Comida") {
                    options = foods;
                } else if (selectedType === "Bebida") {
                    options = drinks;
                } else if (selectedType === "Sobremesa") {
                    options = desserts;
                }

                // Gerar checkboxes dinamicamente
                if (options.length > 0) {
                    options.forEach(function (item) {
                        container.append(`
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="${selectedType.toLowerCase()}[]" value="${item}" id="${item}">
                            <label class="form-check-label" for="${item}">${item}</label>
                        </div>
                    `);
                    });
                }
            });
        });
    </script>
@endsection
