<?php

// --------------------------
// System Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin'), 'admin_first_time_login'],
    // 'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
	// 
	Route::crud('user', 'UserCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('permission', 'PermissionCrudController');

}); // this should be the absolute last line of this file


Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => '\App\Http\Controllers\Auth',
], function () { // custom admin routes
	// 
	Route::post('change-password', 'MyAccountController@postChangePasswordForm')->name('backpack.account.password');

}); // this should be the absolute last line of this file