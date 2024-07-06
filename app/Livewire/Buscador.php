<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use Livewire\WithPagination;

class Buscador extends Component
{
    use WithPagination;

    

    public function updatedSearch()
    {
        // Implementa la lógica de búsqueda aquí
        // Por ejemplo, buscar productos que coincidan parcialmente con $this->search
        $this->emit('searchQuery', $this->search);
    }

    public function render()
    {
        // Implementa aquí la lógica para obtener los productos basados en la búsqueda
        $productos = Producto::where('nombre', 'like', '%'.$this->search.'%')
                            ->orderBy('created_at', 'desc')
                            ->paginate(12);

        return view('livewire.buscador', compact('productos'));
    }
}

