<?php

use App\Http\Controllers\Admin\ProductoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('productos',ProductoController::class);