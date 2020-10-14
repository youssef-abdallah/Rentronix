<?php

use App\Http\Controllers\AdvertisementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Models\Advertisement;

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

Route::group(['middleware' => 'auth:api'], function() {
    /* Requests Routes */

    Route::apiResource('requests', 'UserRequestController');

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

    /* Advertisements Routes */

    Route::post('advertisements', 'AdvertisementController@store')->name('advertisements.store')->middleware('role:Admin');;
    Route::put('advertisements/{advertisement}', 'AdvertisementController@update')->name('advertisements.update')->middleware('role:Admin');;
    Route::delete('advertisements/{advertisement}', 'AdvertisementController@destroy')->name('advertisements.destroy')->middleware('role:Admin');;

    /* Order Feedback Routes */

    Route::apiResource('feedbacks', 'OrderFeedbackController');


    /* User routes */
    Route::get('users/isadmin', 'UserController@isAdmin');
    Route::apiResource('users', 'UserController');
    Route::get('profile', 'UserController@showUserProfile')->name('profile.showUserProfile');

    /* Subscriptions routes */

    Route::post('/subscriptions', 'SubscriptionController@store')->name('subscriptions.store');
    /* favourite list routes

    Route::group(['prefix'=>'users'], function (){
        Route::apiResource('{users}/favouriteList', FavouriteList::class);
    });
    */

    /* categories routes*/

    Route::apiResource('/category', CategoryController::class, ['except' => 'index']);

    Route::post('/subscriptions', 'SubscriptionController@store')->name('subscriptions.store');
    /* favourite list routes  /// getting a favourite list of a certain user

        Route::group(['prefix'=>'category'], function () {
            Route::apiResource('/{category}/subcategory', SubcategoryController::class);
        });*/

    Route::resource('/favouritelist', 'FavouriteListController', ['except' => ['create', 'edit', 'show', 'update']]);
    
    /* Products routes*/

    Route::group(['prefix'=>'category/{category}/subcategory'], function () {
        Route::apiResource('{subcategory}/products', ProductController::class);
    });




// for adding a new subcategory directly
Route::post('/subcategory', 'SubcategoryController@store');
Route::get('/allsubcategories', 'SubcategoryController@showAll');

/* Products routes*/

    Route::group(['prefix'=>'category/{category}/subcategory/{subcategory}/products'], function (){
        Route::apiResource('{products}/comments', CommentController::class);
    });
});
// for adding a new product directly
Route::post('/products', 'ProductController@store');
Route::get('/allproducts', 'ProductController@showAll');

/* Facebook Route */
Route::post('auth/facebook', 'Auth\FacebookController@loginFromToken');

/* Google Route */
Route::post('auth/google', 'Auth\GoogleController@loginFromToken');

/*promocodes  */
Route::apiResource('/promocode',PromocodeController::class);

///the products that are in a favourite list
    Route::group(['prefix'=>'category/{category}/subcategory/{subcategory}/products'], function (){
    Route::apiResource('{products}/favouritelist',FavouriteListController::class);



});

/*search apis */
// category
Route::get('search/category', 'CategoryController@CategorySearch');
//subcategory
Route::get('search/subCategory', 'SubcategoryController@SubCategorySearch');
//product
Route::get('search/product', 'ProductController@ProductSearch');
//Products for rent
Route::get('search/productForRent', 'ProductController@ProductSearchRent');
//products for sale
Route::get('search/productForBuy', 'ProductController@ProductSearchBuy');

/*home apis */
//manufactures
Route::get('manufactures', 'UserController@GetalllManufacturesdetails');
//the subcategories of certain manufactures
Route::get('manufactures/{manufactures}/subcategory', 'UserController@GetManufacturesSubcategories');
//the products of certain manufactures
Route::get('manufactures/{manufactures}/subcategory/{subcategory}', 'UserController@GetManufacturesProducts');

//for all products linked to categories and subcategories check their apis's resource above


/* Home Route */
Route::get('/home', 'HomeController@index')->name('home');

/* Category Route */
Route::get('/categories', 'CategoryController@index');

/* Advertisements Route */
Route::get('/advertisements', 'AdvertisementController@index');

/* Admin Routes */
Route::get('/admin/requests', 'AdminController@showRequests')
    ->name('requests.admin')
    ->middleware('auth:api')
    ->middleware('role:Admin');
Route::put('/admin/requests/{request}/approve', 'AdminController@approve')
    ->name('requests.approve')
    ->middleware('auth:api')
    ->middleware('role:Admin');
Route::delete('/admin/requests/{request}', 'AdminController@destroyRequest')
    ->name('requests.delete')
    ->middleware('auth:api')
    ->middleware('role:Admin');
Route::get('/admin/products', 'AdminController@showProducts')
    ->name('products.admin')
    ->middleware('auth:api')
    ->middleware('role:Admin');
Route::delete('/admin/products/{product}', 'AdminController@destroyProduct')
    ->name('products.delete')
    ->middleware('auth:api')
    ->middleware('role:Admin');
Route::get('/admin/orders', 'AdminController@showOrders')
    ->name('orders.admin')
    ->middleware('auth:api')
    ->middleware('role:Admin');
Route::delete('/admin/orders/{order}', 'AdminController@destroyOrder')
    ->name('orders.delete')
    ->middleware('auth:api')
    ->middleware('role:Admin');
Route::put('/admin/orders/{order}/status', 'AdminController@updateOrderStatus')
    ->name('orders.update')
    ->middleware('auth:api')
    ->middleware('role:Admin');
Route::get('/admin/users', 'AdminController@showUsers')
    ->name('users.admin')
    ->middleware('auth:api')
    ->middleware('role:Admin');
Route::get('/admin/complaints', 'AdminController@showComplaints')
    ->name('complaints.admin')
    ->middleware('auth:api')
    ->middleware('role:Admin');
Route::delete('/admin/complaints/{complaint}', 'AdminController@destroyComplaint')
    ->name('complaints.delete')
    ->middleware('auth:api')
    ->middleware('role:Admin');









