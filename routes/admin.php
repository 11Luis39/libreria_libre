<?php

use App\Http\Controllers\Admin\PedidoController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\UsuarioController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('productos',ProductoController::class);
Route::get('ordenes', [PedidoController::class, 'index'])->name('pedidos.index');
Route::post('pedidos/{id}/estado', [PedidoController::class, 'updateStatus'])->name('pedidos.updateStatus');

Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
