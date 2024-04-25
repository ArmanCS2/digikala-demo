<?php

use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\App\Content\PostController;
use App\Http\Controllers\App\HomeController;
use App\Http\Controllers\App\Market\AddressController;
use App\Http\Controllers\App\Market\CartController;
use App\Http\Controllers\App\Market\PaymentController;
use App\Http\Controllers\App\Market\ProductController;
use App\Http\Controllers\App\ProfileController;
use Illuminate\Support\Facades\Artisan;
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


/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:super-admin'])->get('site/off', function () {
    return Artisan::call('down', ['--secret' => 'arman']);
});

Route::get('site/up', function () {
    return Artisan::call('up');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/download/{file_path}', [HomeController::class, 'download'])->name('download');
Route::post('ckeditor-upload', [HomeController::class, 'ckeditorUpload'])->name('ckeditor.upload');
Route::get('page/{title}', [HomeController::class, 'page'])->name('page');
Route::middleware('auth')->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/complete', [ProfileController::class, 'complete'])->name('profile.complete');
    Route::put('/update-complete', [ProfileController::class, 'updateComplete'])->name('profile.update.complete');
    Route::get('/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/favorites', [ProfileController::class, 'favorites'])->name('profile.favorites');
    Route::get('/compares', [ProfileController::class, 'compares'])->name('profile.compares');
    Route::get('/delete-from-favorites/{product}', [ProfileController::class, 'deleteFromFavorites'])->name('profile.delete-from-favorites');
    Route::prefix('ticket')->group(function () {
        Route::get('/', [\App\Http\Controllers\App\TicketController::class, 'index'])->name('profile.ticket.index');
        Route::get('/show/{id}', [\App\Http\Controllers\App\TicketController::class, 'show'])->name('profile.ticket.show');
        Route::get('/change-status/{id}', [\App\Http\Controllers\App\TicketController::class, 'changeStatus'])->name('profile.ticket.change-status');
        Route::post('/answer/{id}', [\App\Http\Controllers\App\TicketController::class, 'answer'])->name('profile.ticket.answer');
        Route::get('/create', [\App\Http\Controllers\App\TicketController::class, 'create'])->name('profile.ticket.create');
        Route::post('/store', [\App\Http\Controllers\App\TicketController::class, 'store'])->name('profile.ticket.store');
    });
});
Route::prefix('market')->group(function () {
    Route::get('/products', [ProductController::class, 'products'])->name('market.products');
    Route::get('/amazing-sales', [ProductController::class, 'amazingSales'])->name('market.amazing-sales');
    Route::prefix('product')->group(function () {
        Route::get('/{product:slug}', [ProductController::class, 'product'])->name('market.product');
        Route::post('/{product:slug}/store-comment', [ProductController::class, 'storeComment'])->name('market.product.store-comment');
        Route::get('/{product:slug}/is-favorite', [ProductController::class, 'isFavorite'])->name('market.product.is-favorite');
        Route::get('/{product:slug}/add-to-compare', [ProductController::class, 'addToCompare'])->name('market.product.add-to-compare');
        Route::get('/{product:slug}/remove-from-compare', [ProductController::class, 'removeFromCompare'])->name('market.product.remove-from-compare');
        Route::post('/{product:slug}/rate', [ProductController::class, 'rate'])->name('market.product.rate');
    });

    Route::middleware('product-marketable')->prefix('cart')->group(function () {
        Route::middleware('cart.empty')->get('/', [CartController::class, 'cart'])->name('market.cart');
        Route::put('update', [CartController::class, 'update'])->name('market.cart.update');
        Route::post('add-product/{product:slug}', [CartController::class, 'addProduct'])->name('market.cart.add-product');
        Route::get('add-product/{product:slug}', [CartController::class, 'addProduct'])->name('market.cart.add-product');
        Route::get('remove-product/{cartItem}', [CartController::class, 'removeProduct'])->name('market.cart.remove-product');
    });

    Route::middleware(['profile.complete', 'cart.empty', 'product-marketable'])->group(function () {
        //address and delivery
        Route::get('address-and-delivery', [AddressController::class, 'addressAndDelivery'])->name('market.address-and-delivery');
        Route::post('add-address', [AddressController::class, 'addAddress'])->name('market.add-address');
        Route::post('store-address-delivery', [AddressController::class, 'storeAddressDelivery'])->name('market.store-address-delivery');
        Route::put('edit-address/{address}', [AddressController::class, 'editAddress'])->name('market.edit-address');
        Route::get('delete-address/{address}', [AddressController::class, 'deleteAddress'])->name('market.delete-address');
        Route::get('get-cities/{province}', [AddressController::class, 'getCities'])->name('market.get-cities');

        //payment
        Route::get('payment', [PaymentController::class, 'payment'])->name('market.payment');
        Route::post('payment-copan-discount', [PaymentController::class, 'copanDiscount'])->name('market.payment.copan-discount');
        Route::post('payment-type', [PaymentController::class, 'paymentType'])->name('market.payment.type');
        Route::any('payment-callback/{order}/{amount}/{onlinePayment}', [PaymentController::class, 'paymentCallback'])->name('market.payment-callback');
    });

});
Route::prefix('content')->group(function () {
    Route::get('posts', [PostController::class, 'posts'])->name('content.posts');
    Route::prefix('post')->group(function () {
        Route::get('/{post:slug}', [PostController::class, 'post'])->name('content.post');
        Route::post('/{post:slug}/store-comment', [PostController::class, 'storeComment'])->name('content.post.store-comment');
    });


});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->namespace('App\Http\Controllers\Auth')->group(function () {
    Route::prefix('customer')->namespace('Customer')->group(function () {
        Route::get('login-register', 'LoginRegisterController@loginRegisterForm')->name('auth.customer.login-register-form');
        Route::middleware('throttle:login-register-limiter')->post('login-register', 'LoginRegisterController@loginRegister')->name('auth.customer.login-register');
        Route::get('login-confirm/{token}', 'LoginRegisterController@loginConfirmForm')->name('auth.customer.login-confirm-form');
        Route::middleware('throttle:login-confirm-limiter')->post('login-confirm/{token}', 'LoginRegisterController@loginConfirm')->name('auth.customer.login-confirm');
        Route::middleware('throttle:login-resend-otp-limiter')->get('login-resend-otp/{token}', 'LoginRegisterController@loginResendOtp')->name('auth.customer.login-resend-otp');
        Route::get('logout', 'LoginRegisterController@logout')->name('auth.customer.logout');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {

    Route::get('/', 'AdminDashboardController@index')->name('admin.home');
    Route::post('/notification/read-all', 'NotificationController@readAll')->name('admin.notification.read-all');

    Route::prefix('market')->namespace('Market')->group(function () {

        Route::prefix('category')->group(function () {
            Route::get('/', 'CategoryController@index')->name('admin.market.category.index');
            Route::get('/create', 'CategoryController@create')->name('admin.market.category.create');
            Route::post('/store', 'CategoryController@store')->name('admin.market.category.store');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('admin.market.category.edit');
            Route::put('/update/{id}', 'CategoryController@update')->name('admin.market.category.update');
            Route::delete('/destroy/{id}', 'CategoryController@destroy')->name('admin.market.category.destroy');
            Route::get('/ajax/change-status/{id}', 'CategoryController@ajaxChangeStatus')->name('admin.market.category.ajax.change-status');
            Route::get('/ajax/change-visibility/{id}', 'CategoryController@ajaxChangeVisibility')->name('admin.market.category.ajax.change-visibility');


            Route::prefix('attribute')->group(function () {
                Route::get('/', 'CategoryAttributeController@index')->name('admin.market.category.attribute.index');
                Route::get('/create', 'CategoryAttributeController@create')->name('admin.market.category.attribute.create');
                Route::post('/store', 'CategoryAttributeController@store')->name('admin.market.category.attribute.store');
                Route::get('/edit/{id}', 'CategoryAttributeController@edit')->name('admin.market.category.attribute.edit');
                Route::put('/update/{id}', 'CategoryAttributeController@update')->name('admin.market.category.attribute.update');
                Route::delete('/destroy/{id}', 'CategoryAttributeController@destroy')->name('admin.market.category.attribute.destroy');

                Route::get('/value/{id}', 'CategoryValueController@index')->name('admin.market.category.attribute.value.index');
                Route::get('/value/create/{id}', 'CategoryValueController@create')->name('admin.market.category.attribute.value.create');
                Route::post('/value/store/{id}', 'CategoryValueController@store')->name('admin.market.category.attribute.value.store');
                Route::get('/value/edit/{id}', 'CategoryValueController@edit')->name('admin.market.category.attribute.value.edit');
                Route::put('/value/update/{id}', 'CategoryValueController@update')->name('admin.market.category.attribute.value.update');
                Route::delete('/value/destroy/{id}', 'CategoryValueController@destroy')->name('admin.market.category.attribute.value.destroy');
            });

        });

        Route::prefix('brand')->group(function () {
            Route::get('/', 'BrandController@index')->name('admin.market.brand.index');
            Route::get('/create', 'BrandController@create')->name('admin.market.brand.create');
            Route::post('/store', 'BrandController@store')->name('admin.market.brand.store');
            Route::get('/edit/{id}', 'BrandController@edit')->name('admin.market.brand.edit');
            Route::put('/update/{id}', 'BrandController@update')->name('admin.market.brand.update');
            Route::delete('/destroy/{id}', 'BrandController@destroy')->name('admin.market.brand.destroy');
            Route::get('/ajax/change-status/{id}', 'BrandController@ajaxChangeStatus')->name('admin.market.brand.ajax.change-status');
        });

        Route::prefix('comment')->group(function () {

            Route::get('/', 'CommentController@index')->name('admin.market.comment.index');
            Route::get('/show/{id}', 'CommentController@show')->name('admin.market.comment.show');
            Route::delete('/destroy/{id}', 'CommentController@destroy')->name('admin.market.comment.destroy');
            Route::get('/approved/{id}', 'CommentController@approved')->name('admin.market.comment.approved');
            Route::get('/ajax/change-status/{id}', 'CommentController@ajaxChangeStatus')->name('admin.market.comment.ajax.change-status');
            Route::post('answer/{id}', 'CommentController@answer')->name('admin.market.comment.answer');

        });

        Route::prefix('delivery')->group(function () {
            Route::get('/', 'DeliveryController@index')->name('admin.market.delivery.index');
            Route::get('/create', 'DeliveryController@create')->name('admin.market.delivery.create');
            Route::post('/store', 'DeliveryController@store')->name('admin.market.delivery.store');
            Route::get('/edit/{id}', 'DeliveryController@edit')->name('admin.market.delivery.edit');
            Route::put('/update/{id}', 'DeliveryController@update')->name('admin.market.delivery.update');
            Route::delete('/destroy/{id}', 'DeliveryController@destroy')->name('admin.market.delivery.destroy');
            Route::get('/ajax/change-status/{id}', 'DeliveryController@ajaxChangeStatus')->name('admin.market.delivery.ajax.change-status');
        });

        Route::prefix('discount')->group(function () {
            Route::prefix('copan')->group(function () {
                Route::get('/', 'DiscountController@copanIndex')->name('admin.market.discount.copan.index');
                Route::get('/create', 'DiscountController@copanCreate')->name('admin.market.discount.copan.create');
                Route::post('/store', 'DiscountController@copanStore')->name('admin.market.discount.copan.store');
                Route::get('/edit/{id}', 'DiscountController@copanEdit')->name('admin.market.discount.copan.edit');
                Route::put('/update/{id}', 'DiscountController@copanUpdate')->name('admin.market.discount.copan.update');
                Route::delete('/destroy/{id}', 'DiscountController@copanDestroy')->name('admin.market.discount.copan.destroy');
                Route::get('/ajax/change-status/{id}', 'DiscountController@ajaxChangeCopanStatus')->name('admin.market.discount.copan.ajax.change-status');
            });

            Route::prefix('common-discount')->group(function () {
                Route::get('/', 'DiscountController@commonDiscountIndex')->name('admin.market.discount.common-discount.index');
                Route::get('/create', 'DiscountController@commonDiscountCreate')->name('admin.market.discount.common-discount.create');
                Route::post('/store', 'DiscountController@commonDiscountStore')->name('admin.market.discount.common-discount.store');
                Route::get('/edit/{id}', 'DiscountController@commonDiscountEdit')->name('admin.market.discount.common-discount.edit');
                Route::put('/update/{id}', 'DiscountController@commonDiscountUpdate')->name('admin.market.discount.common-discount.update');
                Route::delete('/destroy/{id}', 'DiscountController@commonDiscountDestroy')->name('admin.market.discount.common-discount.destroy');
                Route::get('/ajax/change-status/{id}', 'DiscountController@ajaxChangeCommonDiscountStatus')->name('admin.market.discount.common-discount.ajax.change-status');
            });

            Route::prefix('amazing-sale')->group(function () {
                Route::get('/', 'DiscountController@amazingSaleIndex')->name('admin.market.discount.amazing-sale.index');
                Route::get('/create', 'DiscountController@amazingSaleCreate')->name('admin.market.discount.amazing-sale.create');
                Route::post('/store', 'DiscountController@amazingSaleStore')->name('admin.market.discount.amazing-sale.store');
                Route::get('/edit/{id}', 'DiscountController@amazingSaleEdit')->name('admin.market.discount.amazing-sale.edit');
                Route::put('/update/{id}', 'DiscountController@amazingSaleUpdate')->name('admin.market.discount.amazing-sale.update');
                Route::delete('/destroy/{id}', 'DiscountController@amazingSaleDestroy')->name('admin.market.discount.amazing-sale.destroy');
                Route::get('/ajax/change-status/{id}', 'DiscountController@ajaxChangeAmazingSaleStatus')->name('admin.market.discount.amazing-sale.ajax.change-status');
            });
        });


        Route::prefix('order')->group(function () {
            Route::get('/', 'OrderController@all')->name('admin.market.order.all');
            Route::get('/edit/{order}', 'OrderController@edit')->name('admin.market.order.edit');
            Route::put('/update/{order}', 'OrderController@update')->name('admin.market.order.update');
            Route::get('/new-order', 'OrderController@newOrder')->name('admin.market.order.new-order');
            Route::get('/sending', 'OrderController@sending')->name('admin.market.order.sending');
            Route::get('/unpaid', 'OrderController@unpaid')->name('admin.market.order.unpaid');
            Route::get('/canceled', 'OrderController@canceled')->name('admin.market.order.canceled');
            Route::get('/returned', 'OrderController@returned')->name('admin.market.order.returned');
            Route::get('/show-factor/{id}', 'OrderController@showFactor')->name('admin.market.order.show-factor');
            Route::get('/show-detail/{id}', 'OrderController@showDetail')->name('admin.market.order.show-detail');
            Route::get('/change-send-status/{id}', 'OrderController@changeSendStatus')->name('admin.market.order.change-send-status');
            Route::get('/change-order-status/{id}', 'OrderController@changeOrderStatus')->name('admin.market.order.change-order-status');
            Route::get('/cancel-order/{id}', 'OrderController@cancelOrder')->name('admin.market.order.cancel-order');
        });


        Route::prefix('payment')->group(function () {
            Route::get('/', 'PaymentController@index')->name('admin.market.payment.index');
            Route::get('/online', 'PaymentController@online')->name('admin.market.payment.online');
            Route::get('/offline', 'PaymentController@offline')->name('admin.market.payment.offline');
            Route::get('/cash', 'PaymentController@cash')->name('admin.market.payment.cash');
            Route::get('/confirm/{id}', 'PaymentController@confirm')->name('admin.market.payment.confirm');
            Route::get('/show/{id}', 'PaymentController@show')->name('admin.market.payment.show');
            Route::get('/cancel/{id}', 'PaymentController@cancel')->name('admin.market.payment.cancel');
            Route::get('/payback/{id}', 'PaymentController@payback')->name('admin.market.payment.payback');
        });

        Route::prefix('product')->group(function () {
            Route::get('/', 'ProductController@index')->name('admin.market.product.index');
            Route::get('/create', 'ProductController@create')->name('admin.market.product.create');
            Route::post('/store', 'ProductController@store')->name('admin.market.product.store');
            Route::get('/edit/{id}', 'ProductController@edit')->name('admin.market.product.edit');
            Route::put('/update/{id}', 'ProductController@update')->name('admin.market.product.update');
            Route::delete('/destroy/{id}', 'ProductController@destroy')->name('admin.market.product.destroy');
            Route::get('/ajax/change-status/{id}', 'ProductController@ajaxChangeStatus')->name('admin.market.product.ajax.change-status');
            Route::get('/ajax/change-marketable/{id}', 'ProductController@ajaxChangeMarketable')->name('admin.market.product.ajax.change-marketable');

            Route::get('/color/{id}', 'ProductColorController@index')->name('admin.market.product.color.index');
            Route::get('/color/create/{id}', 'ProductColorController@create')->name('admin.market.product.color.create');
            Route::post('/color/store/{id}', 'ProductColorController@store')->name('admin.market.product.color.store');
            Route::get('/color/edit/{id}', 'ProductColorController@edit')->name('admin.market.product.color.edit');
            Route::put('/color/update/{id}', 'ProductColorController@update')->name('admin.market.product.color.update');
            Route::delete('/color/destroy/{id}', 'ProductColorController@destroy')->name('admin.market.product.color.destroy');

            Route::get('/guarantee/{id}', 'GuaranteeController@index')->name('admin.market.product.guarantee.index');
            Route::get('/guarantee/create/{id}', 'GuaranteeController@create')->name('admin.market.product.guarantee.create');
            Route::post('/guarantee/store/{id}', 'GuaranteeController@store')->name('admin.market.product.guarantee.store');
            Route::get('/guarantee/edit/{id}', 'GuaranteeController@edit')->name('admin.market.product.guarantee.edit');
            Route::put('/guarantee/update/{id}', 'GuaranteeController@update')->name('admin.market.product.guarantee.update');
            Route::delete('/guarantee/destroy/{id}', 'GuaranteeController@destroy')->name('admin.market.product.guarantee.destroy');
            Route::get('/guarantee/ajax/change-status/{id}', 'GuaranteeController@ajaxChangeStatus')->name('admin.market.product.guarantee.ajax.change-status');

            Route::get('/image/{id}', 'ProductImageController@index')->name('admin.market.product.image.index');
            Route::get('/image/create/{id}', 'ProductImageController@create')->name('admin.market.product.image.create');
            Route::post('/image/store/{id}', 'ProductImageController@store')->name('admin.market.product.image.store');
            Route::delete('/image/destroy/{id}', 'ProductImageController@destroy')->name('admin.market.product.image.destroy');
        });


        Route::prefix('storage')->group(function () {
            Route::get('/', 'StorageController@index')->name('admin.market.storage.index');
            Route::get('/add-product/{id}', 'StorageController@addProduct')->name('admin.market.storage.add-product');
            Route::post('/store/{id}', 'StorageController@store')->name('admin.market.storage.store');
            Route::get('/edit/{id}', 'StorageController@edit')->name('admin.market.storage.edit');
            Route::put('/update/{id}', 'StorageController@update')->name('admin.market.storage.update');
        });
    });


    Route::prefix('content')->namespace('Content')->group(function () {


        Route::prefix('banner')->group(function () {
            Route::get('/', 'BannerController@index')->name('admin.content.banner.index');
            Route::get('/create', 'BannerController@create')->name('admin.content.banner.create');
            Route::post('/store', 'BannerController@store')->name('admin.content.banner.store');
            Route::get('/edit/{id}', 'BannerController@edit')->name('admin.content.banner.edit');
            Route::put('/update/{id}', 'BannerController@update')->name('admin.content.banner.update');
            Route::delete('/destroy/{id}', 'BannerController@destroy')->name('admin.content.banner.destroy');
            Route::get('/ajax/change-status/{id}', 'BannerController@ajaxChangeStatus')->name('admin.content.banner.ajax.change-status');
        });

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
            Route::get('/show/{id}', 'CommentController@show')->name('admin.content.comment.show');
            Route::delete('/destroy/{id}', 'CommentController@destroy')->name('admin.content.comment.destroy');
            Route::get('/approved/{id}', 'CommentController@approved')->name('admin.content.comment.approved');
            Route::get('/ajax/change-status/{id}', 'CommentController@ajaxChangeStatus')->name('admin.content.comment.ajax.change-status');
            Route::post('answer/{id}', 'CommentController@answer')->name('admin.content.comment.answer');
        });


        Route::prefix('faq')->group(function () {
            Route::get('/', 'FAQController@index')->name('admin.content.faq.index');
            Route::get('/create', 'FAQController@create')->name('admin.content.faq.create');
            Route::post('/store', 'FAQController@store')->name('admin.content.faq.store');
            Route::get('/edit/{id}', 'FAQController@edit')->name('admin.content.faq.edit');
            Route::put('/update/{id}', 'FAQController@update')->name('admin.content.faq.update');
            Route::delete('/destroy/{id}', 'FAQController@destroy')->name('admin.content.faq.destroy');
            Route::get('/ajax/change-status/{id}', 'FAQController@ajaxChangeStatus')->name('admin.content.faq.ajax.change-status');
        });


        Route::prefix('menu')->group(function () {
            Route::get('/', 'MenuController@index')->name('admin.content.menu.index');
            Route::get('/create', 'MenuController@create')->name('admin.content.menu.create');
            Route::post('/store', 'MenuController@store')->name('admin.content.menu.store');
            Route::get('/edit/{id}', 'MenuController@edit')->name('admin.content.menu.edit');
            Route::put('/update/{id}', 'MenuController@update')->name('admin.content.menu.update');
            Route::delete('/destroy/{id}', 'MenuController@destroy')->name('admin.content.menu.destroy');
            Route::get('/ajax/change-status/{id}', 'MenuController@ajaxChangeStatus')->name('admin.content.menu.ajax.change-status');
        });

        Route::prefix('footer')->group(function () {
            Route::get('/', 'FooterController@index')->name('admin.content.footer.index');
            Route::get('/create', 'FooterController@create')->name('admin.content.footer.create');
            Route::post('/store', 'FooterController@store')->name('admin.content.footer.store');
            Route::get('/edit/{footer}', 'FooterController@edit')->name('admin.content.footer.edit');
            Route::put('/update/{footer}', 'FooterController@update')->name('admin.content.footer.update');
            Route::delete('/destroy/{footer}', 'FooterController@destroy')->name('admin.content.footer.destroy');
            Route::get('/ajax/change-status/{footer}', 'FooterController@ajaxChangeStatus')->name('admin.content.footer.ajax.change-status');
        });


        Route::prefix('sub-footer')->group(function () {
            Route::get('/{footer}', 'SubFooterController@index')->name('admin.content.sub-footer.index');
            Route::get('/create/{footer}', 'SubFooterController@create')->name('admin.content.sub-footer.create');
            Route::post('/store/{footer}', 'SubFooterController@store')->name('admin.content.sub-footer.store');
            Route::get('/edit/{subFooter}', 'SubFooterController@edit')->name('admin.content.sub-footer.edit');
            Route::put('/update/{subFooter}', 'SubFooterController@update')->name('admin.content.sub-footer.update');
            Route::delete('/destroy/{subFooter}', 'SubFooterController@destroy')->name('admin.content.sub-footer.destroy');
            Route::get('/ajax/change-status/{subFooter}', 'SubFooterController@ajaxChangeStatus')->name('admin.content.sub-footer.ajax.change-status');
        });


        Route::prefix('page')->group(function () {
            Route::get('/', 'PageController@index')->name('admin.content.page.index');
            Route::get('/create', 'PageController@create')->name('admin.content.page.create');
            Route::post('/store', 'PageController@store')->name('admin.content.page.store');
            Route::get('/edit/{id}', 'PageController@edit')->name('admin.content.page.edit');
            Route::put('/update/{id}', 'PageController@update')->name('admin.content.page.update');
            Route::delete('/destroy/{id}', 'PageController@destroy')->name('admin.content.page.destroy');
            Route::get('/ajax/change-status/{id}', 'PageController@ajaxChangeStatus')->name('admin.content.page.ajax.change-status');
        });


        Route::prefix('post')->group(function () {
            Route::get('/', 'PostController@index')->name('admin.content.post.index');
            Route::get('/create', 'PostController@create')->name('admin.content.post.create');
            Route::post('/store', 'PostController@store')->name('admin.content.post.store');
            Route::get('/edit/{id}', 'PostController@edit')->name('admin.content.post.edit');
            Route::put('/update/{id}', 'PostController@update')->name('admin.content.post.update');
            Route::delete('/destroy/{id}', 'PostController@destroy')->name('admin.content.post.destroy');
            Route::get('/ajax/change-status/{id}', 'PostController@ajaxChangeStatus')->name('admin.content.post.ajax.change-status');
            Route::get('/ajax/change-commentable/{id}', 'PostController@ajaxChangeCommentable')->name('admin.content.post.ajax.change-commentable');
        });
    });


    Route::middleware('role:super-admin')->prefix('user')->namespace('User')->group(function () {

        Route::prefix('admin-user')->group(function () {
            Route::get('/', 'AdminUserController@index')->name('admin.user.admin-user.index');
            Route::get('/create', 'AdminUserController@create')->name('admin.user.admin-user.create');
            Route::post('/store', 'AdminUserController@store')->name('admin.user.admin-user.store');
            Route::get('/edit/{id}', 'AdminUserController@edit')->name('admin.user.admin-user.edit');
            Route::put('/update/{id}', 'AdminUserController@update')->name('admin.user.admin-user.update');
            Route::delete('/destroy/{id}', 'AdminUserController@destroy')->name('admin.user.admin-user.destroy');
            Route::get('/ajax/change-status/{id}', 'AdminUserController@ajaxChangeStatus')->name('admin.user.admin-user.ajax.change-status');
            Route::get('/ajax/change-activation/{id}', 'AdminUserController@ajaxChangeActivation')->name('admin.user.admin-user.ajax.change-activation');
            Route::get('/roles/{id}', [AdminUserController::class, 'roles'])->name('admin.user.admin-user.roles');
            Route::put('/roles/{id}/update', [AdminUserController::class, 'rolesUpdate'])->name('admin.user.admin-user.roles.update');
            Route::get('/permissions/{id}', [AdminUserController::class, 'permissions'])->name('admin.user.admin-user.permissions');
            Route::put('/permissions/{id}/update', [AdminUserController::class, 'permissionsUpdate'])->name('admin.user.admin-user.permissions.update');
        });
        Route::prefix('customer')->group(function () {
            Route::get('/', 'CustomerController@index')->name('admin.user.customer.index');
            Route::get('/create', 'CustomerController@create')->name('admin.user.customer.create');
            Route::post('/store', 'CustomerController@store')->name('admin.user.customer.store');
            Route::get('/edit/{id}', 'CustomerController@edit')->name('admin.user.customer.edit');
            Route::put('/update/{id}', 'CustomerController@update')->name('admin.user.customer.update');
            Route::delete('/destroy/{id}', 'CustomerController@destroy')->name('admin.user.customer.destroy');
            Route::get('/ajax/change-status/{id}', 'CustomerController@ajaxChangeStatus')->name('admin.user.customer.ajax.change-status');
            Route::get('/ajax/change-activation/{id}', 'CustomerController@ajaxChangeActivation')->name('admin.user.customer.ajax.change-activation');
        });
        Route::prefix('role')->group(function () {
            Route::get('/', 'RoleController@index')->name('admin.user.role.index');
            Route::get('/create', 'RoleController@create')->name('admin.user.role.create');
            Route::post('/store', 'RoleController@store')->name('admin.user.role.store');
            Route::get('/edit/{id}', 'RoleController@edit')->name('admin.user.role.edit');
            Route::get('/edit-permissions/{id}', 'RoleController@editPermission')->name('admin.user.role.edit.permission');
            Route::put('/update/{id}', 'RoleController@update')->name('admin.user.role.update');
            Route::put('/update-permission/{id}', 'RoleController@updatePermission')->name('admin.user.role.update.permission');
            Route::delete('/destroy/{id}', 'RoleController@destroy')->name('admin.user.role.destroy');
            Route::get('/ajax/change-status/{id}', 'RoleController@ajaxChangeStatus')->name('admin.user.role.ajax.change-status');
        });
        Route::prefix('permission')->group(function () {
            Route::get('/', 'PermissionController@index')->name('admin.user.permission.index');
            Route::get('/create', 'PermissionController@create')->name('admin.user.permission.create');
            Route::post('/store', 'PermissionController@store')->name('admin.user.permission.store');
            Route::get('/edit/{id}', 'PermissionController@edit')->name('admin.user.permission.edit');

            Route::put('/update/{id}', 'PermissionController@update')->name('admin.user.permission.update');
            Route::delete('/destroy/{id}', 'PermissionController@destroy')->name('admin.user.permission.destroy');
            Route::get('/ajax/change-status/{id}', 'PermissionController@ajaxChangeStatus')->name('admin.user.permission.ajax.change-status');
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
            Route::get('/ajax/change-status/{id}', 'EmailController@ajaxChangeStatus')->name('admin.notify.email.ajax.change-status');
        });

        Route::prefix('email-file')->group(function () {
            Route::get('/{email}', 'EmailFileController@index')->name('admin.notify.email-file.index');
            Route::get('/{email}/create', 'EmailFileController@create')->name('admin.notify.email-file.create');
            Route::post('/{email}/store', 'EmailFileController@store')->name('admin.notify.email-file.store');
            Route::get('/edit/{file}', 'EmailFileController@edit')->name('admin.notify.email-file.edit');
            Route::put('/update/{file}', 'EmailFileController@update')->name('admin.notify.email-file.update');
            Route::delete('/destroy/{file}', 'EmailFileController@destroy')->name('admin.notify.email-file.destroy');
            Route::get('/ajax/change-status/{file}', 'EmailFileController@ajaxChangeStatus')->name('admin.notify.email-file.ajax.change-status');
        });


        Route::prefix('sms')->group(function () {
            Route::get('/', 'SMSController@index')->name('admin.notify.sms.index');
            Route::get('/create', 'SMSController@create')->name('admin.notify.sms.create');
            Route::post('/store', 'SMSController@store')->name('admin.notify.sms.store');
            Route::get('/edit/{id}', 'SMSController@edit')->name('admin.notify.sms.edit');
            Route::put('/update/{id}', 'SMSController@update')->name('admin.notify.sms.update');
            Route::delete('/destroy/{id}', 'SMSController@destroy')->name('admin.notify.sms.destroy');
            Route::get('/ajax/change-status/{id}', 'SMSController@ajaxChangeStatus')->name('admin.notify.sms.ajax.change-status');
        });
    });


    Route::prefix('ticket')->namespace('Ticket')->group(function () {

        Route::prefix('category')->group(function () {
            Route::get('/', 'CategoryController@index')->name('admin.ticket.category.index');
            Route::get('/create', 'CategoryController@create')->name('admin.ticket.category.create');
            Route::post('/store', 'CategoryController@store')->name('admin.ticket.category.store');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('admin.ticket.category.edit');
            Route::put('/update/{id}', 'CategoryController@update')->name('admin.ticket.category.update');
            Route::delete('/destroy/{id}', 'CategoryController@destroy')->name('admin.ticket.category.destroy');
            Route::get('/ajax/change-status/{id}', 'CategoryController@ajaxChangeStatus')->name('admin.ticket.category.ajax.change-status');
        });

        Route::prefix('priority')->group(function () {
            Route::get('/', 'PriorityController@index')->name('admin.ticket.priority.index');
            Route::get('/create', 'PriorityController@create')->name('admin.ticket.priority.create');
            Route::post('/store', 'PriorityController@store')->name('admin.ticket.priority.store');
            Route::get('/edit/{id}', 'PriorityController@edit')->name('admin.ticket.priority.edit');
            Route::put('/update/{id}', 'PriorityController@update')->name('admin.ticket.priority.update');
            Route::delete('/destroy/{id}', 'PriorityController@destroy')->name('admin.ticket.priority.destroy');
            Route::get('/ajax/change-status/{id}', 'PriorityController@ajaxChangeStatus')->name('admin.ticket.priority.ajax.change-status');
        });


        Route::prefix('admin')->group(function () {
            Route::get('/', 'TicketAdminController@index')->name('admin.ticket.admin.index');
            Route::get('/ajax/change-ability/{id}', 'TicketAdminController@ajaxChangeAbility')->name('admin.ticket.admin.ajax.change-ability');
        });

        Route::get('/', 'TicketController@index')->name('admin.ticket.index');
        Route::get('/new-ticket', 'TicketController@newTicket')->name('admin.ticket.new-ticket');
        Route::get('/open-ticket', 'TicketController@openTicket')->name('admin.ticket.open-ticket');
        Route::get('/close-ticket', 'TicketController@closeTicket')->name('admin.ticket.close-ticket');
        Route::get('/show/{id}', 'TicketController@show')->name('admin.ticket.show');
        Route::post('/answer/{id}', 'TicketController@answer')->name('admin.ticket.answer');
        Route::delete('/destroy/{id}', 'TicketController@destroy')->name('admin.ticket.destroy');
        Route::get('/change-status/{id}', 'TicketController@changeStatus')->name('admin.ticket.change-status');
    });

    Route::middleware('role:super-admin')->prefix('setting')->namespace('Setting')->group(function () {
        Route::get('/', 'SettingController@index')->name('admin.setting.index');
        Route::get('/edit/{id}', 'SettingController@edit')->name('admin.setting.edit');
        Route::put('/update/{id}', 'SettingController@update')->name('admin.setting.update');
    });
});

//

/*Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});*/
