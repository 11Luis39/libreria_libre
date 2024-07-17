<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Editar Usuario</h1>

    <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <x-input type="text" name="name" value="{{ $usuario->name }}" required class="mt-1 block w-full" />
        </div>
        
        <div>
            <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
            <x-input type="text" name="apellido" value="{{ $usuario->apellido }}" required class="mt-1 block w-full" />
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <x-input type="email" name="email" value="{{ $usuario->email }}" required class="mt-1 block w-full" />
        </div>
        
        <div>
            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <x-input type="text" name="telefono" value="{{ $usuario->telefono }}" class="mt-1 block w-full" />
        </div>
        
        <div>
            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
            <x-input type="text" name="direccion" value="{{ $usuario->direccion }}" class="mt-1 block w-full" />
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
            <select name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Seleccione un rol</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $usuario->hasRole($role->name) ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="mt-4 px-4 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
            Actualizar Usuario
        </button>
    </form>
</x-admin-layout>
