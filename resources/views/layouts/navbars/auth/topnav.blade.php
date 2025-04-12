<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}" id="navbarBlur"
        data-scroll="false">
    <div class="container-fluid py-1 px-3">
       {{-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Gestão de cardápio</h6>
        </nav>--}}
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            @php
               $time = date('H');
               $user = \Illuminate\Support\Facades\Auth::user();
               $notifications = \App\Models\Notification::all();
               $delivery = DB::table('delivery_status')->where('id', 1)->get();
            @endphp
                @if ($time>= 18 && $time < 24)
                    <span class="text-white" style="margin-right: -17px;"><b>Boa noite, {{ $user->firstname }}</b></span>
                @elseif($time>= 6 && $time < 12)
                    <span class="text-white" style="margin-right: -17px;"><b>Bom dia, {{ $user->firstname }}</b></span>
                @elseif($time>= 12 && $time < 18)
                    <span class="text-white" style="margin-right: -17px;"><b>Boa tarde, {{ $user->firstname }}</b></span>
                @endif
            </div>
            <ul class="navbar-nav d-flex justify-content-end">
                <!--<li class="nav-item d-flex align-items-center">
                    <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="nav-link text-white font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Log out</span>
                        </a>
                    </form>
                </li> -->
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                        @if(count($notifications) > 0)
                            <span class="notification-count">{{ count($notifications) }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        @if(count($notifications) == 0)
                            <h6 class="d-flex justify-content-center">Sem Notificações</h6>
                            <i class="fa fa-thumbs-up d-flex justify-content-center text-primary" style="font-size: 20px;"></i>
                        @endif
                        @foreach($notifications as $verification)
                            @if($verification->type == 'Verificação')
                                <li class="mb-2 check-stock">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <i class="fa fa-bolt text-warning me-3 notification-warning" style="font-size: 35px;"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">{{ $verification->title }}</span>
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $verification->content }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <hr>
                            @endif
                        @endforeach

                        @foreach($notifications as $notification)
                            @if($notification->type != 'Verificação')
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <i class="fa
                                                @if($notification->type == 'Desativação')
                                                fa-exclamation-circle
                                                text-danger
                                                @elseif($notification->type == 'Inativação')
                                                fa-exclamation-triangle
                                                text-success
                                                @endif
                                                me-3 notification-warning" style="font-size: 35px;">

                                                </i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">{{ $notification->title }}</span>
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $notification->content }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>

        @if($delivery[0]->status)
            <div title="Delivery Online" style="width: 20px; height: 20px; background-color: #03ce6f; border-radius: 50px; margin-left: 5px; cursor: pointer;"></div>
        @else
            <div title="Delivery Offline" style="width: 20px; height: 20px; background-color: #e40606; border-radius: 50px; margin-left: 5px; cursor: pointer;"></div>
        @endif
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkStock = document.querySelector('.check-stock');

        if (checkStock) {
            checkStock.addEventListener('click', function () {
                window.location.href = "{{ route('produtos.index') }}";
            });
        }
    });
</script>

<style>
    .notification-count {
        margin-left: 5px;
        background-color: red;
        color: white;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 50%;
    }
</style>
<!-- End Navbar -->
