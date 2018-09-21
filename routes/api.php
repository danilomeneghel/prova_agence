<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Cadastro
Route::get('usuario', 'usuarioController@lista');
Route::post('usuario', 'usuarioController@novo');
Route::put('usuario/{id}', 'usuarioController@editar');
Route::delete('usuario/{id}', 'usuarioController@excluir');
