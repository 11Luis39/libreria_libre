<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $sortField = $request->get('sort_field', 'id'); // Campo de ordenación predeterminado
        $sortOrder = $request->get('sort_order', 'asc'); // Orden de ordenación predeterminado

        $pedidos = Pedido::orderBy($sortField, $sortOrder)->get();
        return view('admin.pedidos.index', compact('pedidos', 'sortField', 'sortOrder'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,Cancelado,Completado'
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->save();

        return redirect()->route('admin.pedidos.index')->with('success', 'Estado del pedido actualizado exitosamente');
    }
}
