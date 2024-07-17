<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $lastProductos = Producto::orderBy('created_at', 'desc')->paginate(12);
        return view('welcome', compact('lastProductos'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $productos = Producto::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nombre', 'like', "%{$query}%")
                                 ->orWhere('descripcion', 'like', "%{$query}%");
        })->get();

        return response()->json($productos);
    }
    
    


}



