<?php

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
    return $router->app->version();
});

// unsecure routes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users',['uses' => 'UserController@getUsers']);
});

$router->get('/users', 'UserController@index');//get
$router->post('/users', 'UserController@addUser');//create
$router->get('/users/{id}', 'UserController@showUser');//get user base on id
$router->put('/users/{id}', 'UserController@updateUsers');//Update all fields
$router->patch('/users/{id}', 'UserController@updateUsers');//update specific field
$router->delete('/users/{id}', 'UserController@removeUser');//get
$router->get('/login','UserController@login');
$router->post('/submit', 'UserController@submit');
