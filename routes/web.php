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
//        'clients' => \App\Http\Controllers\Client\Controller::class,
//        'clients.carnets' => \App\Http\Controllers\Client\Carnet\Controller::class,
//        'clients.carnets.billets' => \App\Http\Controllers\Client\Carnet\BilletController::class,
//        'clients.billets' => \App\Http\Controllers\Client\BilletController::class,
//        'tasks' => \App\Http\Controllers\TasksController::class,
//        'users' => \App\Http\Controllers\UsersController::class,
//        'bankings' => \App\Http\Controllers\Banking\Controller::class,
//        'plans' => \App\Http\Controllers\PlanController::class,
        'clients' => \App\Http\Controllers\Controller::class,
        'clients.carnets' => \App\Http\Controllers\Controller::class,
        'clients.carnets.billets' => \App\Http\Controllers\Controller::class,
        'clients.billets' => \App\Http\Controllers\Controller::class,
        'tasks' => \App\Http\Controllers\Controller::class,
        'users' => \App\Http\Controllers\Controller::class,
        'bankings' => \App\Http\Controllers\Controller::class,
        'plans' => \App\Http\Controllers\Controller::class,
        'contracts' => \App\Http\Controllers\Controller::class,
        'ctos' => \App\Http\Controllers\Controller::class,
        // 'bankings.carnets' => \App\Http\Controllers\Banking\Carnet\Controller::class,
        // 'bankings.carnets.billets' => \App\Http\Controllers\Banking\Carnet\BilletController::class,
        // 'bankings.billets' => \App\Http\Controllers\Banking\BilletController::class,
        'tests' => \App\Http\Controllers\Test\Controller::class,
        'tests.clients.carnets' => \App\Http\Controllers\Test\Client\CarnetController::class,
        'tests.clients.billets' => \App\Http\Controllers\Test\Client\BilletController::class,
        // 'tests.bankings.carnets' => \App\Http\Controllers\Test\Banking\CarnetController::class,
        // 'tests.bankings.billets' => \App\Http\Controllers\Test\Banking\BilletController::class,
    ]);
//    Route::get('/banking-carnets/create/test', \App\Http\Controllers\Banking\Carnet\Controller::class);
    Route::get('/tests/laravel', [\App\Http\Controllers\Test\Controller::class, 'laravel'])->name('tests.laravel');
});

// JETSTREAM LIVEWIRE
// Route::get('/clientes/', [\App\Http\Livewire\Clientes\Listar::class, '__invoke'])->name('clientes.index');
// Route::get('/clientes/', [\App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.index');
// Route::get('/clientes/create', [\App\Http\Livewire\Clientes\Novo::class, '__invoke'])->name('clientes.create');
// Route::get('/clientes/{cliente}', [\App\Http\Livewire\Clientes\Editar::class, '__invoke'])->name('clientes.edit');
// Route::get('/clients/', [\App\Http\Livewire\Clientes\Listar::class, '__invoke'])->name('clients.index');
