<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

// Social Auth
Route::get('auth/social', 'Auth\SocialAuthController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');

// Routes after Auth
Route::middleware(['auth'])->group(function () {
	Route::get('home', 'homeController@index')->name('home');
	Route::get('comercial', 'homeController@comercial')->name('comercial');

	Route::post('usuario/relatorio', 'usuarioController@relatorio')->name('usuario.relatorio');
	Route::post('usuario/grafico_barra', 'usuarioController@grafico_barra')->name('usuario.grafico_barra');
	Route::post('usuario/grafico_pizza', 'usuarioController@grafico_pizza')->name('usuario.grafico_pizza');

	Route::post('cliente/relatorio', 'clienteController@relatorio')->name('cliente.relatorio');
	Route::post('cliente/grafico_linha', 'clienteController@grafico_linha')->name('cliente.grafico_linha');
	Route::post('cliente/grafico_pizza', 'clienteController@grafico_pizza')->name('cliente.grafico_pizza');
});
