<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DefaultUserPermissionSeeder extends Seeder
{
    public function run()
    {
        // Crear el usuario administrador
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );

        // Buscar el rol de Admin
        $adminRole = Role::where('nombre', 'Admin')->first();

        if (!$adminRole) {
            $this->command->error('El rol "Admin" no existe en la base de datos.');
            return;
        }

        // Asignar el rol al usuario
        $user->roles()->syncWithoutDetaching([$adminRole->id]);

        $this->command->info("Usuario 'admin@example.com' creado y rol 'Admin' asignado.");
    }
}
