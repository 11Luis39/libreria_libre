<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $fillable = [
        'pedido_id',
        'estado',
        'fecha',
        'metodo',
        'monto',
    ];


    public function pedido()
    {
        return $this->belongsTo(pedido::class);
    }
}
