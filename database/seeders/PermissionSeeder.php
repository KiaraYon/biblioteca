<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permiso;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Desactivar las restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the detalle_permisos table
        DB::table('detalle_permisos')->truncate();

        // Truncate the permisos table
        Permiso::truncate();

        // Activar las restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Define the new permissions
        $permisos = [
            // Permisos for Estudiantes
            ['nombre' => 'ver-estudiantes', 'tipo' => 1],
            ['nombre' => 'crear-estudiantes', 'tipo' => 1],
            ['nombre' => 'editar-estudiantes', 'tipo' => 1],
            ['nombre' => 'eliminar-estudiantes', 'tipo' => 1],

            // Permisos for Libros
            ['nombre' => 'ver-libros', 'tipo' => 1],
            ['nombre' => 'crear-libros', 'tipo' => 1],
            ['nombre' => 'editar-libros', 'tipo' => 1],
            ['nombre' => 'eliminar-libros', 'tipo' => 1],

            // Permisos for Autores
            ['nombre' => 'ver-autores', 'tipo' => 1],
            ['nombre' => 'crear-autores', 'tipo' => 1],
            ['nombre' => 'editar-autores', 'tipo' => 1],
            ['nombre' => 'eliminar-autores', 'tipo' => 1],

            // Permisos for Editoriales
            ['nombre' => 'ver-editoriales', 'tipo' => 1],
            ['nombre' => 'crear-editoriales', 'tipo' => 1],
            ['nombre' => 'editar-editoriales', 'tipo' => 1],
            ['nombre' => 'eliminar-editoriales', 'tipo' => 1],

            // Permisos for Materias
            ['nombre' => 'ver-materias', 'tipo' => 1],
            ['nombre' => 'crear-materias', 'tipo' => 1],
            ['nombre' => 'editar-materias', 'tipo' => 1],
            ['nombre' => 'eliminar-materias', 'tipo' => 1],

            // Permisos for Prestamos
            ['nombre' => 'ver-prestamos', 'tipo' => 1],
            ['nombre' => 'crear-prestamos', 'tipo' => 1],
            ['nombre' => 'editar-prestamos', 'tipo' => 1],
            ['nombre' => 'eliminar-prestamos', 'tipo' => 1],

            // Permisos for Configuraciones
            ['nombre' => 'ver-configuraciones', 'tipo' => 1],
            ['nombre' => 'crear-configuraciones', 'tipo' => 1],
            ['nombre' => 'editar-configuraciones', 'tipo' => 1],
            ['nombre' => 'eliminar-configuraciones', 'tipo' => 1],

            // Permisos for Permisos (User Permissions)
            ['nombre' => 'ver-permisos', 'tipo' => 1],
            ['nombre' => 'crear-permisos', 'tipo' => 1],
            ['nombre' => 'editar-permisos', 'tipo' => 1],
            ['nombre' => 'eliminar-permisos', 'tipo' => 1],

            // Permisos for Permisos (User Permissions)
            ['nombre' => 'ver-detalle-permisos', 'tipo' => 1],
            ['nombre' => 'crear-detalle-permisos', 'tipo' => 1],
            ['nombre' => 'editar-detalle-permisos', 'tipo' => 1],
            ['nombre' => 'eliminar-detalle-permisos', 'tipo' => 1],
        ];

        // Create the new permissions
        foreach ($permisos as $permiso) {
            Permiso::create($permiso);
        }
    }
}
