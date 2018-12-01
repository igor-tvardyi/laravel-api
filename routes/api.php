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

//Route::middleware('auth:api')->get('/clients', 'ClientController@getClients');
Route::get('/clients', 'ClientController@getClients');
Route::get('/clients/{client}', 'ClientController@getClient');
Route::post('/clients', 'ClientController@postClient');
Route::put('/clients/{client}', 'ClientController@putClient');
Route::delete('/clients/{client}', 'ClientController@deleteClient');

Route::get('/clients/{client}/contacts', 'ClientContactController@getClientContacts');
Route::get('/clients/{client}/contacts/{clientContact}', 'ClientContactController@getClientContact');
Route::post('/clients/{client}/contacts', 'ClientContactController@postClientContact');
Route::put('/clients/{client}/contacts/{clientContact}', 'ClientContactController@putClientContact');
Route::delete('/clients/{client}/contacts/{clientContact}', 'ClientContactController@deleteClientContact');
