<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;


Route::get('/clientes', [Controller::class, 'index']);
Route::post('/cliente', [Controller::class, 'store']);
Route::get('/cliente/{id}', [Controller::class, 'show']);
Route::put('/cliente/{id}', [Controller::class, 'update']);
Route::delete('/cliente/{id}', [Controller::class, 'destroy']);
Route::post('/endereco/{id}', [Controller::class, 'storeAddress']);
Route::put('/endereco/{idUser}/{idAddress}', [Controller::class, 'updateAddress']);
Route::delete('/endereco/{idUser}/{idAddress}', [Controller::class, 'destroyAddress']);

Route::get('/ctos/{cto}', [\App\Http\Controllers\CtoController::class, 'show']);
