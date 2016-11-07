<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::group(['prefix' => '/~ludovic.marchand/DigX/SP/public'], function() {
    Route::get('/', function () {
        return view('temp');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index');
//});
