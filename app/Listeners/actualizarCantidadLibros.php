<?php

namespace App\Listeners;

use App\Events\libroCreado;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\actualizarLibrosAutor;

/**
 * Listener para manejar el evento de actualización
 */
class actualizarCantidadLibros implements ShouldQueue
{
    use InteractsWithQueue;
    
    /**
     * Maneja el evento de actualización de la cantidad de libros relacionados
     * 
     * @param \App\Events\libroCreado $event
     * @return void
     */
    public function handle(libroCreado $event){
        //Encola el job para ejecutar la actualización
        actualizarLibrosAutor::dispatch($event->libro->autores_id);
    }
}
