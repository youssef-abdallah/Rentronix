<?php

use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
//use App\Http\Controllers\Auth\GoogleController;


//App\Http\Controllers
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

Route::get('/welcome', function () {
    return view('welcome');
});

//Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'SpaController@index')->name('home');
});
Route::resource('user', 'UserController');

// facebook login
Route::get('/facebook', function () {
    return view('facebook');
});
Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');
Route::get('authorize/facebook/callback', 'SpaController@index')->name('callback');
// google login
Route::get('google', function () {
    return view('google');
});
Route::get('auth/google', [GoogleController::class,'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class,'handleGoogleCallback']);

/* Routes for Single Page Application(SPA) */
Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Auth::routes();