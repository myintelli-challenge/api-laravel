<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libros extends Model
{
    protected $fillable = ["titulo", "descripcion", "anio_publicacion", "autores_id"];

    public function autores(){
        return $this->belongsTo(Autores::class);
    }
}
