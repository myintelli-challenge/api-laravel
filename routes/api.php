<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\ExportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('protected', function(){
    return response()->json(['message' => 'Acceso concedido']);
});

//Auth register and login
Route::post('register', 'AuthController@authRegister');
Route::post('login', 'AuthController@authLogin');

//Autores
Route::middleware('auth:api')->post('/autor', 'AutoresController@setAutor');
Route::middleware('auth:api')->get('/autores', 'AutoresController@getAutores');
Route::middleware('auth:api')->put('/autor/{id}', 'AutoresController@editAutor');
Route::middleware('auth:api')->delete('/autor/{id}', 'AutoresController@deteleAutor');

//Libros
Route::middleware('auth:api')->post('/libro', 'LibrosController@setLibro');
Route::middleware('auth:api')->get('/libros', 'LibrosController@getLibros');
Route::middleware('auth:api')->put('/libro/{id}', 'LibrosController@editLibro');
Route::middleware('auth:api')->delete('/libro/{id}', 'LibrosController@deleteLibro');

//Exportar
Route::middleware('auth:api')->get('/exportar', 'ExportController@export');
