<?php

use App\Http\Controllers\Api\Client\ClientAuthController;
use App\Http\Controllers\Api\Client\ClientMainController;
use App\Http\Controllers\Api\Client\ClientOrderController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\Restaurant\OfferController;
use App\Http\Controllers\Api\Restaurant\OrderController;
use App\Http\Controllers\Api\Restaurant\ProductController;
use App\Http\Controllers\Api\Restaurant\RestaurantAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//main controller

Route::group(['controller'=>MainController::class],function (){
    Route::get('/categories','getCategories');
    Route::get('/cities','getCites');
    Route::get('/payments','getPayments');
    Route::post('/contact-us','contactUs');
    Route::get('/about','aboutApp');
    Route::get('restaurant/reviews','getReviews')->middleware('auth:restaurant_api');
});

/*******************start restaurant************************/
Route::group(['prefix'=>'restaurant'],function (){
    //login and register restaurant
    Route::group(['controller'=>RestaurantAuthController::class],function (){
        Route::post('/register','register');
        Route::post('/login','login');
        Route::post('/reset-password','resetPassword');
        Route::post('/change-password','changePassword');
    });

    //restaurant profile
    Route::group(['middleware'=>'auth:restaurant_api','controller'=>RestaurantAuthController::class],function (){
        Route::post('/profile','profile');
        Route::post('/logout','logout');
        Route::post('update-profile','updateProfile');
    });
     //products
    Route::group(['middleware'=>'auth:restaurant_api','controller'=>ProductController::class],function (){
        Route::post('/add-product','addProduct');
        Route::post('/update-product/{id}','updateProduct');
        Route::post('/get-products','getProducts');
        Route::get('/edit-product/{id}','editProduct');
        Route::get('/delete-product/{id}','deleteProduct');

    });

     //offers
    Route::group(['middleware'=>'auth:restaurant_api','controller'=>OfferController::class],function (){
        Route::post('/add-offer','addOffer');
        Route::post('/update-offer/{id}','updateOffer');
        Route::get('/get-offers','getOffers');
        Route::get('/edit-offer/{id}','editOffer');
        Route::get('/delete-offer/{id}','deleteOffer');
    });
    //orders
    Route::group(['middleware'=>'auth:restaurant_api','controller'=>OrderController::class],function (){
        Route::get('/pending-orders','getPendingOrder');
        Route::get('/accepted-orders','getAcceptedOrder');
        Route::get('/delivered-orders','getDeliveredOrder');
        Route::get('/accept-order/{id}','acceptOrder');
        Route::get('/reject-order/{id}','rejectOrder');
        Route::get('/delivered-order/{id}','deliveredOrder');
    });
});
/****************end restaurant**********************/
/***************start client************************/
Route::group(['prefix'=>'client'],function (){
    //login and register restaurant
    Route::post('/register',[ClientAuthController::class,'register']);
    Route::post('/login',[ClientAuthController::class,'login']);
    Route::post('/reset-password',[ClientAuthController::class,'resetPassword']);
    Route::post('/change-password',[ClientAuthController::class,'changePassword']);
    //client profile
    Route::group(['middleware'=>'auth:client_api','controller'=>ClientAuthController::class],function (){
        Route::post('/profile','profile');
        Route::post('/logout','logout');
        Route::post('/update-profile','updateProfile');

    });
    //clientMainController
    Route::group(['controller'=>ClientMainController::class],function (){
        Route::get('/restaurants','getRestaurants');
        Route::get('/restaurant/{id}','getRestaurantDetails');
        Route::get('/restaurant/search/{id}','getRestaurantByCity');
        Route::get('/offers','getOffers');
       //review
        Route::post('/add-review','addReview')->middleware('auth:client_api');
    });
    //orders
    Route::group(['controller'=>ClientOrderController::class,'middleware'=>'auth:client_api'],function (){
        Route::post('/new-order','newOrder');
        Route::get('/orders/accepts','getAcceptedOrders');
        Route::get('/orders/delivered','getDeliveredOrders');
        Route::get('/order/receipt/{id}','receiptOrder');
        Route::get('/order/reject/{id}','rejectOrder');
    });

});
/**************end client**************************/

