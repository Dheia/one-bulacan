<?php
/*
|--------------------------------------------------------------------------
| Business Portal Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
Route::prefix('one-portal')
	->group(function() {
		Route::get('/', 'Auth\BusinessLoginController@showLoginForm');
		Route::get('/login', 'Auth\BusinessLoginController@showLoginForm')->name('business-portal.login');
	    Route::post('/login', 'Auth\BusinessLoginController@login')->name('business-portal.login.submit');

	    Route::get('/logout', 'Auth\BusinessLoginController@logout')->name('business-portal.logout'); 
	    Route::post('/logout', 'Auth\BusinessLoginController@logout')->name('business-portal.logout.submit');    
	});

Auth::guard('business-portal');

Route::group([
    'prefix' => 'one-portal',
    'middleware' => ['auth:business-portal', 'is_business_owner', 'user_first_time_login:business-portal'],
    'namespace' => '\App\Http\Controllers\BusinessPortal'
], function () {

	Route::get('dashboard', 'BusinessPortalController@index')->name('business-portal.dashboard');
	Route::crud('business-tag', 'TagController');
	Route::crud('my-business', 'BusinessController');

	Route::get('business/api/get-baranggays', 'BusinessController@getBaranggays');

	Route::post('tag/inline/create/modal', 'App\Http\Controllers\BusinessPortalTagController@getInlineCreateModal')->name('business-portal.tag-inline-create');
    Route::post('tag/inline/create', 'TagController@storeInlineCreate')->name('business-portal.tag-inline-create-save');

	// Route::get('business', function () {
	//     dd('Welcome to One Portal Business List routes.');
	// })->name('business-portal.business');

	Route::crud('business-product-service', 'ProductServiceController');
	Route::crud('coupon', 'BusinessCouponController');

	Route::crud('transaction', 'TransactionController');
});

/*
|--------------------------------------------------------------------------
| CHANGE PASSWORD
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => 'one-portal',
    'middleware' => ['auth:business-portal'],
    'namespace' => 'BusinessPortal'
], function () {
    Route::get('edit-account-info', 'MyAccountController@getAccountInfoForm')->name('business-portal.account.info');
    Route::post('edit-account-info', 'MyAccountController@postAccountInfoForm')->name('business-portal.account.info.store');
    Route::post('change-password', 'MyAccountController@postChangePasswordForm')->name('business-portal.account.password');
});