<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Crear Usuario</h1>

    <form action="{{ route('admin.usuarios.store') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <x-input type="text" name="name" required class="mt-1 block w-full" />
        </div>
        
        <div>
            <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
            <x-input type="text" name="apellido" required class="mt-1 block w-full" />
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <x-input type="email" name="email" required class="mt-1 block w-full" />
        </div>
        
        <div>
            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <x-input type="text" name="telefono" class="mt-1 block w-full" />
        </div>
        
        <div>
            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
            <x-input type="text" name="direccion" class="mt-1 block w-full" />
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <x-input type="password" name="password" required class="mt-1 block w-full" />
        </div>
        

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
            <select name="role" required class="mt-1 block w-full">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        
        
        <button type="submit" class="mt-4 px-4 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
            Crear Usuario
        </button>
    </form>
</x-admin-layout>
