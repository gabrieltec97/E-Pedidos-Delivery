@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title')
    Dashboard - Aqui você encontra todas as informações!
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Faturamento de hoje</p>
                                    <h5 class="font-weight-bolder">
                                        R$ {{ $ammount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Estoque</p>
                                    <h5 class="font-weight-bolder">
                                        @if($lowStock != 0)
                                            <a href="{{ route('produtos.index') }}" class="text-danger" style="text-decoration: none;">Verificar estoque</a>

                                            <script>
                                                $.toast({
                                                    heading: '<b>Alerta de estoque!</b>',
                                                    showHideTransition : 'slide',
                                                    bgColor : '#2D2D2D',
                                                    text: '<?= $lowStock > 1 ? 'Temos '. $lowStock . ' itens' : 'Temos '.$lowStock.' item' ?> com baixa quantidade em estoque. Reponha-os antes que eles fiquem indisponíveis no cardápio.',
                                                    hideAfter : 15000,
                                                    position: 'top-right',
                                                    textColor: 'white',
                                                    icon: 'warning',
                                                    showHideTransition: 'plain'
                                                });
                                            </script>
                                        @else
                                            <span style="color: lawngreen">Abastecido</span>
                                        @endif
                                    </h5>

                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total de pedidos</p>
                                    <h5 class="font-weight-bolder">
                                        @if($orders > 1)
                                            {{ $orders }} pedidos
                                        @elseif($orders == 1)
                                            {{ $orders }} pedido
                                        @else
                                            Nenhum pedido.
                                        @endif
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Métricas de venda</h6>
                        <p class="text-sm mb-0">
                        @if($moneyMetrics > 0)
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">+{{$moneyMetrics}}%</span>
                                de lucro superior a ontem!
                            </p>

                            <script>
                                $.toast({
                                    heading: '<b>Parabéns!</b>',
                                    showHideTransition : 'slide',  // It can be plain, fade or slide
                                    bgColor : '#2ecc71',
                                    text: 'Temos {{$moneyMetrics}}% de lucro superior a ontem!',
                                    hideAfter : 10000,
                                    position: 'top-right',
                                    textColor: 'white',
                                    icon: 'success'
                                });
                            </script>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        {{--                        <div class="chart">--}}
                        {{--                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>--}}
                        {{--                        </div>--}}

                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
            @php
                if (request('month') != ''){
                   $selectedMonth = request('month');
                }else{
                   $selectedMonth = $month;
                }

                 if (request('year') != ''){
                   $selectedYear = request('year');
                }else{
                   $selectedYear = $year;
                }
            @endphp
            <div id="metricsDiv" class="col-lg-12 mt-4 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-3 pt-3 bg-transparent d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            @if(request('month') == '')
                                Métricas deste mês
                            @else
                                Métricas do mês de {{ $selectedMonth }}
                            @endif
                        </h4>

                        <div class="d-flex gap-2">
                            <select name="month" class="form-control w-100 month" style="cursor: pointer;">
                                <option value="" selected disabled>Selecione</option>
                                <option value="Janeiro"  @if($selectedMonth == 'Janeiro') selected @endif>Janeiro</option>
                                <option value="Fevereiro" @if($selectedMonth == 'Fevereiro') selected @endif>Fevereiro</option>
                                <option value="Março" @if($selectedMonth == 'Marco') selected @endif>Março</option>
                                <option value="Abril" @if($selectedMonth == 'Abril') selected @endif>Abril</option>
                                <option value="Maio" @if($selectedMonth == 'Maio') selected @endif>Maio</option>
                                <option value="Junho" @if($selectedMonth == 'Junho') selected @endif>Junho</option>
                                <option value="Julho" @if($selectedMonth == 'Julho') selected @endif>Julho</option>
                                <option value="Agosto" @if($selectedMonth == 'Agosto') selected @endif>Agosto</option>
                                <option value="Setembro" @if($selectedMonth == 'Setembro') selected @endif>Setembro</option>
                                <option value="Outubro" @if($selectedMonth == 'Outubro') selected @endif>Outubro</option>
                                <option value="Novembro" @if($selectedMonth == 'Novembro') selected @endif>Novembro</option>
                                <option value="Dezembro" @if($selectedMonth == 'Dezembro') selected @endif>Dezembro</option>
                            </select>

                            <select name="year" class="form-control w-auto year" style="cursor: pointer;">
                                <option value="2023" @if($selectedYear == '2023') selected @endif>2023</option>
                                <option value="2024" @if($selectedYear == '2024') selected @endif>2024</option>
                                <option value="2025" @if($selectedYear == '2025') selected @endif>2025</option>
                            </select>

                            <button class="btn btn-primary buscar" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>

                    <div class="card-body p-3">
                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $chart3->container() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-3">Bairros com mais pedidos</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                            @foreach($totalOrders as $neighboor)
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="./img/icons/flags/US.png" alt="Country flag">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Bairro:</p>
                                                <h6 class="text-sm mb-0">{{ $neighboor['name'] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Pedidos:</p>
                                            <h6 class="text-sm mb-0">{{ $neighboor['total'] }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Faturamento:</p>
                                            <h6 class="text-sm mb-0">R${{ $neighboor['totalValue'] }}</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Porcentagem:</p>
                                            <h6 class="text-sm mb-0">{{ $neighboor['porcentagem'] }}%</h6>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-3">Itens mais vendidos</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @foreach($totalItems as $sold)
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-satisfied text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">{{ $sold['name'] }}</h6>
                                            <span class="text-xs font-weight-bold">{{ $sold['total'] }} vendas este mês</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(request('month'))
        <script>
            $.toast({
                heading: '<b>Dados filtrados com sucesso!</b>',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : '#3b8cde',
                text: '<b>Veja os dados sobre vendas do mês de {{ request('month') }}!</b>', // A mensagem que foi passada via session
                hideAfter : 8000,
                position: 'top-right',
                textColor: 'white',
                icon: 'success'
            });

            //Rola até a div de métricas do mês.
            window.onload = function() {
                // Rola suavemente até a div com o id 'metricsDiv'
                document.getElementById('metricsDiv').scrollIntoView({ behavior: 'smooth' });
            }

        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Mês Selecionado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja recuperar dados sobre <span id="dadosFiltrados"></span>?

                    <form action="{{ route('home') }}" method="get">
                        @csrf
                        <input type="text" hidden="hidden" name="month" id="inputmonth">
                        <input type="text" hidden="hidden" name="year" id="inputyear">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(".buscar").on('click', function (){
            console.log('click');
            $("#dadosFiltrados").text($(".month").val() + ' de ' + $(".year").val());
            $("#inputmonth").val($(".month").val());
            $("#inputyear").val($(".year").val());
        });

    </script>

@endsection


@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
