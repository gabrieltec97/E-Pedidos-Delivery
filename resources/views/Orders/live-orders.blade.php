@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Pedidos'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tabela de Pedidos</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="tabela-pedidos" class="table">
                                <!-- Dados serão preenchidos pelo AJAX -->
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function fetchPedidos() {
                $.ajax({
                    url: '/api/pedidos', // URL da rota que retorna JSON
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); // Verificar no console o retorno
                        $('#tabela-pedidos').empty(); // Limpa a tabela antes de atualizar

                        data.forEach(function(order) {
                            $('#tabela-pedidos').append(`
                        <tr>
                            <td>${order.cliente}</td>
                            <td>${order.id}</td>
                            <td>${order.status}</td>
                            <td>${order.date}</td>
                        </tr>
                    `);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro ao buscar pedidos:", error);
                    }
                });
            }

            // Atualiza a tabela a cada 10 segundos
            setInterval(fetchPedidos, 10000);

            // Carrega os pedidos na inicialização
            fetchPedidos();
        });

    </script>
@endsection
