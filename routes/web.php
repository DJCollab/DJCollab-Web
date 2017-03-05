<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@Index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'MainController@dashboard');
    Route::post('dashboard/create', 'MainController@create');
    Route::get('/dashboard/party/{id?}', 'MainController@ViewParty');
 });

Route::get('login', 'Auth\AuthController@redirectToProvider');
Route::get('auth/spotify', 'AuthController@redirectToProvider');
Route::get('auth/spotify/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
