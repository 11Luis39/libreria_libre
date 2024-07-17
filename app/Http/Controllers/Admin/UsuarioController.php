<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $usuarios = User::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('apellido', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('telefono', 'like', "%{$search}%")
                         ->orWhere('direccion', 'like', "%{$search}%");
        })->paginate();
    
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all(); // Obtener todos los roles
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'telefono' => 'nullable|string|max:20',
        'direccion' => 'nullable|string|max:255',
        'password' => 'required|string|min:8', // Validar contraseña
        'role' => 'required|exists:roles,id', // Validar rol
    ]);

    $user = User::create([
        'name' => $request->name,
        'apellido' => $request->apellido,
        'email' => $request->email,
        'telefono' => $request->telefono,
        'direccion' => $request->direccion,
        'password' => bcrypt($request->password), // Hashear contraseña
    ]);

    $user->assignRole(Role::find($request->role)->name); // Asignar rol usando el nombre

    return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado con éxito.');
}


    public function edit(User $usuario)
    {
        $roles = Role::all(); // Obtener todos los roles
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'role' => 'nullable|exists:roles,id', // Validar rol opcional
        ]);
    
        $usuario->update($request->all());
    
        if ($request->has('role')) {
            // Asignar rol usando el nombre
            $usuario->syncRoles([Role::find($request->role)->name]); 
        }
    
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
