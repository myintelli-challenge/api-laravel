<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Autores;

class AutoresTest extends TestCase
{
    /**
     * @test
     */
    public function crear_un_autor(){
        //Crear un autor de prueba
        $autor = Autores::create([
            "nombre" => "Test",
            "apellido" => "Test Apellido",
            "telefono" => ""
        ]);

        //Verificar inserción
        $this->assertDatabaseHas('autores', [
            "nombre" => "Test",
            "apellido" => "Test Apellido",
            "telefono" => "111"
        ]);
    }
}
