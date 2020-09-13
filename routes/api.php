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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Requests Routes */

Route::get('requests', 'UserRequestController@index')->name('requests.index');
Route::get('requests/{id}', 'UserRequestController@show')->name('requests.show');
Route::put('requests/{id}', 'UserRequestController@update')->name('requests.update');
Route::post('requests', 'UserRequestController@store')->name('requests.store');
Route::delete('requests', 'UserRequestController@destroy')->name('requests.destroy');


/* Cart Routes */

Route::post('cart', 'CartController@store')->name('cart.store');
Route::put('cart/{rowid}', 'CartController@update')->name('cart.update');
Route::delete('cart/{rowid}', 'CartController@destroy')->name('cart.destroy');
Route::get('emptycart', function() {
    Cart::destroy();
});

/* Complaints routes */

Route::get('complaints', 'ComplaintController@index')->name('complaints.index');
Route::post('complaints', 'ComplaintController@store')->name('complaints.store');