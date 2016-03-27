<?php

Route::get('/', function () {
    return redirect()->to('https://github.com/Frezc/easypay');
});

Route::post('auth', 'AuthController@auth');
Route::post('register', 'AuthController@register');
Route::post('trade', 'TradeController@trade');
Route::get('user/{id}', 'UserController@info')->where('id', '[0-9]+');

// userId: 用户id
// money: 充入的金额
Route::post('recharge', 'UserController@recharge');

// id: number
// offset: 偏移量
// limit: 最大数量
Route::get('user/{id}/tradeList', 'UserController@tradeList')->where('id', '[0-9]+');
