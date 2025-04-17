<?php

use App\Http\Controllers\AdditionalController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\NeighbourhoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrayController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use Illuminate\Support\Str;


Route::get('log', function (){
    Auth::loginUsingId(5);
});


Route::get('cad', function (){

});

//Rotas de login no sistema.
Route::get('/gerent', [LoginController::class, 'show'])->name('login');
Route::post('/login-do', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/', [TrayController::class, 'index'])->name('cardapio-principal');

//Rotas de administração do sistema
Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['role:Administrador'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
        Route::resource('/usuarios', UserController::class);
    });

    Route::middleware(['role:Administrador|Operador'])->group(function () {
        Route::post('/aplicar-cupom', [CouponController::class, 'apply'])->name('aplicar-cupom');
        Route::get('remover-cupom', [CouponController::class, 'remove'])->name('remover-cupom');
        Route::view('/historicoDePedidos', 'Orders.Historic')->name('pedidos.historico');
        Route::resource('/produtos', ProductController::class);
        Route::resource('/cupons', CouponController::class);
        Route::resource('/bairros', NeighbourhoodController::class);
        Route::resource('/adicionais', AdditionalController::class);
        Route::resource('/pedidos', OrderController::class);
        Route::get('/api/pedidos', [OrderController::class, 'getPedidosJson'])->name('pedidos.json');
        Route::get('/atualizar/{id}', [OrderController::class, 'updateStatus'])->name('update.status');
        Route::get('/entregadores', [UserController::class, 'motoboys']);

    });
});

//Rotas do cardápio.
Route::resource('/cardapio', TrayController::class);
Route::get('/count', [TrayController::class, 'count'])->name('cardapio.count');
Route::get('/verificar-bandeja', [TrayController::class, 'count'])->name('tray.check');
Route::get('/pedido-tempo-real', [TrayController::class, 'realTimeOrders'])->name('orders.realTime');
Route::get('/calcular-frete', [TrayController::class, 'taxeCalculator'])->name('calcular-frete');
Route::get('/atualizar-bandeja', [TrayController::class, 'refreshTray'])->name('tray.data');
Route::post('/remover-item', [TrayController::class, 'removeItem'])->name('tray.remove');
Route::post('/atualizar-quantidade', [TrayController::class, 'refreshAmmount'])->name('atualizar-quantidade');
Route::post('/adicionar-pagamento', [TrayController::class, 'addPaymentMode'])->name('adicionar-pagamento');
Route::get('/recuperar-preco', [TrayController::class, 'findPrice'])->name('price.data');
Route::post('/capturar-endereco', [TrayController::class, 'trackAddress'])->name('capturar-endereco');
Route::get('/recuperar-endereco', [TrayController::class, 'findData'])->name('recuperar-endereco');
Route::post('/verificar-cupom', [TrayController::class, 'checkCoupon'])->name('verificar-cupom');
Route::get('/removerCupom', [TrayController::class, 'removeCoupon'])->name('removerCupom');
Route::get('/verificar-nome-cupom', [CouponController::class, 'checkCouponName'])->name('verificarNomeCupom');
Route::get('revisar-pedido', [OrderController::class, 'review'])->name('review');
Route::post('/gerenciar-delivery', [OrderController::class, 'deliveryManagement'])->name('deliveryManagement');
Route::get('/verificar-delivery', [OrderController::class, 'verificarDelivery'])->name('verificarDelivery');
Route::get('/novo-pedido', [OrderController::class, 'storeOrder'])->name('novo-pedido');
Route::get('/verificar-nome-produto', [ProductController::class, 'checkProductName'])->name('verificarNomeProduto');
Route::get('/verificar-bairro', [NeighbourhoodController::class, 'checkNeighbourhood'])->name('verificar-bairro');
Route::get('/verificar-usuario', [UserController::class, 'checkUser'])->name('verificar-usuario');
Route::get('/recuperar-senha', [EmailController::class, 'sendMail'])->name('enviar-email');
Route::post('/alterar-senha', [UserController::class, 'changePassword'])->name('alterar-senha');


//Rotas de redirecionamento.
Route::get('/login', function () {return redirect('/');});
Route::get('/home', function () {return redirect('/pedidos');})->middleware('auth');



































