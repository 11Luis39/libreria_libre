<?php

namespace App\Livewire\Admin\Productos;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductosCreate extends Component
{
    use WithFileUploads;
    public $image;
    public $producto = [
        'nombre' => '',
        'descripcion' => '',
        'precio' => '',
        'stock' => '',
        'imagen' => '',
    ];

    public function store()
    {
        $this->validate(
            [
                'image' => 'required|image|max:1024',
                'producto.nombre' => 'required|max:255',
                'producto.descripcion' => 'nullable',
                'producto.precio' => 'required|numeric|min:0',
                'producto.stock' => 'required',

            ]

        );



        $this->producto['imagen'] = $this->image->store('producto','public');
        //dd($this->producto['imagen']);
        
        $producto = Producto::create($this->producto);
        return redirect()->route('admin.productos.edit', $producto);
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'El formulario contiene errores.'
                ]);
            }
        });
    }
    public function render()

    {
        return view('livewire.admin.productos.productos-create');
    }
}
