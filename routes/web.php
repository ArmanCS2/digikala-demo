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

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {

    Route::get('/', 'AdminDashboardController@index')->name('admin.home');

    Route::prefix('market')->namespace('Market')->group(function () {

        Route::prefix('category')->group(function () {
            Route::get('/', 'CategoryController@index')->name('admin.market.category.index');
            Route::get('/create', 'CategoryController@create')->name('admin.market.category.create');
            Route::post('/store', 'CategoryController@store')->name('admin.market.category.store');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('admin.market.category.edit');
            Route::put('/update/{id}', 'CategoryController@update')->name('admin.market.category.update');
            Route::delete('/destroy/{id}', 'CategoryController@destroy')->name('admin.market.category.destroy');
        });

        Route::prefix('brand')->group(function () {
            Route::get('/', 'BrandController@index')->name('admin.market.brand.index');
            Route::get('/create', 'BrandController@create')->name('admin.market.brand.create');
            Route::post('/store', 'BrandController@store')->name('admin.market.brand.store');
            Route::get('/edit/{id}', 'BrandController@edit')->name('admin.market.brand.edit');
            Route::put('/update/{id}', 'BrandController@update')->name('admin.market.brand.update');
            Route::delete('/destroy/{id}', 'BrandController@destroy')->name('admin.market.brand.destroy');
        });

        Route::prefix('comment')->group(function () {
            Route::get('/', 'CommentController@index')->name('admin.market.comment.index');
            Route::get('/show', 'CommentController@show')->name('admin.market.comment.show');
            Route::post('/store', 'CommentController@store')->name('admin.market.comment.store');
            Route::get('/edit/{id}', 'CommentController@edit')->name('admin.market.comment.edit');
            Route::put('/update/{id}', 'CommentController@update')->name('admin.market.comment.update');
            Route::delete('/destroy/{id}', 'CommentController@destroy')->name('admin.market.comment.destroy');
        });

        Route::prefix('delivery')->group(function () {
            Route::get('/', 'DeliveryController@index')->name('admin.market.delivery.index');
            Route::get('/create', 'DeliveryController@create')->name('admin.market.delivery.create');
            Route::post('/store', 'DeliveryController@store')->name('admin.market.delivery.store');
            Route::get('/edit/{id}', 'DeliveryController@edit')->name('admin.market.delivery.edit');
            Route::put('/update/{id}', 'DeliveryController@update')->name('admin.market.delivery.update');
            Route::delete('/destroy/{id}', 'DeliveryController@destroy')->name('admin.market.delivery.destroy');
        });

        Route::prefix('discount')->group(function () {
            Route::prefix('copan')->group(function () {
                Route::get('/', 'DiscountController@copanIndex')->name('admin.market.discount.copan.index');
                Route::get('/create', 'DiscountController@copanCreate')->name('admin.market.discount.copan.create');
                Route::post('/store', 'DiscountController@copanStore')->name('admin.market.discount.copan.store');
                Route::get('/edit/{id}', 'DiscountController@copanEdit')->name('admin.market.discount.copan.edit');
                Route::put('/update/{id}', 'DiscountController@copanUpdate')->name('admin.market.discount.copan.update');
                Route::delete('/destroy/{id}', 'DiscountController@copanDestroy')->name('admin.market.discount.copan.destroy');
            });

            Route::prefix('common-discount')->group(function () {
                Route::get('/', 'DiscountController@commonDiscountIndex')->name('admin.market.discount.common-discount.index');
                Route::get('/create', 'DiscountController@commonDiscountCreate')->name('admin.market.discount.common-discount.create');
                Route::post('/store', 'DiscountController@commonDiscountStore')->name('admin.market.discount.common-discount.store');
                Route::get('/edit/{id}', 'DiscountController@commonDiscountEdit')->name('admin.market.discount.common-discount.edit');
                Route::put('/update/{id}', 'DiscountController@commonDiscountUpdate')->name('admin.market.discount.common-discount.update');
                Route::delete('/destroy/{id}', 'DiscountController@commonDiscountDestroy')->name('admin.market.discount.common-discount.destroy');
            });

            Route::prefix('amazing-sale')->group(function () {
                Route::get('/', 'DiscountController@amazingSaleIndex')->name('admin.market.discount.amazing-sale.index');
                Route::get('/create', 'DiscountController@amazingSaleCreate')->name('admin.market.discount.amazing-sale.create');
                Route::post('/store', 'DiscountController@amazingSaleStore')->name('admin.market.discount.amazing-sale.store');
                Route::get('/edit/{id}', 'DiscountController@amazingSaleEdit')->name('admin.market.discount.amazing-sale.edit');
                Route::put('/update/{id}', 'DiscountController@amazingSaleUpdate')->name('admin.market.discount.amazing-sale.update');
                Route::delete('/destroy/{id}', 'DiscountController@amazingSaleDestroy')->name('admin.market.discount.amazing-sale.destroy');
            });
        });


        Route::prefix('order')->group(function () {
            Route::get('/', 'OrderController@all')->name('admin.market.order.all');
            Route::get('/new-order', 'OrderController@newOrder')->name('admin.market.order.new-order');
            Route::get('/sending', 'OrderController@sending')->name('admin.market.order.sending');
            Route::get('/unpaid', 'OrderController@unpaid')->name('admin.market.order.unpaid');
            Route::get('/canceled', 'OrderController@canceled')->name('admin.market.order.canceled');
            Route::get('/returned', 'OrderController@returned')->name('admin.market.order.returned');
            Route::get('/show/{id}', 'OrderController@show')->name('admin.market.order.show');
            Route::get('/change-send-status/{id}', 'OrderController@changeSendStatus')->name('admin.market.order.change-send-status');
            Route::get('/change-order-status/{id}', 'OrderController@changeOrderStatus')->name('admin.market.order.change-order-status');
            Route::get('/cancel-order/{id}', 'OrderController@cancel-order')->name('admin.market.order.cancel-order');
        });


        Route::prefix('payment')->group(function () {
            Route::get('/', 'PaymentController@all')->name('admin.market.payment.all');
            Route::get('/online', 'PaymentController@online')->name('admin.market.payment.online');
            Route::get('/offline', 'PaymentController@offline')->name('admin.market.payment.offline');
            Route::get('/attendance', 'PaymentController@attendance')->name('admin.market.payment.attendance');
            Route::get('/confirm', 'PaymentController@confirm')->name('admin.market.payment.confirm');
            Route::get('/show', 'PaymentController@show')->name('admin.market.payment.show');
            Route::get('/cancel', 'PaymentController@cancel')->name('admin.market.payment.cancel');
            Route::get('/payback', 'PaymentController@payback')->name('admin.market.payment.payback');
        });

        Route::prefix('product')->group(function () {
            Route::get('/', 'ProductController@index')->name('admin.market.product.index');
            Route::get('/create', 'ProductController@create')->name('admin.market.product.create');
            Route::post('/store', 'ProductController@store')->name('admin.market.product.store');
            Route::get('/edit/{id}', 'ProductController@edit')->name('admin.market.product.edit');
            Route::put('/update/{id}', 'ProductController@update')->name('admin.market.product.update');
            Route::delete('/destroy/{id}', 'ProductController@destroy')->name('admin.market.product.destroy');

            Route::get('/gallery', 'ProductGalleryController@index')->name('admin.market.product.gallery.index');
            Route::post('/gallery/store', 'ProductGalleryController@store')->name('admin.market.product.gallery.store');
            Route::delete('/gallery/destroy/{id}', 'ProductGalleryController@destroy')->name('admin.market.product.gallery.destroy');
        });

        Route::prefix('property')->group(function () {
            Route::get('/', 'PropertyController@index')->name('admin.market.property.index');
            Route::get('/create', 'PropertyController@create')->name('admin.market.property.create');
            Route::post('/store', 'PropertyController@store')->name('admin.market.property.store');
            Route::get('/edit/{id}', 'PropertyController@edit')->name('admin.market.property.edit');
            Route::put('/update/{id}', 'PropertyController@update')->name('admin.market.property.update');
            Route::delete('/destroy/{id}', 'PropertyController@destroy')->name('admin.market.property.destroy');
        });

        Route::prefix('storage')->group(function () {
            Route::get('/', 'StorageController@index')->name('admin.market.storage.index');
            Route::get('/add-product', 'StorageController@addProduct')->name('admin.market.storage.add-product');
            Route::post('/store', 'StorageController@store')->name('admin.market.storage.store');
            Route::get('/edit/{id}', 'StorageController@edit')->name('admin.market.storage.edit');
            Route::put('/update/{id}', 'StorageController@update')->name('admin.market.storage.update');
            Route::delete('/destroy/{id}', 'StorageController@destroy')->name('admin.market.storage.destroy');
        });
    });


    Route::prefix('content')->namespace('Content')->group(function () {

        Route::prefix('category')->group(function () {
            Route::get('/', 'CategoryController@index')->name('admin.content.category.index');
            Route::get('/create', 'CategoryController@create')->name('admin.content.category.create');
            Route::post('/store', 'CategoryController@store')->name('admin.content.category.store');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('admin.content.category.edit');
            Route::put('/update/{id}', 'CategoryController@update')->name('admin.content.category.update');
            Route::delete('/destroy/{id}', 'CategoryController@destroy')->name('admin.content.category.destroy');
            Route::get('/change-status/{id}', 'CategoryController@changeStatus')->name('admin.content.category.change-status');
            Route::get('/ajax/change-status/{id}', 'CategoryController@ajaxChangeStatus')->name('admin.content.category.ajax.change-status');
        });

        Route::prefix('comment')->group(function () {
            Route::get('/', 'CommentController@index')->name('admin.content.comment.index');
            Route::get('/show', 'CommentController@show')->name('admin.content.comment.show');
            Route::post('/store', 'CommentController@store')->name('admin.content.comment.store');
            Route::get('/edit/{id}', 'CommentController@edit')->name('admin.content.comment.edit');
            Route::put('/update/{id}', 'CommentController@update')->name('admin.content.comment.update');
            Route::delete('/destroy/{id}', 'CommentController@destroy')->name('admin.content.comment.destroy');
        });


        Route::prefix('faq')->group(function () {
            Route::get('/', 'FAQController@index')->name('admin.content.faq.index');
            Route::get('/create', 'FAQController@create')->name('admin.content.faq.create');
            Route::post('/store', 'FAQController@store')->name('admin.content.faq.store');
            Route::get('/edit/{id}', 'FAQController@edit')->name('admin.content.faq.edit');
            Route::put('/update/{id}', 'FAQController@update')->name('admin.content.faq.update');
            Route::delete('/destroy/{id}', 'FAQController@destroy')->name('admin.content.faq.destroy');
        });


        Route::prefix('menu')->group(function () {
            Route::get('/', 'MenuController@index')->name('admin.content.menu.index');
            Route::get('/create', 'MenuController@create')->name('admin.content.menu.create');
            Route::post('/store', 'MenuController@store')->name('admin.content.menu.store');
            Route::get('/edit/{id}', 'MenuController@edit')->name('admin.content.menu.edit');
            Route::put('/update/{id}', 'MenuController@update')->name('admin.content.menu.update');
            Route::delete('/destroy/{id}', 'MenuController@destroy')->name('admin.content.menu.destroy');
        });


        Route::prefix('page')->group(function () {
            Route::get('/', 'PageController@index')->name('admin.content.page.index');
            Route::get('/create', 'PageController@create')->name('admin.content.page.create');
            Route::post('/store', 'PageController@store')->name('admin.content.page.store');
            Route::get('/edit/{id}', 'PageController@edit')->name('admin.content.page.edit');
            Route::put('/update/{id}', 'PageController@update')->name('admin.content.page.update');
            Route::delete('/destroy/{id}', 'PageController@destroy')->name('admin.content.page.destroy');
        });


        Route::prefix('post')->group(function () {
            Route::get('/', 'PostController@index')->name('admin.content.post.index');
            Route::get('/create', 'PostController@create')->name('admin.content.post.create');
            Route::post('/store', 'PostController@store')->name('admin.content.post.store');
            Route::get('/edit/{id}', 'PostController@edit')->name('admin.content.post.edit');
            Route::put('/update/{id}', 'PostController@update')->name('admin.content.post.update');
            Route::delete('/destroy/{id}', 'PostController@destroy')->name('admin.content.post.destroy');
        });
    });


    Route::prefix('user')->namespace('User')->group(function () {

        Route::prefix('admin-user')->group(function () {
            Route::get('/', 'AdminUserController@index')->name('admin.user.admin-user.index');
            Route::get('/create', 'AdminUserController@create')->name('admin.user.admin-user.create');
            Route::post('/store', 'AdminUserController@store')->name('admin.user.admin-user.store');
            Route::get('/edit/{id}', 'AdminUserController@edit')->name('admin.user.admin-user.edit');
            Route::put('/update/{id}', 'AdminUserController@update')->name('admin.user.admin-user.update');
            Route::delete('/destroy/{id}', 'AdminUserController@destroy')->name('admin.user.admin-user.destroy');
        });
        Route::prefix('customer')->group(function () {
            Route::get('/', 'CustomerController@index')->name('admin.user.customer.index');
            Route::get('/create', 'CustomerController@create')->name('admin.user.customer.create');
            Route::post('/store', 'CustomerController@store')->name('admin.user.customer.store');
            Route::get('/edit/{id}', 'CustomerController@edit')->name('admin.user.customer.edit');
            Route::put('/update/{id}', 'CustomerController@update')->name('admin.user.customer.update');
            Route::delete('/destroy/{id}', 'CustomerController@destroy')->name('admin.user.customer.destroy');
        });
        Route::prefix('role')->group(function () {
            Route::get('/', 'RoleController@index')->name('admin.user.role.index');
            Route::get('/create', 'RoleController@create')->name('admin.user.role.create');
            Route::post('/store', 'RoleController@store')->name('admin.user.role.store');
            Route::get('/edit/{id}', 'RoleController@edit')->name('admin.user.role.edit');
            Route::put('/update/{id}', 'RoleController@update')->name('admin.user.role.update');
            Route::delete('/destroy/{id}', 'RoleController@destroy')->name('admin.user.role.destroy');
        });
        Route::prefix('permission')->group(function () {
            Route::get('/', 'PermissionController@index')->name('admin.user.permission.index');
            Route::get('/create', 'PermissionController@create')->name('admin.user.permission.create');
            Route::post('/store', 'PermissionController@store')->name('admin.user.permission.store');
            Route::get('/edit/{id}', 'PermissionController@edit')->name('admin.user.permission.edit');
            Route::put('/update/{id}', 'PermissionController@update')->name('admin.user.permission.update');
            Route::delete('/destroy/{id}', 'PermissionController@destroy')->name('admin.user.permission.destroy');
        });
    });

    Route::prefix('notify')->namespace('Notify')->group(function () {
        Route::prefix('email')->group(function () {
            Route::get('/', 'EmailController@index')->name('admin.notify.email.index');
            Route::get('/create', 'EmailController@create')->name('admin.notify.email.create');
            Route::post('/store', 'EmailController@store')->name('admin.notify.email.store');
            Route::get('/edit/{id}', 'EmailController@edit')->name('admin.notify.email.edit');
            Route::put('/update/{id}', 'EmailController@update')->name('admin.notify.email.update');
            Route::delete('/destroy/{id}', 'EmailController@destroy')->name('admin.notify.email.destroy');
        });
        Route::prefix('sms')->group(function () {
            Route::get('/', 'SMSController@index')->name('admin.notify.sms.index');
            Route::get('/create', 'SMSController@create')->name('admin.notify.sms.create');
            Route::post('/store', 'SMSController@store')->name('admin.notify.sms.store');
            Route::get('/edit/{id}', 'SMSController@edit')->name('admin.notify.sms.edit');
            Route::put('/update/{id}', 'SMSController@update')->name('admin.notify.sms.update');
            Route::delete('/destroy/{id}', 'SMSController@destroy')->name('admin.notify.sms.destroy');
        });
    });


    Route::prefix('ticket')->namespace('Ticket')->group(function () {
        Route::get('/new-ticket', 'TicketController@newTicket')->name('admin.ticket.new-ticket');
        Route::get('/open-ticket', 'TicketController@openTicket')->name('admin.ticket.open-ticket');
        Route::get('/close-ticket', 'TicketController@closeTicket')->name('admin.ticket.close-ticket');
        Route::get('/', 'TicketController@index')->name('admin.ticket.index');
        Route::get('/show', 'TicketController@show')->name('admin.ticket.show');
        Route::get('/create', 'TicketController@create')->name('admin.ticket.create');
        Route::post('/store', 'TicketController@store')->name('admin.ticket.store');
        Route::get('/edit/{id}', 'TicketController@edit')->name('admin.ticket.edit');
        Route::put('/update/{id}', 'TicketController@update')->name('admin.ticket.update');
        Route::delete('/destroy/{id}', 'TicketController@destroy')->name('admin.ticket.destroy');
    });

    Route::prefix('setting')->namespace('Setting')->group(function () {
        Route::get('/', 'SettingController@index')->name('admin.setting.index');
        Route::get('/create', 'SettingController@create')->name('admin.setting.create');
        Route::post('/store', 'SettingController@store')->name('admin.setting.store');
        Route::get('/edit/{id}', 'SettingController@edit')->name('admin.setting.edit');
        Route::put('/update/{id}', 'SettingController@update')->name('admin.setting.update');
        Route::delete('/destroy/{id}', 'SettingController@destroy')->name('admin.setting.destroy');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
