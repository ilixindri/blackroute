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

Route::get('/ctos/{cto}', [\App\Http\Controllers\Controller::class, 'show']);

Route::group(['middleware' => 'throttle:240,1'], function () {
    foreach (Illuminate\Database\Eloquent\Model::getAll() as $key => $Model) {
        $aux = strtolower($Model);
        if (substr($aux, -1, 1) == 's') {
            $route = $aux . 'es';
        } else {
            $route = $aux . 's';
        }
        Route::get("/tests/$route/{var}", [\App\Http\Controllers\Controller::class, 'tests']);
    }
});
