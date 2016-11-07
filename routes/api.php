<?php

use Illuminate\Http\Request;

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

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');

Route::group(['prefix' => 'staff'], function()
{
    Route::post('login', 'UserController@login');

    Route::group(['middleware' => 'auth:api'], function()
    {
        Route::get('/', 'UserController@index');
        Route::get('/{id}', 'UserController@byID');

        Route::post('create', 'UserController@create');

        Route::Put('update/{id}', 'UserController@update');
        Route::Delete('delete/{id}', 'UserController@delete');
    });
});

Route::group(['prefix' => 'address', 'middleware' => 'auth:api'], function()
{
    Route::get('/{id}', 'AddressController@byID');

    Route::post('create', 'AddressController@create');

    Route::Put('update/{id}', 'AddressController@update');
    Route::Delete('delete/{id}', 'AddressController@delete');
});

Route::group(['prefix' => 'lost_object', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'LostObjectController@index');
    Route::get('/{id}', 'LostObjectController@byID');

    Route::post('create', 'LostObjectController@create');

    Route::Put('update/{id}', 'LostObjectController@update');
    Route::Delete('delete/{id}', 'LostObjectController@delete');
});

Route::group(['prefix' => 'station', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'StationController@index');
    Route::get('/{id}', 'StationController@byID');

    Route::post('create', 'StationController@create');

    Route::Put('update/{id}', 'StationController@update');
    Route::Delete('delete/{id}', 'StationController@delete');
});