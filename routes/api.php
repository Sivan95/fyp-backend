<?php

use Illuminate\Http\Request;

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

Route::get('maids', 'UserController@maidIndex');
Route::get('maids/{maid}', 'UserController@showMaid');
Route::get('customers/{customer}', 'UserController@showCustomer');
Route::post('users', 'UserController@store');
Route::put('users/{user}', 'UserController@update');

Route::get('maidOwnBookingDetails/{maidID}', 'BookingController@maidOwnBookingDetails');
Route::get('customerOwnBookingDetails/{customerID}', 'BookingController@customerOwnBookingDetails');
Route::post('bookings', 'BookingController@store');
Route::get('pendingRequest/{maidID}','BookingController@pendingRequest');
Route::put('bookings/{booking}', 'BookingController@update');
Route::get('makePayment/{bookingID}','BookingController@makePayment');
Route::get('bookings/{booking}','BookingController@show');

Route::post('transactions', 'TransactionController@store');
Route::get('transactions/{transaction}','TransactionController@show');
