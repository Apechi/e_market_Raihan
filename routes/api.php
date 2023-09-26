<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\UserItemsController;
use App\Http\Controllers\Api\UserOrdersController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProductItemsController;
use App\Http\Controllers\Api\UserPurchasesController;
use App\Http\Controllers\Api\CustomerOrdersController;
use App\Http\Controllers\Api\ItemOrderDetailsController;
use App\Http\Controllers\Api\SupplierPurchasesController;
use App\Http\Controllers\Api\ItemPurchaseDetailsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('suppliers', SupplierController::class);

        // Supplier Purchases
        Route::get('/suppliers/{supplier}/purchases', [
            SupplierPurchasesController::class,
            'index',
        ])->name('suppliers.purchases.index');
        Route::post('/suppliers/{supplier}/purchases', [
            SupplierPurchasesController::class,
            'store',
        ])->name('suppliers.purchases.store');

        Route::apiResource('products', ProductController::class);

        // Product Items
        Route::get('/products/{product}/items', [
            ProductItemsController::class,
            'index',
        ])->name('products.items.index');
        Route::post('/products/{product}/items', [
            ProductItemsController::class,
            'store',
        ])->name('products.items.store');

        Route::apiResource('customers', CustomerController::class);

        // Customer Orders
        Route::get('/customers/{customer}/orders', [
            CustomerOrdersController::class,
            'index',
        ])->name('customers.orders.index');
        Route::post('/customers/{customer}/orders', [
            CustomerOrdersController::class,
            'store',
        ])->name('customers.orders.store');

        Route::apiResource('items', ItemController::class);

        // Item Order Details
        Route::get('/items/{item}/order-details', [
            ItemOrderDetailsController::class,
            'index',
        ])->name('items.order-details.index');
        Route::post('/items/{item}/order-details', [
            ItemOrderDetailsController::class,
            'store',
        ])->name('items.order-details.store');

        // Item Purchase Details
        Route::get('/items/{item}/purchase-details', [
            ItemPurchaseDetailsController::class,
            'index',
        ])->name('items.purchase-details.index');
        Route::post('/items/{item}/purchase-details', [
            ItemPurchaseDetailsController::class,
            'store',
        ])->name('items.purchase-details.store');

        Route::apiResource('users', UserController::class);

        // User Items
        Route::get('/users/{user}/items', [
            UserItemsController::class,
            'index',
        ])->name('users.items.index');
        Route::post('/users/{user}/items', [
            UserItemsController::class,
            'store',
        ])->name('users.items.store');

        // User Orders
        Route::get('/users/{user}/orders', [
            UserOrdersController::class,
            'index',
        ])->name('users.orders.index');
        Route::post('/users/{user}/orders', [
            UserOrdersController::class,
            'store',
        ])->name('users.orders.store');

        // User Purchases
        Route::get('/users/{user}/purchases', [
            UserPurchasesController::class,
            'index',
        ])->name('users.purchases.index');
        Route::post('/users/{user}/purchases', [
            UserPurchasesController::class,
            'store',
        ])->name('users.purchases.store');
    });
