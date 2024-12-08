<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permiso
 *
 * @property $id
 * @property $nombre
 * @property $tipo
 * @property $created_at
 * @property $updated_at
 *
 * @property DetallePermiso[] $detallePermisos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Permiso extends Model
{

    static $rules = [
		'nombre' => 'required|string',
		'tipo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','tipo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permiso');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'detalle_permisos', 'id_permiso', 'id_usuario');
    }

}
