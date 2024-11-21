<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;

use App\Libros;
use App\Events\libroCreado;

class LibrosController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Muestra la lista de todos los libros
     * 
     * @return \Illuminate\Http\Response
     */
    public function getLibros(){
        $libros = Libros::with('autores')->orderBy('titulo', 'asc')->get();
        return response()->json($libros);
    }

    /**
     * Crear un nuevo libro
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setLibro(Request $request){        
        try{
            //Validación de los datos recibidos
            $validate = $request->validate([
                "titulo" => "required|string",
                "descripcion" => "nullable|string",
                "anio_publicacion" => "required|string|min:4",
                "autores_id" => "required|exists:autores,id"
            ]);
            
            //Se almacena el registro después de la validación
            $libro = Libros::create($validate);

            //Se ejecuta el evento que actualizará la cantidad de libros relacionados con el autor
            event(new libroCreado($libro));

            return response()->json(['message'=>'Libro creado', 'libro'=>$libro], 201);
        }catch(ValidationException $e){
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Actualiza los datos de un libro específico.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function editLibro(Request $request, $id){
        //Buscar el libro por ID
        $libro = Libros::find($id);

        if (!$libro) {
            return response()->json([
                'message' => 'Registro no encontrado',
            ], 404);
        }

        try{
            //Validación de los datos recibidos
            $validate = $request->validate([
                "titulo" => "required|string",
                "descripcion" => "nullable|string",
                "anio_publicacion" => "required|string|min:4",
                "autores_id" => "required|exists:autores,id"
            ]);

            //Se actualiza el registro después de la validación
            $libro->update($validate);

            return response()->json(['message'=>'Libro actualizado', 'autor'=>$libro], 201);
        }catch(ValidationException $e){
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Elimina un libro específico.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deleteLibro($id){
        //Buscar el libro por ID
        $libro = Libros::find($id);
        
        //En caso de no existir el ID consultado, se responde con código de estado 404
        if (!$libro) {
            return response()->json([
                'message' => 'Registro no encontrado',
            ], 404);
        }
        
        //Se elimina el registro, si este existe
        $libro->delete();
        return response()->json(['Registro eliminado'=>$libro]);
    }
}
