<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilePaymentController;
use App\Http\Controllers\PingController;
use App\Mail\PaymentConfirmMail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// //post route for add payment
 Route::post("add-mobile",[MobilePaymentController::class,'addPayment']);
// //get route for search  names
// Route::get("search/{name}",[MobilePaymentController::class,'search']);
// //delete route for delete a payment
// Route::delete("delete/{id?}",[MobilePaymentController::class,'delete']);
// //post route for send a ping
Route::post("sendPing",[PingController::class,'sendPing']);
// //get route for all payment details
// Route::get('list' , [MobilePaymentController::class , 'list']);
