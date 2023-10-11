<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//cliente
Route::get('/Users','App\Http\Controllers\ClienteController@index');
Route::post('/Clientes','App\Http\Controllers\ClienteController@store');
Route::get('/Clientes/{cliente}','App\Http\Controllers\ClienteController@show');
Route::put('/Clientes/{cliente}','App\Http\Controllers\ClienteController@update');
Route::delete('/Clientes/{cliente}','App\Http\Controllers\ClienteController@destroy');

//servicios
Route::get('/Servicios','App\Http\Controllers\ServiciosController@index');
Route::post('/ServicioAdd','App\Http\Controllers\ServiciosController@store');
Route::get('/Servicios/{id}','App\Http\Controllers\ServiciosController@show');
Route::put('/Servicios/{id}','App\Http\Controllers\ServiciosController@update');
Route::delete('/Servicios/{id}','App\Http\Controllers\ServiciosController@destroy');

Route::post('/Clientes/servicio','App\Http\Controllers\ClienteController@attach');
Route::post('/Clientes/servicio/detach','App\Http\Controllers\ClienteController@detach');

Route::post('/Boletos','App\Http\Controllers\ServiciosController@pivot');

Route::post('/Servicios/Clientes','App\Http\Controllers\ServiciosController@clientes');

Route::post('Registro',[AuthController::class,'register']);
Route::post('Login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('Logout',[AuthController::class,'logout']);
});
