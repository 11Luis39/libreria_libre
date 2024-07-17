<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $clienteRole = Role::create(['name' => 'cliente']);
        

        Storage::deleteDirectory('producto');
        Storage::makeDirectory('producto');
        // User::factory(10)->create();

        $user = new User();
        $user->name = 'Luis Alejandro';
        $user->apellido = 'Torres Rocha';
        $user->email = 'soloalaaalaz@gmail.com';
        $user->telefono = '77807205';
        $user->direccion = 'Calle 1 # 2-3';
        $user->password = bcrypt('12345678');
        $user->save();
        // Asignar el rol de admin al usuario
        $user->assignRole($adminRole); // O asignar el rol cliente


        Producto::factory(10)->create();
    }
}
