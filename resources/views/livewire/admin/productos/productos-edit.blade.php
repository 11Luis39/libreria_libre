<div>

    <form wire:submit="store">

        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-green-700">
                    <i class="fas fa-camera mr-2"></i>
                    actualizar imagen
                    <input type="file" class="hidden" accept= "image/*" wire:model="image">
                </label>
            </div>
            <img class="aspect-[16/9]" object-cover object-center w-full
                src="{{ $image ? $image->temporaryUrl() : Storage::url($productoEdit['imagen']) }}" alt="">
        </figure>
        <x-validation-errors class="mb-4" />


        <div class="card">
            <div class="mb4">
                <div class="mb-4">
                    <x-label class="mb-1">
                        Nombre
                    </x-label>
                    <x-input wire:model="productoEdit.nombre" class="w-full"
                        placeholder="Por favor ingrese el nombre del producto" />
                </div>
                <div class="mb-4">
                    <x-label class="mb-1">
                        Descripcion
                    </x-label>
                    <x-input wire:model="productoEdit.descripcion" class="w-full"
                        placeholder="Por favor ingrese la descripcion del producto" />
                </div>

                <div class="mb-4">
                    <x-label class="mb-1">
                        Precio
                    </x-label>
                    <x-input type="number" step="0.01" wire:model="productoEdit.precio" class="w-full"
                        placeholder="Por favor ingrese el precio del producto" />
                </div>
                <div class="mb-4">
                    <x-label class="mb-1">
                        Stock
                    </x-label>
                    <x-input type="number" wire:model="productoEdit.stock" class="w-full"
                        placeholder="Por favor ingrese el precio del producto" />
                </div>

            </div>
            <div class="flex justify-end ">
                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>

                <x-button class="ms-3">
                    Actualizar
                </x-button>

            </div>
        </div>
    </form>

    <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {

                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "No podras revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: ' #d33',
                    confirmButtonText: 'Si, Eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                })

            }
        </script>
    @endpush

</div>
