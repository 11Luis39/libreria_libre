<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Barryvdh\DomPDF\Facade\PDF; // Asegúrate de que esta línea esté aquí
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function show($id)
    {
        $factura = Factura::with('pedido')->findOrFail($id);
        $pdf = PDF::loadView('factura.show', compact('factura'));
        return $pdf->download('factura_'.$factura->id.'.pdf');
    }
}


