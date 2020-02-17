<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return redirect()->to('/cities');
});


$router->get('/cities/{city}', 'CitiesController@show');

$router->get('/cities/', function() {
    return response()->json(['message' => "Pesquise pelo nome da sua cidade. Exemplo: " . url() . "/cities/toronto"]);
});
