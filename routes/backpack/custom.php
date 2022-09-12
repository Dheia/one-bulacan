<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

use App\Http\Controllers\Admin\MessageCrudController;

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin'), 'admin_first_time_login'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('/dashboard', 'DashboardController@dashboard');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('log', 'LogCrudController');
    Route::crud('directory', 'DirectoryCrudController');
    
    Route::crud('survey', 'SurveyCrudController');
    Route::crud('newsletter', 'NewsletterCrudController');
    Route::crud('businesscategory', 'BusinessCategoryCrudController');
    Route::crud('businesstag', 'BusinessTagCrudController');

    // Businesses Routes
    Route::crud('business', 'BusinessCrudController');
    Route::get('business/dti/{id}', 'BusinessCrudController@dti')->name('dti');
    Route::get('business/draft/{id}', 'BusinessCrudController@draft')->name('draft');
    Route::post('business/feature', 'BusinessCrudController@feature')->name('feature');
    Route::get('business/verify/{id}', 'BusinessCrudController@verify')->name('verify');
    Route::post('business/published_renew', 'BusinessCrudController@published_renew')->name('published_renew');
    Route::get('business/api/get-baranggays', 'BusinessCrudController@getBaranggays')->name('business/api/get-baranggays');
    Route::get('business/api/get-categories', 'BusinessCrudController@getCategories')->name('business/api/get-categories');

    Route::post('tag-inline-create', 'TagCrudController@getInlineCreateModal')->name('admin.tag-inline-create');
    Route::post('tag-inline-create-save', 'TagCrudController@storeInlineCreate')->name('admin.tag-inline-create-save');

    // Featured Businesses Routes
    Route::crud('featuredbusiness', 'FeaturedBusinessCrudController');
    Route::post('featuredbusiness/featured_renew', 'FeaturedBusinessCrudController@featured_renew')->name('featured_renew');
    Route::post('featuredbusiness/unfeature', 'FeaturedBusinessCrudController@unfeature')->name('premium.unfeature');
    Route::post('featuredbusiness/feature', 'FeaturedBusinessCrudController@feature')->name('premium.feature');
    
    // Job Routes
    Route::crud('job', 'JobCrudController');
    Route::crud('jobcategory', 'JobCategoryCrudController');
    Route::get('job/draft/{id}', 'JobCrudController@draft');
    Route::get('job/reopen/{id}', 'JobCrudController@reopen');

    // Pending Job Routes
    Route::crud('pending-job', 'PendingJobCrudController');
    Route::get('pending-job/publish/{id}', 'PendingJobCrudController@publish');
    
    // Drafted Businesses Routes
    Route::crud('drafted-business', 'DraftedBusinessCrudController');
    Route::post('drafted-business/publish', 'DraftedBusinessCrudController@drafted_business.publish');
    Route::get('drafted-business/verify/{id}', 'DraftedBusinessCrudController@drafted_business.verify');

    // Pending Businesses Routes
    Route::crud('pending-business', 'PendingBusinessCrudController');
    Route::post('pending-business/publish', 'PendingBusinessCrudController@publish')->name('pending_business.publish');
    Route::get('pending-business/verify/{id}', 'PendingBusinessCrudController@verify')->name('pending_business.verify');

    // Sales Businesses Routes
    Route::crud('sale', 'SaleCrudController');
    Route::post('sale/paid', 'SaleCrudController@paid');
    Route::get('sale/email/{id}', 'SaleCrudController@email');
    Route::get('sale/notify/{id}', 'SaleCrudController@notify');
    Route::get('sale/message/{id}', 'SaleCrudController@message');    
    Route::get('sale/verify/{id}', 'SaleCrudController@verify')->name('sale.verify');

    // Business Visitor
    Route::crud('businessvisitor', 'BusinessVisitorCrudController');

    // Business Owner
    Route::crud('businesscredential', 'BusinessCredentialCrudController');
    Route::crud('business-owner', 'BusinessOwnerCrudController');
    Route::post('business-owner/reset-password/{id}', 'BusinessOwnerCrudController@resetPassword')->name('business-owner.reset-password');
    Route::post('business-owner/activate-account/{id}', 'BusinessOwnerCrudController@activateAccount')->name('business-owner.activate-account');
    Route::post('business-owner/deactivate-account/{id}', 'BusinessOwnerCrudController@deactivateAccount')->name('business-owner.deactivate-account');

    // Product Service
    Route::crud('product-service', 'ProductServiceCrudController');

    // Coupons
    Route::crud('business-coupon', 'BusinessCouponCrudController');

    Route::post('user/reset-password/{id}', 'UserCrudController@resetPassword')->name('user.reset-password');

    // Payment
    Route::crud('payment-method', 'PaymentMethodCrudController');
    Route::get('payment-method/{id}/activate', 'PaymentMethodCrudController@activate')->name('payment_method.activate');
    Route::get('payment-method/{id}/deactivate', 'PaymentMethodCrudController@deactivate')->name('payment_method.deactivate');

    Route::crud('payment-category', 'PaymentCategoryCrudController');
    Route::get('payment-category/{id}/activate', 'PaymentCategoryCrudController@activate')->name('payment_category.activate');
    Route::get('payment-category/{id}/deactivate', 'PaymentCategoryCrudController@deactivate')->name('payment_category.deactivate');

    // Paybiz 
    Route::crud('paybiz-wallet', 'PaybizWalletCrudController');
    Route::get('paybiz-wallet/{id}/activate', 'PaybizWalletCrudController@activate')->name('paybiz_wallet.activate');
    Route::get('paybiz-wallet/{id}/deactivate', 'PaybizWalletCrudController@deactivate')->name('paybiz_wallet.deactivate');
    Route::get('paybiz-wallet/{id}/inclusive', 'PaybizWalletCrudController@inclusive')->name('paybiz_wallet.inclusive');
    Route::get('paybiz-wallet/{id}/exclusive', 'PaybizWalletCrudController@exclusive')->name('paybiz_wallet.exclusive');
    Route::get('paybiz-wallet/api/{id}/qr-code', 'PaybizWalletCrudController@getQrCode')->name('paybiz_wallet.qrcode.get');
    Route::get('paybiz-wallet/{id}/qr-code', 'PaybizWalletCrudController@generateQrCode')->name('paybiz_wallet.qrcode.download');

    // Location
    Route::crud('location', 'LocationCrudController');
    Route::crud('baranggay', 'BaranggayCrudController');
    Route::crud('paynamics-payment', 'PaynamicsPaymentCrudController');

    // Message
    Route::crud('message', 'MessageCrudController');
    Route::get('message/{id}/read', [MessageCrudController::class, 'markAsRead'])
        ->name('message.read');
    Route::get('message/{id}/unread', [MessageCrudController::class, 'markAsUnread'])
        ->name('message.unread');
}); // this should be the absolute last line of this file