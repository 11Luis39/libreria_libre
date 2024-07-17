<?php

namespace App\Http\Controllers;

use App\Services\CartServices;
use App\Models\Producto;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    protected $cartService;

    public function __construct(CartServices $cartService)
    {
        $this->cartService = $cartService;
    }

    public function agregarAlCarrito(Request $request, $productoId)
    {
        // Validar el formulario
        $request->validate([
            'cantidad' => 'required|numeric|min:1',
        ]);

        // Obtener el producto desde la base de datos
        $producto = Producto::findOrFail($productoId);

        // Llamar al método addToCart del servicio CartService
        $this->cartService->addToCart($producto, $request->cantidad);

        // Redireccionar de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto agregado al carrito correctamente.');
    }

    public function eliminarDelCarrito($rowId)
    {
        // Llamar al método removeFromCart del servicio CartService
        $this->cartService->removeFromCart($rowId);

        // Redireccionar de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto eliminado del carrito correctamente.');
    }

    public function vaciarCarrito()
    {
        // Llamar al método clearCart del servicio CartService
        $this->cartService->clearCart();

        // Redireccionar de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Carrito vaciado correctamente.');
    }

    public function incrementar($rowId)
    {
        // Llamar al método increase del servicio CartService
        $this->cartService->increase($rowId);

        // Redireccionar de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Cantidad incrementada correctamente.');
    }

    public function decrementar($rowId)
    {
        // Llamar al método decrease del servicio CartService
        $this->cartService->decrease($rowId);

        // Redireccionar de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Cantidad decrementada correctamente.');
    }

    public function verCarrito()
    {
        // Obtener el contenido del carrito
        $contenido = Cart::instance('shopping')->content();
        $total = $this->cartService->getTotal();

        // Retornar la vista del carrito con el contenido
        return view('carrito.index', compact('contenido', 'total'));
    }
}




