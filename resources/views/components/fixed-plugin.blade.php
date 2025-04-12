<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">E-Pedidos Delivery</h5>
                <p>Veja suas opções de configuração</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
{{--        <hr class="horizontal dark my-1">--}}
        <div class="card-body pt-sm-3 pt-0 overflow-auto">

            <div class="mt-2 mb-5 d-flex">
                <h6 class="mb-0">Funcionamento do Delivery</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input" type="checkbox" role="switch" id="delivery">
                </div>
            </div>

            <div class="col-12">
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a class="btn btn-primary w-100" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link text-white font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Encerrar Sessão</span>
                    </a>
                </form>
                
            </div>

{{--            <!-- Sidebar Backgrounds -->--}}
{{--            <div>--}}
{{--                <h6 class="mb-0">Sidebar Colors</h6>--}}
{{--            </div>--}}
{{--            <a href="javascript:void(0)" class="switch-trigger background-color">--}}
{{--                <div class="badge-colors my-2 text-start">--}}
{{--                    <span class="badge filter bg-gradient-primary active" data-color="primary"--}}
{{--                        onclick="sidebarColor(this)"></span>--}}
{{--                    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>--}}
{{--                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>--}}
{{--                    <span class="badge filter bg-gradient-success" data-color="success"--}}
{{--                        onclick="sidebarColor(this)"></span>--}}
{{--                    <span class="badge filter bg-gradient-warning" data-color="warning"--}}
{{--                        onclick="sidebarColor(this)"></span>--}}
{{--                    <span class="badge filter bg-gradient-danger" data-color="danger"--}}
{{--                        onclick="sidebarColor(this)"></span>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--            <!-- Sidenav Type -->--}}
{{--            <div class="mt-3">--}}
{{--                <h6 class="mb-0">Sidenav Type</h6>--}}
{{--                <p class="text-sm">Choose between 2 different sidenav types.</p>--}}
{{--            </div>--}}
{{--            <div class="d-flex">--}}
{{--                <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"--}}
{{--                    onclick="sidebarType(this)">White</button>--}}
{{--                <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"--}}
{{--                    onclick="sidebarType(this)">Dark</button>--}}
{{--            </div>--}}
{{--            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>--}}
{{--            <!-- Navbar Fixed -->--}}
{{--            <div class="d-flex my-3">--}}
{{--                <h6 class="mb-0">Navbar Fixed</h6>--}}
{{--                <div class="form-check form-switch ps-0 ms-auto my-auto">--}}
{{--                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"--}}
{{--                        onclick="navbarFixed(this)">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <hr class="horizontal dark my-sm-4">--}}
{{--            <div class="mt-2 mb-5 d-flex">--}}
{{--                <h6 class="mb-0">Light / Dark</h6>--}}
{{--                <div class="form-check form-switch ps-0 ms-auto my-auto">--}}
{{--                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"--}}
{{--                        onclick="darkMode(this)">--}}
{{--                </div>--}}
{{--            </div>--}}
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <i class="fa-solid fa-circle-xmark" style="cursor: pointer; color: #ef4444;" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
            <form action="{{ route('deliveryManagement') }}" method="post">
                @csrf
                    <p>Tem certeza que deseja <span class="status"></span> o delivery? <span class="consequences"></span></p>
                    <input type="number" class="statusApi" name="status" hidden>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn lblDelivery"></button>
            </div>
            </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#delivery').on('change', function() {
            let isChecked = $(this).is(':checked');

            // Define o texto do modal de acordo com o estado do switch
            let statusText = isChecked ? 'ativar' : 'desativar';
            let modalTitle = isChecked ? 'Abrir delivery' : 'Fechar delivery';
            let consequencesText = isChecked ? 'Isso permitirá que os pedidos online comecem a chegar, certifique-se de que está tudo preparado para receber os pedidos.' : 'Isso desativará pedidos online e não chegarão novos pedidos enquanto o delivery estiver offline.';
            let lblDelivery = isChecked ? 'Ativar delivery' : 'Desativar delivery';
            let deliveryStatus = isChecked ? '1' : '0';

            if (statusText == 'ativar'){
                $(".lblDelivery").addClass('btn-success')
            }else{
                $(".lblDelivery").addClass('btn-danger')
            }

            // Atualiza o modal
            $('.modal-title').text(modalTitle);
            $('.status').text(statusText);
            $('.consequences').text(consequencesText);
            $('.lblDelivery').text(lblDelivery);
            $('.statusApi').val(deliveryStatus);

            // Exibe o modal
            $('#modalStatus').modal('show');
        });

        $.ajax({
            url: '{{ route('verificarDelivery') }}',
            method: "GET",
            success: function (response) {
                $('#delivery').prop('checked', response.status == 1);
            },
            error: function () {
                $.toast({
                    heading: '<b>Falha no delivery!</b>',
                    showHideTransition : 'slide',
                    bgColor : '#ec0606',
                    text: 'Não conseguimos buscar o status do delivery. Entre em contato com o suporte!',
                    hideAfter : 10000,
                    position: 'top-right',
                    textColor: 'white',
                    icon: 'success'
                });
            }
        });

        $(".lblDelivery").on('click', function (){
            let myText = $(this).text();
            $(this).html('<span class="spinner-border spinner-border-sm"></span> &nbsp;' + myText);
        });
    });
</script>
