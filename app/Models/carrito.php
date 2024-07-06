<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrito extends Model
{
    use HasFactory;
    protected $fillable = ['usuario_id'];

    public function detalles()
    {
        return $this->hasMany(DetalleCarrito::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
