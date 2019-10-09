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



Route::get('/clients','InfoController@getAllClients');
Route::post('/client/add','InfoController@storeClient');
Route::post('/client/location','InfoController@storeLocation');
Route::get('/data/chart/notifications','InfoController@getDataForChartNotification');
Route::get('/data/chart/sessions','InfoController@getDataForSessionChart');
Route::get('/data/chart/inscriptions','InfoController@getDataForInscriptionChart');
