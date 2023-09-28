<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LanguageSwitcherController;
use App\Http\Controllers\PayPalPaymentController;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::get('lang/{locale}', LanguageSwitcherController::class)->name('langswitcher');


Route::view('/', 'site.pages.home')->name('home');

Route::get('/orders/{order}/invoice', InvoiceController::class)
    ->name('order.invoice');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Categories
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])
    ->name('categories.show');

// Products
Route::get('/products/{product:slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/search', [ProductController::class, 'search'])
    ->name('products.search');


Route::middleware('auth')->group(function () {
    Route::get('/account', [ProfileController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [ProfileController::class, 'update'])->name('account.update');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('account.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'get'])
        ->name('cart.index');

    Route::post('/cart/add', [CartController::class, 'addItem'])
        ->name('cart.addItem');

    Route::get('/cart/item/{id}/remove', [CartController::class, 'removeItem'])
        ->name('cart.removeItem');

    Route::get('/cart/clear', [CartController::class, 'clear'])
        ->name('cart.clear');

    // Account orders
    Route::get('account/orders', [AccountController::class, 'getOrders'])
        ->name('account.orders');

    // Checkout
    Route::middleware('cartNotEmpty')->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'get'])
            ->name('checkout.index');

        Route::post('/checkout/paypalorder', [CheckoutController::class, 'placePayPalOrder'])
            ->name('checkout.placePayPalOrder');

        Route::post('/checkout/paymoborder', [CheckoutController::class, 'placePayMobOrder'])
            ->name('checkout.placePayMobOrder');

        // PayPal
        Route::get('handle-payment', [PayPalPaymentController::class, 'handlePayment'])
            ->name('payment.make');

        Route::get('cancel-payment', [PayPalPaymentController::class, 'cancelPayment'])
            ->name('payment.cancel');

        Route::get('success-payment', [PayPalPaymentController::class, 'successPayment'])
            ->name('payment.success');
    });
});

Route::get('checkout/response', function () {
    \Cart::session(auth()->id())->clear();
    return redirect()->to(route('account.orders'));
});


require __DIR__ . '/auth.php';
