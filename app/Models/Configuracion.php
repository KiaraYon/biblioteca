<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Configuracion
 *
 * @property $id
 * @property $nombre
 * @property $telefono
 * @property $correo
 * @property $direccion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Configuracion extends Model
{
    
    static $rules = [
		'nombre' => 'required|string',
		'telefono' => 'required|string',
		'correo' => 'required|string',
		'direccion' => 'required|string',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','telefono','correo','direccion'];



}
