<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'direccion',
        'estado',
        'fecha_pedido',
        'total',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pedidoProductos()
    {
        return $this->hasMany(PedidoProducto::class);
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }
}
