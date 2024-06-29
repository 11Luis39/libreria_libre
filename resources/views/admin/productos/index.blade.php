<x-admin-layout>
    <x-slot name="action">
        <a class="btn btn-purple" href="{{route('admin.productos.create')}}">
            Nuevo
        </a>
    </x-slot>
    @if ($productos->count())
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Descricion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            precio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stock
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $producto->id }} </th>
                            <td class="px-6 py-4">
                                {{ $producto->nombre }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $producto->descripcion }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $producto->precio }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $producto->stock }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.productos.edit', $producto) }}">
                                    Editar</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endif
</x-admin-layout>
