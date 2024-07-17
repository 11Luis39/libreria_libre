<x-admin-layout>
    @if ($pedidos->count())
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('admin.pedidos.index', ['sort_field' => 'id', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">ID</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('admin.pedidos.index', ['sort_field' => 'user_id', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Usuario</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dirección
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('admin.pedidos.index', ['sort_field' => 'estado', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Estado</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('admin.pedidos.index', ['sort_field' => 'fecha_pedido', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Fecha de Pedido</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('admin.pedidos.index', ['sort_field' => 'total', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Total</a>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $pedido->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $pedido->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pedido->direccion }}
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.pedidos.updateStatus', $pedido->id) }}" method="POST">
                                    @csrf
                                    <select name="estado" onchange="this.form.submit()">
                                        <option value="Pendiente" {{ $pedido->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="Cancelado" {{ $pedido->estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                        <option value="Completado" {{ $pedido->estado == 'Completado' ? 'selected' : '' }}>Completado</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                {{ $pedido->fecha_pedido }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pedido->total }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-gray-500">No hay pedidos disponibles.</p>
    @endif
</x-admin-layout>





