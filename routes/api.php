<?php

use App\Http\Controllers\PayMobPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Monarobase\CountryList\CountryListFacade as Countries;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/countries', function () {
    $countries = Countries::getList(app()->getLocale(), 'json');
    return $countries;
})->name('list-countries');

Route::post('checkout/processed', [PayMobPaymentController::class, 'checkoutProcessed']);
