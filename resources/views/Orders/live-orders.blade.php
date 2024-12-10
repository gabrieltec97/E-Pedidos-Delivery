@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-2">
                        <h6>Pedidos em tempo real</h6>
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
                                    <th>Alterar Status</th>
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
                            } else if (order.status === 'Em rota de entrega') {
                                badgeClass = 'bg-gradient-primary';
                            } else if (order.status === 'Cancelado') {
                                badgeClass = 'bg-gradient-danger';
                            }

                            tableRows += `
    <tr>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm" style="color: black; cursor: pointer;"
                        data-bs-toggle="modal" data-bs-target="#pedido${order.id}">
                        ${order.client}
                    </h6>
                    <p class="text-xs text-secondary mb-0">${order.neighborhood}</p>
                </div>
            </div>
        </td>
        <td>
            <h5 class="text-xs font-weight-bold mb-0" style="color: black; cursor: pointer;"
                data-bs-toggle="modal" data-bs-target="#pedido${order.id}">
                #${order.id}
            </h5>
        </td>
        <td class="align-middle text-center text-sm">
            <span class="badge badge-sm ${badgeClass}">${order.status}</span>
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">${order.date}</span>
        </td>
        <td class="align-middle">
            <select class="form-select form-select-sm" aria-label="Alterar status do pedido">
                <option value="Novo Pedido" ${order.status === 'Novo Pedido' ? 'selected' : ''}>Novo Pedido</option>
                <option value="Em Preparação" ${order.status === 'Em Preparação' ? 'selected' : ''}>Em Preparação</option>
                <option value="Em rota de entrega" ${order.status === 'Em rota de entrega' ? 'selected' : ''}>Em rota de entrega</option>
                <option value="Cancelado" ${order.status === 'Cancelado' ? 'selected' : ''}>Cancelado</option>
                <option value="Pedido Entregue" ${order.status === 'Pedido Entregue' ? 'selected' : ''}>Pedido Entregue</option>
            </select>
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

                            $.toast({
                                heading: 'Novo pedido!',
                                text: 'Temos um novo pedido registrado!',
                                position: 'top-right',
                                bgColor: 'white',
                                textColor: 'black',
                                stack: false
                            });
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

        //Alteração de status do pedido.
        $(document).on('change', '.form-select', function () {
            const newStatus = $(this).val(); // Novo status selecionado
            const row = $(this).closest('tr'); // Linha atual
            const orderId = row.find('h5').text().trim().replace('#', ''); // ID do pedido sem "#"
            const currentStatus = row.find('.badge').text().trim(); // Status atual do pedido

            // Exibe o modal apenas se o novo status for diferente do atual
            if (newStatus !== currentStatus) {
                const modalHtml = `
            <div class="modal fade" id="confirmStatusChange" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="/atualizar/${orderId}" method="get">
                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="status" value="${newStatus}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Alteração de Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Você está prestes a alterar o status do pedido <strong>#${orderId}</strong> de <strong>${currentStatus}</strong> para <strong>${newStatus}</strong>. Deseja continuar?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        `;

                // Adiciona o modal ao container de modais e exibe
                $('#modals-container').html(modalHtml);
                $('#confirmStatusChange').modal('show');
            }
        });


        // Função para obter a classe do badge com base no novo status
        function getBadgeClass(status) {
            switch (status) {
                case 'Novo Pedido':
                    return 'bg-gradient-success';
                case 'Em Preparação':
                    return 'bg-gradient-warning';
                case 'Em rota de entrega':
                    return 'bg-gradient-primary';
                case 'Cancelado':
                    return 'bg-gradient-danger';
                case 'Pedido Entregue':
                    return 'bg-gradient-info';
                default:
                    return '';
            }
        }
    </script>
@endsection
