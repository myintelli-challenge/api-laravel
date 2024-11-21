<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libros extends Model
{
    /**
     * Atributos que se pueden registrar de manera masiva
     * 
     * @var array
     */
    protected $fillable = ["titulo", "descripcion", "anio_publicacion", "autores_id"];

    /**
     * Define la relación "pertenece a" entre el autor y el libro
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autores(){
        return $this->belongsTo(Autores::class);
    }
}
