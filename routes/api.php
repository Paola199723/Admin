<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\DataAddressController;
use App\Http\Controllers\DataBusinessController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

route::post( '/user/data-user/{id}', [DataUserController::class, 'EditDataUser']);
//editar datos de la empresa
route::post( '/user/data-address/{id}',[DataAddressController::class, 'EditDataAddress']);
// productos posee un crud, crear editar, borrar y buscar.
route::post( '/user/data-address/{id}',[ProductController::class, 'create']);

// cajero puede listar productos, y seleccionar productos.
route::post( '/user/data-address/{id}',[CashierController::class, 'create']);
// registra la venta, listar los productos seleccionados. litar la ventaas por usuario, 
route::post( '/user/data-address/{id}',[SaleController::class, 'create']);


// autenticacion del usuario
Route::group(['middleware' => ['jwt.verify']], function() {
   // Route::post('user','App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::post('/user', [UserController::class, 'getAuthenticatedUser']);
    //editar datos de los usuarios
  
});
//registro del usuario
Route::post('/register', [UserController::class, 'register']);
//inicio de sesion
Route::post('/login', [UserController::class, 'authenticate']);
//Route::post('register', 'App\Http\Controllers\UserController@register');

//Route::post('/login', 'App\Http\Controllers\UserController@authenticate');
