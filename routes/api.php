<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'api\AuthController@login');
    Route::post('signup', 'api\AuthController@signUp');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'api\AuthController@logout');
        Route::get('user', 'api\AuthController@user');
    });
});

Route::group([
    'prefix' => 'client',
    'middleware' => 'auth:api'
], function () {
        Route::post('store', 'api\ClientController@store');
        Route::put('update/{id}','api\ClientController@update');
        Route::delete('destroy/{id}','api\ClientController@destroy');  
        Route::get('list','api\ClientController@index'); 
        Route::get('options','api\ClientController@options');
   
});
Route::group([
    'prefix' => 'parking-lot',
    'middleware' => 'auth:api'
], function () {
    Route::post('store','api\ParkingLotController@store');
    Route::put('update/{id}','api\ParkingLotController@update');
    Route::delete('destroy/{id}','api\ParkingLotController@destroy');
    Route::get('list','api\ParkingLotController@index'); 
    Route::get('options/{type}','api\ParkingLotController@options');
    Route::put('status/{id}','api\ParkingLotController@changeStatus');
    Route::put('status-free/{id}','api\ParkingLotController@changeFree');
    Route::get('options-search/{type}','api\ParkingLotController@optionsSearch');
    

});

Route::group([
    'prefix' => 'tariff',
    'middleware' => 'auth:api'
], function () {
    Route::post('store','api\TariffController@store');
    Route::put('update/{id}','api\TariffController@update');
    Route::delete('destroy/{id}','api\TariffController@destroy');
    Route::get('list','api\TariffController@index'); 
    Route::get('options/{type}','api\TariffController@options');      
});

Route::group([
    'prefix' => 'vehicle',
    'middleware' => 'auth:api'
], function () {
    Route::post('store','api\VehiclesController@store');
    Route::put('update/{id}','api\VehiclesController@update');
    Route::delete('destroy/{id}','api\VehiclesController@destroy');
    Route::get('list','api\VehiclesController@index'); 
    Route::get('options/{type}','api\VehiclesController@options');
});

Route::group([
    'prefix' => 'tariff',
    'middleware' => 'auth:api'
], function () {
    Route::post('store','api\TariffController@store');
    Route::put('update/{id}','api\TariffController@update');
    Route::delete('destroy/{id}','api\TariffController@destroy');
    Route::get('list','api\TariffController@index'); 
    Route::get('options/{type}','api\TariffController@options');   
});

Route::group([
    'prefix' => 'transaction',
    'middleware' => 'auth:api'
], function () {
    Route::post('store','api\TransactionController@store');
    Route::get('list','api\TransactionController@list');
    Route::put('update/{id}','api\TransactionController@update');
    Route::post('search','api\TransactionController@findSearch');
    Route::post('report','api\TransactionController@exportReport');
    
});
Route::group([
    'prefix' => 'bill',
    'middleware' => 'auth:api'
], function () {
    Route::post('store','api\BillController@store');
    Route::get('list','api\BillController@list');
    Route::put('update/{id}','api\BillController@update');
});