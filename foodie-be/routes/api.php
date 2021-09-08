<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

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
$api->version('v1', function ($api) {
    $api->post('login', 'App\Http\Controllers\AuthController@login');
    $api->post('register', 'App\Http\Controllers\AuthController@register');

    $api->group(['middleware' => 'jwt.verify'], function ($api) {
        // $api->get('users', 'App\Http\Controllers\UserController@index');
        // $api->get('users/{id}', 'App\Http\Controllers\UserController@show');
        // $api->get('restaurants', 'App\Http\Controllers\RestaurantController@index');
        // $api->get('restaurants/{id}', 'App\Http\Controllers\RestaurantController@show');
        // $api->post('restaurants', 'App\Http\Controllers\RestaurantController@create');
        // $api->put('restaurants/{id}', 'App\Http\Controllers\RestaurantController@update');
        // $api->delete('restaurants/{id}', 'App\Http\Controllers\RestaurantController@delete');
        // $api->get('meals', 'App\Http\Controllers\MealController@index');
        // $api->get('meals/{id}', 'App\Http\Controllers\MealController@show');
        // $api->post('meals', 'App\Http\Controllers\MealController@create');
        // $api->put('meals/{id}', 'App\Http\Controllers\MealController@update');
        // $api->delete('meals/{id}', 'App\Http\Controllers\MealController@delete');
    });
});