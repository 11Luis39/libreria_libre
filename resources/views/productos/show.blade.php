<x-app-layout>
    <x-container>
        <div class="card p-6 bg-white shadow-md rounded-lg">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <figure class="mb-4">
                        <img src="{{ $producto->image }}" class="w-full h-auto rounded-lg" alt="{{ $producto->nombre }}">
                    </figure>
                    <div class="text-sm text-gray-600">
                        {{ $producto->descripcion }}
                    </div>
                </div>
                <div class="col-span-1 flex flex-col justify-center">
                    <h1 class="text-xl text-gray-800 font-semibold mb-2 text-center">
                        {{ $producto->nombre }}
                    </h1>
                    <p class="text-gray-600 mb-4 text-center">
                        Bs/{{ $producto->precio }}
                    </p>
                    <div class="flex items-center space-x-4 mb-6">
                        <button class="btn btn-purple" onclick="updateQty(-1)">
                            -
                        </button>
                        <span id="qty">1</span>
                        <button class="btn btn-purple" onclick="updateQty(1)">
                            +
                        </button>
                    </div>
                    
                    <form id="addToCartForm" action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                        @csrf
                        <div class="flex items-center space-x-4 mb-6">
                            <input type="hidden" name="cantidad" id="cantidad" value="1">
                            <button type="submit" class="btn btn-purple w-full">
                                Agregar al carro
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </x-container>
   
</x-app-layout>
<script>
    function updateQty(change) {
        let qtyElement = document.getElementById('qty');
        let cantidadInput = document.getElementById('cantidad');
        let currentQty = parseInt(qtyElement.innerText);

        let newQty = currentQty + change;

        if (newQty < 1) {
            newQty = 1; // Evitar cantidades negativas o cero
        }

        qtyElement.innerText = newQty;
        cantidadInput.value = newQty; // Actualizar el valor del input oculto
    }
</script>
