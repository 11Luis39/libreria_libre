<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\WelcomeController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');

Route::prefix('carrito')->group(function () {
    Route::get('/', [CarritoController::class, 'verCarrito'])->name('carrito.index');
    Route::post('/agregar/{productoId}', [CarritoController::class, 'agregarAlCarrito'])->name('carrito.agregar')->middleware('auth');
    Route::post('/eliminar/{rowId}', [CarritoController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');
    Route::post('/incrementar/{rowId}', [CarritoController::class, 'incrementar'])->name('carrito.incrementar');
    Route::post('/decrementar/{rowId}', [CarritoController::class, 'decrementar'])->name('carrito.decrementar');
    Route::post('/limpiar', [CarritoController::class, 'vaciarCarrito'])->name('carrito.limpiar');
});

Route::Get('Pago',[PagoController::class, 'index'])->name('pago.index');
Route::post('Pago/pagado',[PagoController::class, 'pagado'])->name('pago.pagado');
Route::Get('gracias', function () {
    return view('gracias');
})->name('gracias');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
