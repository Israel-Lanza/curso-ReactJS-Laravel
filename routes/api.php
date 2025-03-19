<?php

use App\Http\Controllers\Api\Admin\CategoriaController;
use App\Http\Controllers\Api\Admin\EmpresaController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Client\EmpresaController as EmpresaClient;
use App\Http\Controllers\Api\FrontController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function (){
    //Rutas publicas (No necesitan autenticacion)
    //::public
    Route::get('/public/{slug}', [FrontController::class, 'categoria']);
    //::auth
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

   
   
    //Rutas privadas
    Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    //::rol cliente
    Route::apiResource('/client/empresa', EmpresaClient::class)->middleware('auth:sanctum');

    //::rol admin
    Route::apiResource('/admin/empresa', EmpresaController::class)->middleware('auth:sanctum');
    Route::apiResource('/admin/user', UserController::class)->middleware('auth:sanctum');
    Route::apiResource('/admin/categoria', CategoriaController::class)->middleware('auth:sanctum');

});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

