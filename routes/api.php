<?php

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
Route::group(['prefix' => 'cotacao'], function () {
    Route::get('', [\App\Http\Controllers\CotacaoController::class, 'index']);
    Route::put('', [\App\Http\Controllers\CotacaoController::class, 'imposto']);
    Route::post('', [\App\Http\Controllers\CotacaoController::class, 'store']);
});

Route::group(['prefix' => 'transportadoras'], function () {
   Route::get('', [\App\Http\Controllers\TransportadoraController::class, 'index']);
});

