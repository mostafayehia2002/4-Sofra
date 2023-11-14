<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//login to system
Route::get('/',function (){
    return view('admin.login');
})->middleware('guest');
Route::group(['prefix'=>'admin','middleware'=>['auth','checkPermission','checkStatus']],function (){
    Route::group(['controller'=>AdminController::class],function (){
        Route::get('show-admins','index')->name('showAdmins');
        Route::get('create-admin','create')->name('createAdmin');
        Route::post('store','store')->name('storeAdmin');
        Route::get('profile/edit/{id}','profile')->name('editProfile');
        Route::Post('profile/update','update')->name('updateProfile');
        Route::get('profile','profile')->name('adminProfile');
        Route::get('delete/{id}','delete')->name('deleteAdmin');
        Route::post('status','status')->name('adminStatus');
    });
    Route::group(['controller'=>CategoryController::class],function (){
        Route::get('category','index')->name('showCategory');
        Route::post('category/store','store')->name('storeCategory');
        Route::post('category/update','update')->name('updateCategory');
        Route::get('category/delete/{id}','delete')->name('deleteCategory');
    });
    Route::group(['controller'=>CityController::class],function (){
        Route::get('city','index')->name('showCity');
        Route::post('city/store','store')->name('storeCity');
        Route::post('city/update','update')->name('updateCity');
        Route::get('city/delete/{id}','delete')->name('deleteCity');
    });
    Route::group(['controller'=>RegionController::class],function (){
        Route::get('city/region/{id}','index')->name('showRegion');
        Route::post('city/region/store','store')->name('storeRegion');
        Route::get('city/region/delete/{id}','delete')->name('deleteRegion');
        Route::post('city/region/update','update')->name('updateRegion');
    });

    Route::resource('roles', RoleController::class);
});
Auth::routes(['register'=>false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

