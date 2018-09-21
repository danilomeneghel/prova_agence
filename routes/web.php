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
	Route::get('home', 'HomeController@index')->name('home');
	Route::get('comercial', 'HomeController@comercial')->name('comercial');

	Route::post('usuario/relatorio', 'UsuarioController@relatorio')->name('usuario.relatorio');
	Route::post('usuario/grafico_barra', 'UsuarioController@grafico_barra')->name('usuario.grafico_barra');
	Route::post('usuario/grafico_pizza', 'UsuarioController@grafico_pizza')->name('usuario.grafico_pizza');

	Route::post('cliente/relatorio', 'ClienteController@relatorio')->name('cliente.relatorio');
	Route::post('cliente/grafico_linha', 'ClienteController@grafico_linha')->name('cliente.grafico_linha');
	Route::post('cliente/grafico_pizza', 'ClienteController@grafico_pizza')->name('cliente.grafico_pizza');
});
