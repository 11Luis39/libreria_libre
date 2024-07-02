<?php

namespace App\Livewire\Admin\Productos;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProductosEdit extends Component
{
    use WithFileUploads;

    public $producto;
    public $image;

    public $productoEdit;

    public function mount($producto)
    {



        $this->productoEdit = $producto->only('nombre', 'descripcion', 'precio', 'stock', 'imagen');
        //dd($this->productoEdit);
    }

    public function store()
    {

        $this->validate(
            [
                'image' => 'nullable|image|max:1024',
                'productoEdit.nombre' => 'required|max:255',
                'productoEdit.descripcion' => 'nullable',
                'productoEdit.precio' => 'required|numeric|min:0',
                'productoEdit.stock' => 'required',
            ]
        );
        if ($this->image) {
            $this->productoEdit['imagen'] = $this->image->store('productos', 'public');
        }
        $this->producto->update($this->productoEdit);
        return redirect()->route('admin.productos.index');
    }
    public function render()
    {
        return view('livewire.admin.productos.productos-edit');
    }
}
