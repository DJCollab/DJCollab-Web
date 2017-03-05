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

Route::put('/party/create/{name}/{threshold}/{password?}', 'API\PartyController@CreateParty');
Route::post('/party/{partyId}/password/{password}', 'API\PartyController@SetPassword');
Route::post('/party/{partyId}/threshold/{threshold}', 'API\PartyController@SetThreshold');
Route::post('/party/{partyId}/host/{userId}', 'API\PartyController@TransferHost');
Route::put('/party/{partyId}/song/{songId}', 'API\PartyController@AddSong');
Route::delete('/party/{partyId}/song/{songId}', 'API\PartyController@RemoveSong');
Route::post('/party/{partyId}/song/{songId}/upvote', 'API\PartyController@UpvoteSong');
Route::post('/party/{partyId}/song/{songId}/downvote', 'API\PartyController@DownvoteSong');
Route::delete('/party/{partyId}', 'API\PartyController@DeleteParty');
Route::get('/party/{partyId}', 'API\PartyController@Party');
