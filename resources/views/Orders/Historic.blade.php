@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title')
    Histórico de Pedidos
@endsection

<link rel="stylesheet" href="{{asset('assets/css/historic.css')}}">

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-2">
                        <h3 class="text-black">Histórico de pedidos</h3>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @livewire('search-orders')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



