<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Editorial
 *
 * @property $id
 * @property $editorial
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Libro[] $libros
 * @property Libro[] $libros
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Editorial extends Model
{

    static $rules = [
		'editorial' => 'required|string',
		'estado' => 'required',
    ];

    protected $perPage = 20;
    protected $table = 'editorials';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['editorial','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libros()
    {
        return $this->hasMany(\App\Models\Libro::class, 'id', 'id_editorial');
    }


}