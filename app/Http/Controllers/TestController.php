<?php

namespace App\Http\Controllers;

use App\Models\User;

class TestController extends Controller
{
    public function checkPermissions()
    {
        $user = User::find(1); // Cambia el ID al del usuario que quieras verificar
        foreach ($user->permisos as $permiso) {
            echo $permiso->nombre . '<br>';
        }
    }
}