<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;

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

Route::apiResource('requests', 'UserRequestController');
Route::put('requests/approve/{request}', 'UserRequestController@approve')->name('requests.approve');

/* Cart Routes */

Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart', 'CartController@store')->name('cart.store');
Route::put('cart/{rowid}', 'CartController@update')->name('cart.update');
Route::delete('cart/{rowid}', 'CartController@destroy')->name('cart.destroy');
Route::get('emptycart', function() {
    Cart::restore('username');
    Cart::destroy();
    Cart::store('username');
});

/* Checkout routes */

Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('checkout', 'CheckoutController@store')->name('checkout.store');

/* Complaints routes */

Route::apiResource('complaints', 'ComplaintController');

/* Orders Routes */

Route::apiResource('orders', 'OrderController');
Route::put('orders/updatestatus/{order}', 'OrderController@updateOrderStatus')->name('orders.updateOrderStatus');

/* Advertisements Routes */

Route::apiResource('advertisements', 'AdvertisementController');

/* Order Feedback Routes */

Route::apiResource('feedbacks', 'OrderFeedbackController');

/* Home Route */

Route::get('/home', 'HomeController@index')->name('home');

/* User routes */

Route::apiResource('users', 'UserController');

/* Subscriptions routes */

Route::post('/subscriptions', 'SubscriptionController@store')->name('subscriptions.store');
/* favourite list routes

Route::group(['prefix'=>'users'], function (){
    Route::apiResource('{users}/favouriteList', FavouriteList::class);
});
 */

/* categories routes*/

Route::apiResource('/category', CategoryController::class);

/* subcategories routes*/

Route::group(['prefix'=>'category'], function () {
    Route::apiResource('/{category}/subcategory', SubcategoryController::class);
});


/* Products routes*/

Route::group(['prefix'=>'category/{category}/subcategory'], function () {
    Route::apiResource('{subcategory}/products', ProductController::class);
});



/* comments routes */

Route::group(['prefix'=>'category/{category}/subcategory/{subcategory}/products'], function (){
    Route::apiResource('{products}/comments', CommentController::class);
});












