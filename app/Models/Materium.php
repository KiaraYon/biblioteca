<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Materium
 *
 * @property $id
 * @property $nombre
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Libro[] $libros
 * @property Libro[] $libros
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Materium extends Model
{

    static $rules = [
		'nombre' => 'required|string',
		'estado' => 'required',
    ];

    protected $perPage = 20;
    protected $table = 'materias';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libros()
    {
        return $this->hasMany(\App\Models\Libro::class, 'id', 'id_materia');
    }


}