<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prestamo
 *
 * @property $id
 * @property $id_estudiante
 * @property $id_libro
 * @property $fecha_prestamo
 * @property $fecha_devolucion
 * @property $cantidad
 * @property $observacion
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Estudiante $estudiante
 * @property Libro $libro
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Prestamo extends Model
{
    
    static $rules = [
		'id_estudiante' => 'required',
		'id_libro' => 'required',
		'fecha_prestamo' => 'required',
		'fecha_devolucion' => 'required',
		'cantidad' => 'required',
		'observacion' => 'string',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_estudiante','id_libro','fecha_prestamo','fecha_devolucion','cantidad','observacion','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudiante()
    {
        return $this->belongsTo(\App\Models\Estudiante::class, 'id_estudiante', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function libro()
    {
        return $this->belongsTo(\App\Models\Libro::class, 'id_libro', 'id');
    }
    

}
