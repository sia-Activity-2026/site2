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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users', ['uses' => 'UserController@getUsers']);
});

$router->get('/users', 'UserController@index');
$router->post('/users', 'UserController@add');
$router->get('/users/{id}', 'UserController@show');
$router->delete('/users/{id}', 'UserController@delete');
$router->put('/users/{id}', 'UserController@update');

// Product routes
$router->get('/products', 'ProductController@index');
$router->post('/products', 'ProductController@store');
$router->get('/products/{id}', 'ProductController@show');
$router->put('/products/{id}', 'ProductController@update');
$router->delete('/products/{id}', 'ProductController@destroy');

// Order routes
$router->get('/orders', 'OrderController@index');
$router->post('/orders', 'OrderController@add');
$router->get('/orders/{id}', 'OrderController@show');
$router->put('/orders/{id}', 'OrderController@update');
$router->delete('/orders/{id}', 'OrderController@delete');
$router->get('/users/{userId}/orders', 'OrderController@getUserOrders');


<?php
Route::middleware('auth:api')->group(function () {
    Route::apiResource('products', ProductController::class);
});