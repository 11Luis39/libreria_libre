<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad', 'carrito_id', 'producto_id'];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public static function actualizarDetalles($detalles)
    {
        foreach ($detalles as $producto_id => $detalle) {
            static::updateOrCreate(
                ['carrito_id' => $detalle['carrito_id'], 'producto_id' => $producto_id],
                ['cantidad' => $detalle['cantidad']]
            );
        }
    }
}

