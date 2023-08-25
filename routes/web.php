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
| Admin Routes
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
        Route::put('/update/{id}','CategoryController@update')->name('admin.market.category.update');
        Route::delete('/destroy/{id}','CategoryController@destroy')->name('admin.market.category.destroy');
        });

        Route::prefix('brand')->group(function (){
            Route::get('/','BrandController@index')->name('admin.market.brand.index');
            Route::get('/create','BrandController@create')->name('admin.market.brand.create');
            Route::post('/store','BrandController@store')->name('admin.market.brand.store');
            Route::get('/edit/{id}','BrandController@edit')->name('admin.market.brand.edit');
            Route::put('/update/{id}','BrandController@update')->name('admin.market.brand.update');
            Route::delete('/destroy/{id}','BrandController@destroy')->name('admin.market.brand.destroy');
        });

        Route::prefix('comment')->group(function (){
            Route::get('/','CommentController@index')->name('admin.market.comment.index');
            Route::get('/show','CommentController@show')->name('admin.market.comment.show');
            Route::post('/store','CommentController@store')->name('admin.market.comment.store');
            Route::get('/edit/{id}','CommentController@edit')->name('admin.market.comment.edit');
            Route::put('/update/{id}','CommentController@update')->name('admin.market.comment.update');
            Route::delete('/destroy/{id}','CommentController@destroy')->name('admin.market.comment.destroy');
        });

        Route::prefix('delivery')->group(function (){
            Route::get('/','DeliveryController@index')->name('admin.market.delivery.index');
            Route::get('/create','DeliveryController@create')->name('admin.market.delivery.create');
            Route::post('/store','DeliveryController@store')->name('admin.market.delivery.store');
            Route::get('/edit/{id}','DeliveryController@edit')->name('admin.market.delivery.edit');
            Route::put('/update/{id}','DeliveryController@update')->name('admin.market.delivery.update');
            Route::delete('/destroy/{id}','DeliveryController@destroy')->name('admin.market.delivery.destroy');
        });

        Route::prefix('discount')->group(function (){
            Route::prefix('copan')->group(function (){
                Route::get('/','DiscountController@copanIndex')->name('admin.market.discount.copan.index');
                Route::get('/create','DiscountController@copanCreate')->name('admin.market.discount.copan.create');
                Route::post('/store','DiscountController@copanStore')->name('admin.market.discount.copan.store');
                Route::get('/edit/{id}','DiscountController@copanEdit')->name('admin.market.discount.copan.edit');
                Route::put('/update/{id}','DiscountController@copanUpdate')->name('admin.market.discount.copan.update');
                Route::delete('/destroy/{id}','DiscountController@copanDestroy')->name('admin.market.discount.copan.destroy');
            });
            Route::prefix('common-discount')->group(function (){
                Route::get('/','DiscountController@commonDiscountIndex')->name('admin.market.discount.common-discount.index');
                Route::get('/create','DiscountController@commonDiscountCreate')->name('admin.market.discount.common-discount.create');
                Route::post('/store','DiscountController@commonDiscountStore')->name('admin.market.discount.common-discount.store');
                Route::get('/edit/{id}','DiscountController@commonDiscountEdit')->name('admin.market.discount.common-discount.edit');
                Route::put('/update/{id}','DiscountController@commonDiscountUpdate')->name('admin.market.discount.common-discount.update');
                Route::delete('/destroy/{id}','DiscountController@commonDiscountDestroy')->name('admin.market.discount.common-discount.destroy');
            });

            Route::prefix('amazing-sale')->group(function (){
                Route::get('/','DiscountController@amazingSaleIndex')->name('admin.market.discount.amazing-sale.index');
                Route::get('/create','DiscountController@amazingSaleCreate')->name('admin.market.discount.amazing-sale.create');
                Route::post('/store','DiscountController@amazingSaleStore')->name('admin.market.discount.amazing-sale.store');
                Route::get('/edit/{id}','DiscountController@amazingSaleEdit')->name('admin.market.discount.amazing-sale.edit');
                Route::put('/update/{id}','DiscountController@amazingSaleUpdate')->name('admin.market.discount.amazing-sale.update');
                Route::delete('/destroy/{id}','DiscountController@amazingSaleDestroy')->name('admin.market.discount.amazing-sale.destroy');
            });
        });


        Route::prefix('order')->group(function (){
            Route::get('/','OrderController@all')->name('admin.market.order.all');
            Route::get('/new-order','OrderController@newOrder')->name('admin.market.order.new-order');
            Route::get('/sending','OrderController@sending')->name('admin.market.order.sending');
            Route::get('/unpaid','OrderController@unpaid')->name('admin.market.order.unpaid');
            Route::get('/canceled','OrderController@canceled')->name('admin.market.order.canceled');
            Route::get('/returned','OrderController@returned')->name('admin.market.order.returned');
            Route::get('/show/{id}','OrderController@show')->name('admin.market.order.show');
            Route::get('/change-send-status/{id}','OrderController@changeSendStatus')->name('admin.market.order.change-send-status');
            Route::get('/change-order-status/{id}','OrderController@changeOrderStatus')->name('admin.market.order.change-order-status');
            Route::get('/cancel-order/{id}','OrderController@cancel-order')->name('admin.market.order.cancel-order');
        });


        Route::prefix('payment')->group(function (){
            Route::get('/','PaymentController@all')->name('admin.market.payment.all');
            Route::get('/online','PaymentController@online')->name('admin.market.payment.online');
            Route::get('/offline','PaymentController@offline')->name('admin.market.payment.offline');
            Route::get('/attendance','PaymentController@attendance')->name('admin.market.payment.attendance');
            Route::get('/confirm','PaymentController@confirm')->name('admin.market.payment.confirm');
            Route::get('/show','PaymentController@show')->name('admin.market.payment.show');
            Route::get('/cancel','PaymentController@cancel')->name('admin.market.payment.cancel');
            Route::get('/payback','PaymentController@payback')->name('admin.market.payment.payback');
        });

        Route::prefix('product')->group(function (){
            Route::get('/','ProductController@index')->name('admin.market.product.index');
            Route::get('/create','ProductController@create')->name('admin.market.product.create');
            Route::post('/store','ProductController@store')->name('admin.market.product.store');
            Route::get('/edit/{id}','ProductController@edit')->name('admin.market.product.edit');
            Route::put('/update/{id}','ProductController@update')->name('admin.market.product.update');
            Route::delete('/destroy/{id}','ProductController@destroy')->name('admin.market.product.destroy');

            Route::get('/gallery','ProductGalleryController@index')->name('admin.market.product.gallery.index');
            Route::post('/gallery/store','ProductGalleryController@store')->name('admin.market.product.gallery.store');
            Route::delete('/gallery/destroy/{id}','ProductGalleryController@destroy')->name('admin.market.product.gallery.destroy');
        });
    });
});
