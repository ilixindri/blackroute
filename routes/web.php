<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Livewire\Clientes;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () { return view('welcome'); });
Route::get('/', function () { return redirect()->route('login'); });
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::group(['middleware' => 'auth'], function () {
    Route::resources([
        'clients' => \App\Http\Controllers\ClientController::class,
        'tasks' => \App\Http\Controllers\TasksController::class,
        'users' => \App\Http\Controllers\UsersController::class,
        'bankings' => \App\Http\Controllers\Banking\Controller::class,
        'banking-carnets' => \App\Http\Controllers\Banking\CarnetController::class,
        'banking-billets' => \App\Http\Controllers\Banking\BilletController::class,
    ]);
});

// JETSTREAM LIVEWIRE
// Route::get('/clientes/', [\App\Http\Livewire\Clientes\Listar::class, '__invoke'])->name('clientes.index');
// Route::get('/clientes/', [\App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.index');
// Route::get('/clientes/create', [\App\Http\Livewire\Clientes\Novo::class, '__invoke'])->name('clientes.create');
// Route::get('/clientes/{cliente}', [\App\Http\Livewire\Clientes\Editar::class, '__invoke'])->name('clientes.edit');
// Route::get('/clients/', [\App\Http\Livewire\Clientes\Listar::class, '__invoke'])->name('clients.index');
