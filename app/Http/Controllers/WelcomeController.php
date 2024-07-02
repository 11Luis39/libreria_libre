<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {

        $lastProductos =Producto::orderBy('created_at', 'desc')
        ->take(100)
        ->get();
        return view('welcome', compact('lastProductos'));
    }
}
