@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<style>
    .product-data{
    flex: 1;
    margin-left: -190px;

    }

    .resume-product-quantity {
    color: var(--color-black);
    font-size: 10px;
    margin-bottom: 0;
}

.tray-item{
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--color-separate);
}

.product-img{
    width: 30%;
    border-radius: 11px;
}

</style>

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Histórico de pedidos</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @livewire('search-orders')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



