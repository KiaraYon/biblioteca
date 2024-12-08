<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['nombre'];

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'role_permission');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
}
