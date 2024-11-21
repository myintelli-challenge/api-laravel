<?php

namespace App\Http\Controllers;

use App\Autores;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AutoresController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Muestra la lista de todos los autores
     * 
     * @return \Illuminate\Http\Response
     */
    public function getAutores(){
        //Obtener todos los autores
        $autores = Autores::orderBy('nombre', 'asc')->get();
        return response()->json($autores);
    }

    /**
     * Crear un nuevo autor
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setAutor(Request $request)
    {
        try{
            //Validación de los datos recibidos
            $validate = $request->validate([
                "nombre" => "required|string",
                "apellido" => "required|string",
                "telefono" => "nullable|numeric|digits_between:7,10"
            ]);

            //Se almacena el registro después de la validación
            $autor = Autores::create($validate);

            return response()->json(['message'=>'Autor creado', 'autor'=>$autor], 201);
        }catch(ValidationException $e){
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Actualiza los datos de un autor específico.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function editAutor(Request $request, $id){
        //Buscar el autor por ID
        $autor = Autores::find($id);

        if (!$autor) {
            return response()->json([
                'message' => 'Registro no encontrado',
            ], 404);
        }

        try{
            //Validación de los datos recibidos
            $validate = $request->validate([
                "nombre" => "required|string",
                "apellido" => "required|string",
                "telefono" => "nullable|numeric|digits_between:7,10"
            ]);


            //Se actualiza el registro después de la validación
            $autor->update($validate);

            return response()->json(['message'=>'Autor actualizado', 'autor'=>$autor], 201);
        }catch(ValidationException $e){
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Elimina un autor específico.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deteleAutor($id){
        //Buscar el autor por ID
        $autor = Autores::find($id);
        
        //En caso de no existir el ID consultado, se responde con código de estado 404
        if (!$autor) {
            return response()->json([
                'message' => 'Registro no encontrado',
            ], 404);
        }
        
        //Se elimina el registro, si este existe
        $autor->delete();
        return response()->json(['Registro eliminado'=>$autor]);
    }

}
