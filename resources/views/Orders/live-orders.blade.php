@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Authors table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="tabela-pedidos" class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>ID do Pedido</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- As linhas serão preenchidas dinamicamente -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Container para os modais -->
                        <div id="modals-container">
                            <!-- Os modais serão inseridos dinamicamente aqui -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let isModalOpen = false; // Variável para rastrear se um modal está aberto
            let lastOrderCount = 0; // Contagem de pedidos da última atualização

            function fetchPedidos() {
                if (isModalOpen) {
                    return; // Não atualiza a tabela se um modal estiver aberto
                }

                $.ajax({
                    url: '/api/pedidos',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        let tableRows = '';
                        let modals = '';

                        data.forEach(function (order) {
                            let badgeClass = '';

                            if (order.status === 'Novo Pedido') {
                                badgeClass = 'bg-gradient-success';
                            } else if (order.status === 'Em Preparação') {
                                badgeClass = 'bg-gradient-warning';
                            } else if (order.status === 'Saiu para entrega') {
                                badgeClass = 'bg-gradient-primary';
                            } else if (order.status === 'Cancelado') {
                                badgeClass = 'bg-gradient-danger';
                            }

                            tableRows += `
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">${order.client}</h6>
                                    <p class="text-xs text-secondary mb-0">${order.neighborhood}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h5 class="text-xs font-weight-bold mb-0">#${order.id}</h5>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm ${badgeClass}">${order.status}</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">${order.date}</span>
                        </td>
                        <td class="align-middle">
                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                               data-bs-toggle="modal" data-bs-target="#pedido${order.id}">
                                Detalhes
                            </a>
                        </td>
                    </tr>
                `;

                            let items = order.items.split(',');
                            let itemsList = items.map(item => `<li>${item}</li>`).join('');

                            modals += `
                    <div class="modal fade" id="pedido${order.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Dados do pedido</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="text-xs text-secondary mb-0">${order.date}</p>
                                        <p class="text-xs text-secondary mb-0">#${order.id}</p>
                                        <hr>
                                        <ul>
                                            ${itemsList}
                                        </ul>
                                        <hr>
                                        <h5 class="mb-0 text-sm">${order.address}</h5>
                                        <p class="text-xs text-secondary mb-0">${order.neighborhood}</p>
                                        <p class="text-xs text-success mb-0">${order.client}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                        });

                        $('#tabela-pedidos tbody').html(tableRows);
                        $('#modals-container').html(modals);

                        // Verifica se houve novos pedidos
                        if (data.length > lastOrderCount) {
                            // Toca o som de novo pedido
                            const audio = new Audio('/sounds/notification.mp3');
                            audio.play();
                        }

                        // Atualiza a contagem de pedidos
                        lastOrderCount = data.length;
                    },
                    error: function (xhr, status, error) {
                        console.error("Erro ao buscar pedidos:", error);
                    }
                });
            }

            // Evento disparado ao abrir qualquer modal
            $(document).on('show.bs.modal', '.modal', function () {
                isModalOpen = true; // Marca como modal aberto
            });

            // Evento disparado ao fechar qualquer modal
            $(document).on('hidden.bs.modal', '.modal', function () {
                isModalOpen = false; // Marca como modal fechado
            });

            // Atualiza os pedidos a cada 10 segundos
            setInterval(fetchPedidos, 10000);

            // Carrega os pedidos na inicialização
            fetchPedidos();
        });

    </script>
@endsection
