<?php

namespace App\Livewire\Admin\Productos;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

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
            Storage::delete($this->productoEdit['imagen']);
            $this->productoEdit['imagen'] = $this->image->store('producto', 'public');
        }

        $this->producto->update($this->productoEdit);

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Éxito',
            'text' => 'El producto se actualizo correctamente',

        ]);
    }
    public function render()
    {
        return view('livewire.admin.productos.productos-edit');
    }
}
