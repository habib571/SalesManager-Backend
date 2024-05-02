<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SuppliersController;
use App\Http\Requests\SupplierRequest;
use App\Models\Product;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;

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

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'Login']);
});

Route::middleware('auth:sanctum')->prefix('category')->group(function () {
    Route::post('create-category ', [CategoryController::class, 'createCategory']);
    Route::get('get-categories', [CategoryController::class, 'getCategories']);
    Route::put('update-category/{categoryId}', [CategoryController::class, 'updateCategory']);
    Route::delete('delete-category/{categoryId}', [CategoryController::class, 'deleteCategory']);
});

Route::middleware('auth:sanctum')->prefix('product')->group(function () {
    Route::post('add-product/{categoryId}/{supplierId}', [ProductController::class, 'addProduct']);
    Route::get('getProducts', [ProductController::class, 'getProducts']);
    Route::put('update-products', [ProductController::class, 'updateproducts']);
    Route::delete('delete-products', [ProductController::class], 'deleteProducts');
});

Route::middleware('auth:sanctum')->prefix('supplier')->group( function () {
        Route::post('add-supplier', [SuppliersController::class,  'addSupplier']);
        Route::get('get-suppliers', [SuppliersController::class, 'getSuppliers']);
        Route::put('update-supplier', [SuppliersController::class, 'updateSupplier']);
        Route::delete('delete-supplier', [SuppliersController::class, 'delete-supplier']);
    }
);
Route::middleware('auth:sanctum')->prefix('customer')->group(function () {
    Route::post('add-customer', [CustomerController::class, 'addCustomer']);
    Route::get('get-customers', [CustomerController::class, 'getCustomers']);
    Route::put('update-customer/{customerId}', [CustomerController::class, 'updateCustomer']);
    Route::delete('delete-customer/{customerId}', [CustomerController::class, 'deleteCustomer']);
}); 

Route::middleware('auth:sanctum')->prefix('invoice')->group(function () { 
    Route::post('add-invoice/{customerId}' ,[InvoiceController::class ,'addInvoice']) ;
}); 
