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

Route::group(['prefix' => 'address', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'AddressController@index');
    Route::get('/{id}', 'AddressController@byID');

    Route::post('create', 'AddressController@create');

    Route::Put('update/{id}', 'AddressController@update');
//    Route::Delete('delete/{id}', 'AddressController@delete');
});

Route::group(['prefix' => 'station', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'StationController@index');
    Route::get('/{id}', 'StationController@byID');

    Route::post('create', 'StationController@create');
    Route::post('createWithAddress', 'StationController@createWithAddress');

    Route::Put('update/{id}', 'StationController@update');
//    Route::Delete('delete/{id}', 'StationController@delete');
});

Route::group(['prefix' => 'staff'], function()
{
    Route::post('login', 'UserController@login');

    Route::group(['middleware' => 'auth:api'], function()
    {
        Route::get('/', 'UserController@index');
        Route::get('/{id}', 'UserController@byID');

        Route::post('create', 'UserController@create');
        Route::post('/createWithAddress', 'UserController@createWithAddress');

        Route::Put('update/{id}', 'UserController@update');
//        Route::Delete('delete/{id}', 'UserController@delete');
    });
});

Route::group(['prefix' => 'customer', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'CustomerController@index');
    Route::get('/{id}', 'CustomerController@byID');

    Route::post('create', 'CustomerController@create');
    Route::post('/createWithAddress', 'CustomerController@createWithAddress');

    Route::Put('update/{id}', 'CustomerController@update');
//    Route::Delete('delete/{id}', 'CustomerController@delete');
});

Route::group(['prefix' => 'route', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'RouteController@index');
    Route::get('/{id}', 'RouteController@byID');
    Route::get('/{departureStationID}/{arrivalStationID}/', 'RouteController@byStations');

    Route::post('create', 'RouteController@create');

    Route::Put('update/{id}', 'RouteController@update');
//    Route::Delete('delete/{id}', 'RouteController@delete');
});

Route::group(['prefix' => 'subscription', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'SubscriptionController@index');
    Route::get('/{id}', 'SubscriptionController@byID');

    Route::post('create', 'SubscriptionController@create');

    Route::Put('update/{id}', 'SubscriptionController@update');
//    Route::Delete('delete/{id}', 'StationController@delete');
});

Route::group(['prefix' => 'discount', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'DiscountController@index');
    Route::get('/{id}', 'DiscountController@byID');

    Route::post('create', 'DiscountController@create');

    Route::Put('update/{id}', 'DiscountController@update');
//    Route::Delete('delete/{id}', 'RouteController@delete');
});

Route::group(['prefix' => 'line', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'LineController@index');
    Route::get('/{id}', 'LineController@byID');

    Route::post('create', 'LineController@create');

    Route::Put('update/{id}', 'LineController@update');
//    Route::Delete('delete/{id}', 'RouteController@delete');
});

Route::group(['prefix' => 'ticket', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'TicketController@index');
    Route::get('/{id}', 'TicketController@byID');

    Route::post('create', 'TicketController@create');

//    Route::Put('update/{id}', 'TicketController@update');
//    Route::Delete('delete/{id}', 'TicketController@delete');
});

Route::group(['prefix' => 'typeTicket', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'TypeTicketController@index');
    Route::get('/{id}', 'TypeTicketController@byID');

    Route::post('create', 'TypeTicketController@create');

    Route::Put('update/{id}', 'TypeTicketController@update');
//    Route::Delete('delete/{id}', 'TypeTicketController@delete');
});

Route::group(['prefix' => 'pass', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'PassController@index');
    Route::get('/{id}', 'PassController@byID');

    Route::post('create', 'PassController@create');

    Route::Put('update/{id}', 'PassController@update');
//    Route::Delete('delete/{id}', 'PassController@delete');
});

Route::group(['prefix' => 'typePass', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'TypePassController@index');
    Route::get('/{id}', 'TypePassController@byID');

    Route::post('create', 'TypePassController@create');

    Route::Put('update/{id}', 'TypePassController@update');
//    Route::Delete('delete/{id}', 'TypePassController@delete');
});

Route::group(['prefix' => 'reservation', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'ReservationController@index');
    Route::get('/{id}', 'ReservationController@byID');

    Route::post('create', 'ReservationController@create');

    Route::Put('update/{id}', 'ReservationController@update');
//    Route::Delete('delete/{id}', 'ReservationController@delete');
});

Route::group(['prefix' => 'lostObject', 'middleware' => 'auth:api'], function()
{
    Route::get('/', 'LostObjectController@index');
    Route::get('/{id}', 'LostObjectController@byID');

    Route::post('create', 'LostObjectController@create');

    Route::Put('update/{id}', 'LostObjectController@update');
//    Route::Delete('delete/{id}', 'LostObjectController@delete');
});
