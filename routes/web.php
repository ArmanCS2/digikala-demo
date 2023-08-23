<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function (){

    Route::get('/','AdminDashboardController@index')->name('admin.home');

    Route::prefix('market')->namespace('Market')->group(function (){

        Route::prefix('category')->group(function (){
        Route::get('/','CategoryController@index')->name('admin.market.category.index');
        Route::get('/create','CategoryController@create')->name('admin.market.category.create');
        Route::post('/store','CategoryController@store')->name('admin.market.category.store');
        Route::get('/edit/{id}','CategoryController@edit')->name('admin.market.category.edit');
        Route::get('/update/{id}','CategoryController@update')->name('admin.market.category.update');
        Route::get('/delete/{id}','CategoryController@destroy')->name('admin.market.category.destroy');
        });

        Route::prefix('brand')->group(function (){
            Route::get('/','BrandController@index')->name('admin.market.brand.index');
            Route::get('/create','BrandController@create')->name('admin.market.brand.create');
            Route::post('/store','BrandController@store')->name('admin.market.brand.store');
            Route::get('/edit/{id}','BrandController@edit')->name('admin.market.brand.edit');
            Route::get('/update/{id}','BrandController@update')->name('admin.market.brand.update');
            Route::get('/delete/{id}','BrandController@destroy')->name('admin.market.brand.destroy');
        });
    });
});
