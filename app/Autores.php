<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autores extends Model
{
    /**
     * Atributos que se pueden registrar de manera masiva
     * 
     * @var array
     */
    protected $fillable = ["nombre", "apellido", "telefono", "cantidad_libros"];

    /**
     * Obtener los libros que pertenecen a un autor
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libros(){
        //Relación de uno a muchos hacia la tabla libros
        return $this->hasMany(Libros::class);
    }
}
