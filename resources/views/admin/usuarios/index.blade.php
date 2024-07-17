<x-admin-layout>
    <x-slot name="action">
        <a class="btn btn-purple" href="{{ route('admin.usuarios.create') }}">Nuevo Usuario</a>
    </x-slot>

    <div class="px-4 py-4">
        <form action="{{ route('admin.usuarios.index') }}" method="GET">
            <x-input type="text" name="search" class="w-full" placeholder="Escriba algo para filtrar"
                value="{{ request('search') }}" />
        </form>
    </div>

    @if ($usuarios->count())
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->apellido }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->direccion }}</td>
                            <td>
                                @if ($usuario->roles->contains('name', 'admin'))
                                    Admin
                                @else
                                    Cliente
                                @endif
                            </td>
                            <td class="px-6 py-4 flex space-x-2">

                                <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                                    class="text-indigo-600 hover:text-indigo-900 font-medium">Editar</a>
                                <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')"
                                        class="text-red-600 hover:text-red-900 font-medium">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $usuarios->links() }}</div>
    @else
        <p>No hay usuarios disponibles.</p>
    @endif
</x-admin-layout>
