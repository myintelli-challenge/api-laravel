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

    public function setLibro(Request $request){        
        try{
            $validate = $request->validate([
                "titulo" => "required|string",
                "descripcion" => "nullable|string",
                "anio_publicacion" => "required|string|min:4",
                "autores_id" => "required|exists:autores,id"
            ]);

            $libro = Libros::create($validate);

            event(new libroCreado($libro));

            return response()->json(['message'=>'Libro creado', 'libro'=>$libro], 201);
        }catch(ValidationException $e){
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function getLibros(){
        $libros = Libros::with('autores')->orderBy('titulo', 'asc')->get();
        return response()->json($libros);
    }

    public function editLibro(Request $request, $id){
        $libro = Libros::find($id);

        if (!$libro) {
            return response()->json([
                'message' => 'Registro no encontrado',
            ], 404);
        }

        try{
            $validate = $request->validate([
                "titulo" => "required|string",
                "descripcion" => "nullable|string",
                "anio_publicacion" => "required|string|min:4",
                "autores_id" => "required|exists:autores,id"
            ]);

            $libro->update($validate);

            return response()->json(['message'=>'Libro actualizado', 'autor'=>$libro], 201);
        }catch(ValidationException $e){
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function deleteLibro($id){
        $libro = Libros::find($id);
        
        if (!$libro) {
            return response()->json([
                'message' => 'Registro no encontrado',
            ], 404);
        }
        
        $libro->delete();
        return response()->json(['Registro eliminado'=>$libro]);
    }
}
