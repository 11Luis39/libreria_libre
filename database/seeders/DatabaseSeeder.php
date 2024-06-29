<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        Storage::deleteDirectory('productos');
        Storage::makeDirectory('productos');
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Luis Alejandro',
            'email' => 'Soloalaaalaz@gmail.com',
            'password'=> bcrypt('12345678')
        ]);

        Producto::factory(100)->create();
    }
}
