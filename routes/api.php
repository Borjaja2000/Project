<?php


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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);

Route::post('store/products', [ProductController::class, 'store']);
Route::get('all/products', [ProductController::class, 'index']);

Route::post('/cart', [CartsController::class, 'store'])->name('cart');
Route::get('/checkout', [CartsController::class, 'index'])->name('checkout');
Route::get('/checkout/get/items', [CartsController::class, 'getCartItemsForCheckout']);
Route::post('/process/user/payment', [CartsController::class, 'processPayment']);

Route::get('login/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
Route::post('social/{provider}', [AuthController::class, 'social']);

