<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Libro
 *
 * @property $id
 * @property $cantidad
 * @property $id_autor
 * @property $id_editorial
 * @property $id_materia
 * @property $anio_edicion
 * @property $num_pagina
 * @property $descripcion
 * @property $imagen
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Autor $autor
 * @property Editorial $editorial
 * @property Materium $materium
 * @property Prestamo[] $prestamos
 * @property Prestamo[] $prestamos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Libro extends Model
{

    static $rules = [
		'cantidad' => 'required',
		'titulo' => 'required',
		'id_autor' => 'required',
		'id_editorial' => 'required',
		'id_materia' => 'required',
		'descripcion' => 'string',
		'imagen' => 'string',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo','cantidad','id_autor','id_editorial','id_materia','anio_edicion','num_pagina','descripcion','imagen','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autor()
    {
        return $this->belongsTo(\App\Models\Autor::class, 'id_autor', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function editorial()
    {
        return $this->belongsTo(\App\Models\Editorial::class, 'id_editorial', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materium()
    {
        return $this->belongsTo(\App\Models\Materium::class, 'id_materia', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany(\App\Models\Prestamo::class, 'id', 'id_libro');
    }

}