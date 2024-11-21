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

class actualizarLibrosAutor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $autorId;
    
    public function __construct($autorId){
        $this->autorId = $autorId;
    }

    public function handle(){
        $autor = Autores::find($this->autorId);
        $client = new Client();

        if($autor){
            $autor->cantidad_libros = $autor->libros()->count();
        }

        $data = ["id_autor" => $this->autorId, "cantidad" => $autor ? $autor->cantidad_libros : 0];
        $response = $client->post('http://localhost:3000/actualizar-cantidad-libros', [
            'json' => $data            
        ]); 
        
    }
}
