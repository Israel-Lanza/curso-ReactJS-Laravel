<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $usuario = User::create([
            'name' => 'Israel',
            'email' => 'isra@gmail.com',
            'password' => '12345'
        ]);

        $usuario2 = User::create([
            'name' => 'Melo',
            'email' => 'melo@gmail.com',
            'password' => '12345'
        ]);

        //rutas para roles y roles. Esta es la forma de crearlos (es una de muchas formas)
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleClient = Role::create(['name' => 'client']);

        $usuario->assignRole($roleAdmin);
        $usuario2->assignRole($roleClient);
    }
}
