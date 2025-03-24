<?php

use App\Http\Controllers\AdditionalController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\NeighbourhoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrayController;
use App\Http\Controllers\UserController;
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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/teste', function (){
    echo 'feito';
})->name('teste');

Route::resource('/cardapio', TrayController::class);
Route::get('/count', [TrayController::class, 'count'])->name('cardapio.count');
Route::get('/verificar-bandeja', [TrayController::class, 'count'])->name('tray.check');
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
Route::resource('/pedidos', OrderController::class);

Route::get('log', function (){
    Auth::loginUsingId(5);
});

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
    Route::get('/api/pedidos', [OrderController::class, 'getPedidosJson'])->name('pedidos.json');
    Route::get('/atualizar/{id}', [OrderController::class, 'updateStatus'])->name('update.status');
    Route::get('/entregadores', [UserController::class, 'motoboys']);

});

































Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
//	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
