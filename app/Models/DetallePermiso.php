<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetallePermiso
 *
 * @property $id
 * @property $id_usuario
 * @property $id_permiso
 * @property $created_at
 * @property $updated_at
 *
 * @property Permiso $permiso
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetallePermiso extends Model
{
    
    static $rules = [
		'id_usuario' => 'required',
		'id_permiso' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_usuario','id_permiso'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permiso()
    {
        return $this->belongsTo(\App\Models\Permiso::class, 'id_permiso', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_usuario', 'id');
    }
    

}
