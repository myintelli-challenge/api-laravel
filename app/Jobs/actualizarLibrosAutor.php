<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Autores;

/**
 * Job para llamar una API externa y actualizar una tabla
 */
class actualizarLibrosAutor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $autorId;
    
    /**
     * Crea una nueva instancia del job
     * 
     * @param \App\Autores $autores
     * @return void
     */
    public function __construct($autorId){
        $this->autorId = $autorId;
    }

    /**
     * Función que ejecutará el job
     * 
     */
    public function handle(){
        //Consulta la existencia del autor relacionado al crear el libro
        $autor = Autores::find($this->autorId);
        //Instancia generada para realizar solicitudes a través de HTTP
        $client = new Client();

        //Si el autor relacionado existe, se consulta la cantidad de registros relacionados sobre la tabla libros
        if($autor){
            $autor->cantidad_libros = $autor->libros()->count();
        }

        //Se genera la estructura JSON que se enviará al servicio de actualización de cantidades
        $data = ["id_autor" => $this->autorId, "cantidad" => $autor ? $autor->cantidad_libros : 0];
        $response = $client->post('http://localhost:3000/actualizar-cantidad-libros', [
            'json' => $data            
        ]); 
        
    }
}
