<?php

namespace App\Livewire\Admin\Productos;

use Livewire\Component;

class ProductosEdit extends Component
{
    public $producto;

    public $productoEdit;
    public function mount($producto){
        $this->productoEdit = $producto->only('nombre','descripcion','precio','stock','imagen');
        dd($this->productoEdit);
    }
    public function render()
    {
        return view('livewire.admin.productos.productos-edit');
    }
}
