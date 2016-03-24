<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::post('auth', 'AuthController@auth');
Route::post('register', 'AuthController@register');
Route::post('trade', 'TradeController@trade');
Route::get('user/{id}', 'UserController@info')->where('id', '[0-9]+');

// id: number
// offset: 偏移量
// limit: 最大数量
Route::get('user/{id}/tradeList', 'UserController@tradeList')->where('id', '[0-9]+');
