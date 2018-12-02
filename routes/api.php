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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout');
    });
});

Route::group([
    'prefix' => 'clients',
    'middleware' => 'auth:api',
],
function () {
    Route::get('', 'ClientController@getClients');
    Route::get('{client}', 'ClientController@getClient');
    Route::post('', 'ClientController@postClient');
    Route::put('{client}', 'ClientController@putClient');
    Route::delete('{client}', 'ClientController@deleteClient');

    Route::get('{client}/contacts', 'ClientController@getClientContacts');
    Route::get('{client}/contacts/{clientContact}', 'ClientController@getClientContact');
    Route::post('{client}/contacts', 'ClientController@postClientContact');
    Route::put('{client}/contacts/{clientContact}', 'ClientController@putClientContact');
    Route::delete('{client}/contacts/{clientContact}', 'ClientController@deleteClientContact');
});

Route::middleware('auth:api')->post('import/csv', 'ImportController@postCsv');
