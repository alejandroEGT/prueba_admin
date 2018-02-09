<?php

use App\Events\MessageSent;

Route::get('/', function () {
    return view('vue');
});
Route::get('/event', function(){

	return event( new MessageSent("hola mundo"));
});

Route::resource('saludo','HomeController');
Route::post('/auth', 'authuserController@autentificar');

Auth::routes();



