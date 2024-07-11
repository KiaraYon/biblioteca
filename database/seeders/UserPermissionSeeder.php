<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permiso;

class UserPermissionSeeder extends Seeder
{
    public function run()
    {
        $user = User::find(1); // Cambia el ID al usuario que quieras asignar permisos

        $permisos = Permiso::all();

        foreach ($permisos as $permiso) {
            $user->permisos()->attach($permiso);
        }
    }
}