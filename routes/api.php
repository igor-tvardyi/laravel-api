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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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
//    'middleware' => 'auth:api',
],
function () {
    Route::get('', 'ClientController@getClients');
    Route::get('{client}', 'ClientController@getClient');
    Route::post('', 'ClientController@postClient');
    Route::put('{client}', 'ClientController@putClient');
    Route::delete('/clients/{client}', 'ClientController@deleteClient');

    Route::get('{client}/contacts', 'ClientContactController@getClientContacts');
    Route::get('{client}/contacts/{clientContact}', 'ClientContactController@getClientContact');
    Route::post('{client}/contacts', 'ClientContactController@postClientContact');
    Route::put('{client}/contacts/{clientContact}', 'ClientContactController@putClientContact');
    Route::delete('{client}/contacts/{clientContact}', 'ClientContactController@deleteClientContact');
});

Route::post('import/csv', 'ImportController@postCsv');
