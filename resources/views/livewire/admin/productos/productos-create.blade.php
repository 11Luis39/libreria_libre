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
                src="{{ $image ? $image->temporaryUrl() : asset('img/no-image-icon.png') }}" alt="">
        </figure>
        <x-validation-errors class="mb-4" />


        <div class="card">
            <div class="mb4">
                <div class="mb-4">
                    <x-label class="mb-1">
                        Nombre
                    </x-label>
                    <x-input wire:model="producto.nombre" class="w-full"
                        placeholder="Por favor ingrese el nombre del producto" />
                </div>
                <div class="mb-4">
                    <x-label class="mb-1">
                        Descripcion
                    </x-label>
                    <x-input wire:model="producto.descripcion" class="w-full"
                        placeholder="Por favor ingrese la descripcion del producto" />
                </div>

                <div class="mb-4">
                    <x-label class="mb-1">
                        Precio
                    </x-label>
                    <x-input type="number" step="0.01" wire:model="producto.precio" class="w-full"
                        placeholder="Por favor ingrese el precio del producto" />
                </div>
                <div class="mb-4">
                    <x-label class="mb-1">
                        Stock
                    </x-label>
                    <x-input type="number" wire:model="producto.stock" class="w-full"
                        placeholder="Por favor ingrese el precio del producto" />
                </div>

            </div>
            <div class="flex justify-end ">
                <x-button>
                    Crear producto
                </x-button>

            </div>



        </div>
    </form>

</div>
