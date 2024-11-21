<?php

namespace App\Listeners;

use App\Events\libroCreado;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\actualizarLibrosAutor;

class actualizarCantidadLibros implements ShouldQueue
{
    use InteractsWithQueue;
    
    public function handle(libroCreado $event)
    {
        actualizarLibrosAutor::dispatch($event->libro->autores_id);
    }
}
