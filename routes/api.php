<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OnlinePaymentController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('login/{provider}', [AuthController::class, 'loginSocial']);

Route::get('/categories', [ApiController::class,'categories']);
Route::get('/businesses', [ApiController::class,'businesses']);
Route::get('/business/{slug}', [ApiController::class,'business']);
Route::get('/business/{slug}/reviews', [ApiController::class,'businessReviews']);
Route::get('/business/{slug}/products-and-services', [ApiController::class,'businessProducts']);

Route::get('/category/{category_slug}', [ApiController::class,'categoryBusinesses']);
Route::get('/businesses/featured', [ApiController::class,'featuredBusinesses']);

Route::post('/search', [ApiController::class,'search']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', [ApiController::class, 'userProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/me/update', [AuthController::class, 'updateProfile']);
    Route::post('/me/update/password', [AuthController::class, 'updatePassword']);
    Route::post('/me/delete-account', [AuthController::class, 'deleteAccount']);

    Route::post('/review-rating/store', [ApiController::class,'storeReviewRating']);
    Route::post('/review/store', [ApiController::class,'storeReview']);
    Route::post('/rating/store', [ApiController::class,'storeRating']);

    Route::get('/payment-history', [OnlinePaymentController::class, 'paymentHistory']);
});

/*
|--------------------------------------------------------------------------
| ONLINE PAYMENT
|--------------------------------------------------------------------------
*/
Route::get('/business/{slug}/online-payment', [OnlinePaymentController::class, 'validatePaymentQR']);

Route::get('/payment-categories', [OnlinePaymentController::class,'getPaymentCategories']);
Route::get('/payment-method/{id}/get', [OnlinePaymentController::class, 'getPaymentMethod']);
Route::post('/{business_slug}/online-payment/submit', [OnlinePaymentController::class,'submitPayment']);