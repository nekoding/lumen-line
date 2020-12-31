<?php

use Illuminate\Support\Str;

/** @var \Laravel\Lumen\Routing\Router $router */

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
    $response = array(
        'name'  => 'Line bot API',
        'author'    => 'enggar tivandi',
        'github'    => 'https://github.com/nekoding/lumen-line'
    );

    return response()->json($response);
});


$router->get('/key', function () {
    return Str::random(32);
});
