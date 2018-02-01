<?php

//El registrar no debería pasar por jwt:auth ya que en este punto no hay un usuario logueado.
Route::post('users', 'UsersController@store');


//Estos si, pero el anterior no, ese era el error
Route::group(['middleware' => ['jwt.auth']], function () {


    Route::get('/user', function () {
        return ['data' => auth()->user()];
    });
    Route::get('users', 'UsersController@index');
    Route::put('users/{user}', 'UsersController@update');
    Route::delete('users/{user}', 'UsersController@destroy');
    Route::get('getUserAuth', 'UsersController@getUserAuth');

    Route::get('messages', 'chatController@fetchMessages');
	Route::post('messages', 'chatController@sendMessage');

});



