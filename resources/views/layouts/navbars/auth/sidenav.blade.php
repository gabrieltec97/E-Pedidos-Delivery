@php use Illuminate\Support\Facades\Auth; @endphp
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}"
           target="_blank">
            <img src="{{ asset('img/logos/mylogo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">E-pedidos Delivery</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if(Auth::user()->can('dashboard'))
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                   href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->can('gerenciar pedidos'))
            <li class="nav-item">
                <a class="nav-link dropdown-toggle {{ Route::currentRouteName() == 'produtos.index' ? 'active' : '' }}"
                   id="dropdownOrders" role="button" data-bs-toggle="collapse" data-bs-target="#submenuOrders"
                   aria-expanded="false" aria-controls="submenuOrders">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-bell-concierge text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pedidos</span>
                </a>
                <div class="collapse" id="submenuOrders">
                    <ul class="navbar-nav ms-4">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pedidos.index') }}">
                                <div class="spinner-grow spinner-grow-sm text-danger" style="margin-right: 10px;"
                                     role="status"></div>
                                <span class="nav-link-text ms-1">Tempo Real</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pedidos.historico') }}">
                                <i class="fa-solid fa-clock-rotate-left text-primary ml-0"></i>
                                <span class="nav-link-text ms-1">Histórico de Pedidos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cardapio.index') }}">
                                <i class="fa-solid fa-circle-plus text-primary ml-0"></i>
                                <span class="nav-link-text ms-1">Nova venda</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cupons.index') }}">
                                <i class="fa-solid fa-ticket text-success ml-0"></i>
                                <span class="nav-link-text ms-1">Cupons</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @if(Auth::user()->can('gerenciar itens'))
            <li class="nav-item">
                <a class="nav-link dropdown-toggle {{ Route::currentRouteName() == 'produtos.index' ? 'active' : '' }}"
                   id="dropdownProducts" role="button" data-bs-toggle="collapse" data-bs-target="#submenuProducts"
                   aria-expanded="false" aria-controls="submenuProducts">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-utensils text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Itens</span>
                </a>
                <div class="collapse" id="submenuProducts">
                    <ul class="navbar-nav ms-4">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('produtos.index') }}">
                                <i class="fa-solid fa-database text-success ml-0"></i>
                                <span class="nav-link-text ms-1">Cadastrados</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('adicionais.index') }}">
                                <i class="fa-solid fa-circle-plus text-primary ml-0"></i>
                                <span class="nav-link-text ms-1">Adicionais</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @if(Auth::user()->can('gerenciar bairros'))
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'bairros.index' ? 'active' : '' }}"
                   href="{{ route('bairros.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-house-flag text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Bairros</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->can('gerenciar usuários'))
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}"
                   href="{{ route('usuarios.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Gerenciamento de Usuários</span>
                </a>
            </li>
            @endif
{{--            <li class="nav-item mt-3">--}}
{{--                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pages</h6>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link {{ str_contains(request()->url(), 'tables') == true ? 'active' : '' }}"--}}
{{--                   href="{{ route('page', ['page' => 'tables']) }}">--}}
{{--                    <div--}}
{{--                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Tables</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </div>
</aside>
