<?php

use Dingo\Api\Routing\Router;

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

$api = app(Router::class);
$api->version('v1', function ($api) {
    $api->post('login', 'App\Http\Controllers\AuthController@login');
    $api->post('register', 'App\Http\Controllers\AuthController@register');

    $api->group(['middleware' => 'jwt.verify'], function ($api) {
        $api->post('logout', 'App\Http\Controllers\AuthController@logout');

        $api->get('me', 'App\Http\Controllers\UserController@me');
        $api->get('users', 'App\Http\Controllers\UserController@index');
        $api->get('users/{id}', 'App\Http\Controllers\UserController@show');
        $api->put('users/{id}', 'App\Http\Controllers\UserController@update');
        $api->delete('users/{id}', 'App\Http\Controllers\UserController@destroy');

        $api->get('restaurants', 'App\Http\Controllers\RestaurantController@index');
        $api->get('restaurants/{id}', 'App\Http\Controllers\RestaurantController@show');
        $api->post('restaurants', 'App\Http\Controllers\RestaurantController@create');
        $api->put('restaurants/{id}', 'App\Http\Controllers\RestaurantController@update');
        $api->delete('restaurants/{id}', 'App\Http\Controllers\RestaurantController@destroy');
        $api->get('restaurants/{id}/meals', 'App\Http\Controllers\RestaurantController@getMealsByRestaurantId');
        $api->post('restaurants/{id}/meals', 'App\Http\Controllers\RestaurantController@createMeal');
        $api->get('restaurants/{id}/orders', 'App\Http\Controllers\RestaurantController@getRestaurantOrders');
        $api->post('restaurants/{id}/orders', 'App\Http\Controllers\RestaurantController@createOrder');

        $api->get('meals/{id}', 'App\Http\Controllers\MealController@show');
        $api->put('meals/{id}', 'App\Http\Controllers\MealController@update');
        $api->delete('meals/{id}', 'App\Http\Controllers\MealController@destroy');

        $api->get('orders', 'App\Http\Controllers\OrderController@index');
        $api->get('orders/{id}', 'App\Http\Controllers\OrderController@show');
        $api->put('orders/{id}', 'App\Http\Controllers\OrderController@update');
    });
});