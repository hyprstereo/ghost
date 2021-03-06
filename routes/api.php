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


Route::post('/newcase','InvestigationController@newCase');

Route::get('/officers', 'ProfilesController@getOfficers');

Route::post('/upload', 'InvestigationController@uploadFiles');

Route::get('/records', 'InvestigationController@records');

Route::post('/case', 'InvestigationController@loadRecord');
Route::post('/case_delete', 'InvestigationController@deleteCase');
Route::get('/report', 'InvestigationController@generatePDF');