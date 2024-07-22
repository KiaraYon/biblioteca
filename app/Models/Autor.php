<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Autor
 *
 * @property $id
 * @property $autor
 * @property $imagen
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Libro[] $libros
 * @property Libro[] $libros
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Autor extends Model
{

    static $rules = [
		'autor' => 'required|string',
		'imagen' => 'string',
		'estado' => 'required',
    ];

    protected $perPage = 20;
    protected $table = 'autors';


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['autor','imagen','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libros()
    {
        return $this->hasMany(\App\Models\Libro::class, 'id', 'id_autor');
    }


}