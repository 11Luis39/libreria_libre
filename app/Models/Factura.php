<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'fecha',
        'total',
    ];


    public function pedido()
    {
        return $this->belongsTo(pedido::class);
    }
}
