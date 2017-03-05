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

Route::put('/party', 'API\PartyController@CreateParty');
Route::post('/party', 'API\PartyController@UpdateParty');
Route::put('/party/song', 'API\PartyController@AddSong');
Route::delete('/party/song', 'API\PartyController@DeleteSong');
Route::post('/party/up', 'API\PartyController@UpvoteSong');
Route::post('/party/down', 'API\PartyController@DownvoteSong');
Route::delete('/party', 'API\PartyController@DeleteParty');
Route::get('/party', 'API\PartyController@Party');
Route::get('/queue', 'API\PartyController@Queue');
