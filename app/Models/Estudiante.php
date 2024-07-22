<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estudiante
 *
 * @property $id
 * @property $codigo
 * @property $dpi
 * @property $nombre
 * @property $carrera
 * @property $direccion
 * @property $telefono
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Prestamo[] $prestamos
 * @property Prestamo[] $prestamos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Estudiante extends Model
{

    static $rules = [
		'codigo' => 'required|string',
		'dpi' => 'required|string',
		'nombre' => 'required|string',
		'carrera' => 'string',
		'direccion' => 'required|string',
		'telefono' => 'required|string',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['codigo','dpi','nombre','carrera','direccion','telefono','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        // Corrige aquí el tercer parámetro, debería ser 'id_estudiante'
        return $this->hasMany(\App\Models\Prestamo::class, 'id_estudiante', 'id');
    }



}