<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permiso;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {

        // Crear roles
        $adminRole = Role::create(['nombre' => 'Admin']);
        $bibliotecarioRole = Role::create(['nombre' => 'Bibliotecario']);

        // Definir los permisos
        $permisos = [
            // Permisos para Estudiantes
            ['nombre' => 'ver-estudiantes', 'tipo' => 1],
            ['nombre' => 'crear-estudiantes', 'tipo' => 1],
            ['nombre' => 'editar-estudiantes', 'tipo' => 1],
            ['nombre' => 'eliminar-estudiantes', 'tipo' => 1],

            // Permisos para Libros
            ['nombre' => 'ver-libros', 'tipo' => 1],
            ['nombre' => 'crear-libros', 'tipo' => 1],
            ['nombre' => 'editar-libros', 'tipo' => 1],
            ['nombre' => 'eliminar-libros', 'tipo' => 1],

            // Permisos para Autores
            ['nombre' => 'ver-autores', 'tipo' => 1],
            ['nombre' => 'crear-autores', 'tipo' => 1],
            ['nombre' => 'editar-autores', 'tipo' => 1],
            ['nombre' => 'eliminar-autores', 'tipo' => 1],

            // Permisos para Editoriales
            ['nombre' => 'ver-editoriales', 'tipo' => 1],
            ['nombre' => 'crear-editoriales', 'tipo' => 1],
            ['nombre' => 'editar-editoriales', 'tipo' => 1],
            ['nombre' => 'eliminar-editoriales', 'tipo' => 1],

            // Permisos para Materias
            ['nombre' => 'ver-materias', 'tipo' => 1],
            ['nombre' => 'crear-materias', 'tipo' => 1],
            ['nombre' => 'editar-materias', 'tipo' => 1],
            ['nombre' => 'eliminar-materias', 'tipo' => 1],

            // Permisos para Préstamos
            ['nombre' => 'ver-prestamos', 'tipo' => 1],
            ['nombre' => 'crear-prestamos', 'tipo' => 1],
            ['nombre' => 'editar-prestamos', 'tipo' => 1],
            ['nombre' => 'eliminar-prestamos', 'tipo' => 1],

            // Permisos para Configuraciones
            ['nombre' => 'ver-configuraciones', 'tipo' => 1],
            ['nombre' => 'crear-configuraciones', 'tipo' => 1],
            ['nombre' => 'editar-configuraciones', 'tipo' => 1],
            ['nombre' => 'eliminar-configuraciones', 'tipo' => 1],

            // Permisos para Usuarios
            ['nombre' => 'ver-usuarios', 'tipo' => 1],
            ['nombre' => 'crear-usuarios', 'tipo' => 1],
            ['nombre' => 'editar-usuarios', 'tipo' => 1],
            ['nombre' => 'eliminar-usuarios', 'tipo' => 1],

            // Permisos para Permisos
            ['nombre' => 'ver-roles', 'tipo' => 1],
            ['nombre' => 'crear-roles', 'tipo' => 1],
            ['nombre' => 'editar-roles', 'tipo' => 1],
            ['nombre' => 'eliminar-roles', 'tipo' => 1],
        ];

        // Crear los permisos y asignarlos a roles
        foreach ($permisos as $permisoData) {
            $permiso = Permiso::create($permisoData);

            // Asignar todos los permisos al rol Admin
            $adminRole->permisos()->attach($permiso);

            // Asignar permisos específicos al rol Bibliotecario
            $bibliotecarioAllowedPermissions = [
                'ver-estudiantes',
                'crear-estudiantes',
                'editar-estudiantes',

                'ver-libros',
                'crear-libros',
                'editar-libros',

                'ver-autores',
                'ver-editoriales',
                'ver-materias',
                'ver-prestamos',
            ];

            if (in_array($permiso->nombre, $bibliotecarioAllowedPermissions)) {
                $bibliotecarioRole->permisos()->attach($permiso);
            }
        }

        $this->command->info('Roles y permisos creados exitosamente.');
    }
}
