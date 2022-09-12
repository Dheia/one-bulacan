<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OnlinePaymentController;
use App\Http\Controllers\PaynamicsController;

/*
|--------------------------------------------------------------------------
| Online Payment Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group([
//     'prefix'     => 'admin-one',
// ], function () { // custom user login routes


// });

/*
|--------------------------------------------------------------------------
| ONLINE PAYMENT Routes
|--------------------------------------------------------------------------
*/
Route::get('online-payment/instructions/{request_id}', [OnlinePaymentController::class, 'showInstructions'])->name('online_payment.instructions');
Route::get('{business_slug}/online-payment', [OnlinePaymentController::class, 'index'])->name('online_payment.index');
Route::post('{business_slug}/online-payment/submit', [OnlinePaymentController::class, 'submitPayment'])->name('online_payment.submit');

Route::get('api/payment-method/{id}/get', [OnlinePaymentController::class, 'getPaymentMethod'])->name('online_payment.get_payment_method');

/*
|--------------------------------------------------------------------------
| ONLINE PAYMENT WEBHOOKS Routes (PAYNAMICS WEBHOOKS)
|--------------------------------------------------------------------------
*/
// Route::get('online-payment/paynamics/response', [PaynamicsController::class, 'webhookResponse'])->name('online_payment.get_webhook_response');
// Route::get('online-payment/paynamics/notification', [PaynamicsController::class, 'webhookNotification'])->name('online_payment.get_webhook_notification');
// Route::get('online-payment/paynamics/cancel', [PaynamicsController::class, 'webhookCancel'])->name('online_payment.get_webhook_cancel');

Route::get('online-payment/paynamics/response/{request_id}', [PaynamicsController::class, 'responseURL'])->name('online_payment.response_url');
Route::post('online-payment/paynamics/response', [PaynamicsController::class, 'webhookResponse'])->name('online_payment.post_webhook_response');
Route::post('online-payment/paynamics/notification', [PaynamicsController::class, 'webhookNotification'])->name('online_payment.post_webhook_notification');
Route::post('online-payment/paynamics/cancel', [PaynamicsController::class, 'webhookCancel'])->name('online_payment.post_webhook_cancel');