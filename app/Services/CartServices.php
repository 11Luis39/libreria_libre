<?php

namespace App\Services;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartServices
{
    public function addToCart($producto, $qty = 1)
    {
        // Verificar si el producto ya está en el carrito y actualizar la cantidad
        $cartItem = Cart::instance('shopping')->search(function ($cartItem, $rowId) use ($producto) {
            return $cartItem->id === $producto->id;
        });

        if ($cartItem->isNotEmpty()) {
            $rowId = $cartItem->first()->rowId;
            $itemQty = Cart::instance('shopping')->get($rowId)->qty + $qty;
            Cart::instance('shopping')->update($rowId, $itemQty);
        } else {
            // Si el producto no está en el carrito, añadirlo
            Cart::instance('shopping')->add([
                'id' => $producto->id,
                'name' => $producto->nombre,
                'qty' => $qty,
                'price' => $producto->precio,
                'weight' => 0,
                'options' => [
                    'image' => $producto->imagen,
                ],
            ]);
        }

        // Persistir en la base de datos
        $this->actualizarDetallesCarrito();
    }

    public function removeFromCart($rowId)
    {
        $item = Cart::instance('shopping')->get($rowId);
        if ($item) {
            Cart::instance('shopping')->remove($rowId);

            // Eliminar de la base de datos
            DetalleCarrito::where('producto_id', $item->id)
                ->whereHas('carrito', function ($query) {
                    $query->where('usuario_id', Auth::id());
                })->delete();

            // Actualizar detalles del carrito después de eliminar
            $this->actualizarDetallesCarrito();
        }
    }

    public function clearCart()
    {
        Cart::instance('shopping')->destroy();

        // Eliminar todos los elementos del carrito en la base de datos
        $carrito = Carrito::where('usuario_id', Auth::id())->first();
        if ($carrito) {
            $carrito->detalles()->delete();
            $carrito->delete();
        }
    }

    public function increase($rowId)
    {
        // Incrementar la cantidad del item en el carrito de sesión
        Cart::instance('shopping')->update($rowId, Cart::get($rowId)->qty + 1);

        // Actualizar la cantidad en la base de datos
        $this->actualizarDetallesCarrito();
    }

    public function decrease($rowId)
    {
        // Obtener el item del carrito por su ID de fila
        $item = Cart::instance('shopping')->get($rowId);

        // Verificar si la cantidad es mayor que 1 para decrementar en el carrito de sesión
        if ($item->qty > 1) {
            // Decrementar la cantidad del item en el carrito de sesión
            Cart::instance('shopping')->update($rowId, $item->qty - 1);
        } else {
            // Si la cantidad es 1, eliminar el item del carrito en la sesión
            Cart::instance('shopping')->remove($rowId);

            // Eliminar el detalle del producto en la base de datos
            DetalleCarrito::where('producto_id', $item->id)
                ->whereHas('carrito', function ($query) {
                    $query->where('usuario_id', Auth::id());
                })->delete();
        }

        // Actualizar la cantidad en la base de datos
        $this->actualizarDetallesCarrito();
    }

    protected function actualizarDetallesCarrito()
    {
        $usuarioId = Auth::id();
        $carrito = Carrito::firstOrCreate(['usuario_id' => $usuarioId]);
    
        // Eliminar los detalles actuales
        $carrito->detalles()->delete();
    
        // Insertar los nuevos detalles utilizando el método create de Eloquent
        foreach (Cart::instance('shopping')->content() as $item) {
            DetalleCarrito::create([
                'carrito_id' => $carrito->id,
                'producto_id' => $item->id,
                'cantidad' => $item->qty,
            ]);
        }
    }
    
}
