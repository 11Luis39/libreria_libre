<x-app-layout>
    <x-container>
        <div class="grid grid-cols-7 gap-6">
            <div class="col-span-5">
                <div class="flex justify-between mb-4">
                    <h1 class="text-lg">
                        Carrito de compras ({{ Cart::count() }}) Productos
                    </h1>
                    <form action="{{ route('carrito.limpiar') }}" method="POST">
                        @csrf
                        <button type="submit" class="font-semibold underline hover:text-blue-400 hover:no-underline">
                            Limpiar Carro
                        </button>
                    </form>
                </div>
                <div class="card p-6 bg-white shadow-md rounded-lg">
                    <ul>
                        @forelse ($contenido as $item)
                        <li class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <img class="w-24 h-auto object-cover object-center" src="{{ asset('storage/' . $item->options->image) }}" alt="{{ $item->name }}">
                                <div class="ml-4">
                                    <p class="text-sm">
                                        <a href="{{ route('productos.show', $item->id) }}" class="font-semibold hover:text-purple-500">
                                            {{ $item->name }}
                                        </a>
                                    </p>
                                    <p class="text-gray-600">
                                        Bs/{{ $item->price }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <form action="{{ route('carrito.incrementar', $item->rowId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-purple">+</button>
                                </form>
                                <span>{{ $item->qty }}</span>
                                <form action="{{ route('carrito.decrementar', $item->rowId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-purple">-</button>
                                </form>
                                <form action="{{ route('carrito.eliminar', $item->rowId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-red text-red-500 px-3 text-xs">
                                        <i class="fas fa-trash"></i>
                                        Quitar
                                    </button>
                                </form>
                            </div>
                        </li>
                        @empty
                            <p class="text-gray-600">
                                No hay productos en el carrito
                            </p>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-span-2">
                <div class="card p-6 bg-white shadow-md rounded-lg">
                    <div class="flex justify-between mb-4 font-semibold">
                        <p>
                            Total
                        </p>
                        <p>
                            Bs/{{ Cart::total() }}
                        </p>
                    </div>
                    <a href="#" class="btn btn-purple w-full">
                        Continuar compra
                    </a>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>


