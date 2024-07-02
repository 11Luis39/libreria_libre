<x-app-layout>

    <div>
        <x-container>
            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                Ultimos productos
            </h1>
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($lastProductos as $producto)
                    <article class="bg-white shadow rounded overflow-hidden ">
                        <img src="{{ $producto->image }}" class="w-full h-48 object-cover object-center" alt="">
                        <div class="p-4">
                            <h1 class="text-lg font-bold text-gray-900 line-clamp-2 min-h-[4rem]">
                                {{ $producto->nombre }}
                            </h1>
                            <p class="text-sm text-gray-600 line-clamp-1">
                                Bs/{{ $producto->precio }}
                            </p>
                            <a href="{{ route('admin.productos.show', $producto) }}" class="btn btn-purple mt-4 block w-full">
                                Ver mas</a>
                        </div>
                    </article>
                @endforeach
            </div>

        </x-container>
    </div>


</x-app-layout>
