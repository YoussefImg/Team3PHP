<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('test');
});

Route::group(['prefix' => '/~ludovic.marchand/DigX/SP2/public'], function() {
    Route::group(['prefix' => 'api/v.1'], function() {
        Route::group(['prefix' => 'staff'], function() {
            Route::get('/', 'StaffController@index');
            Route::get('/{id}', 'StaffController@byID');

            Route::post('login', 'StaffController@login');
            Route::post('create', 'StaffController@create');

            Route::Put('update/{id}', 'StaffController@update');
            Route::Delete('delete/{id}', 'StaffController@delete');
        });
    });
});


