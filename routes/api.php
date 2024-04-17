<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SuppliersController;
use App\Models\Product;

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
    Route::post('register' , [AuthController::class , 'register'] ) ; 
    Route::post('login' , [AuthController::class , 'Login'] ) ;
});

Route::middleware('auth:sanctum')->prefix('category')->group( function () { 
    Route::post('create-category ' , [CategoryController::class , 'createCategory']) ; 
    Route::get('get-categories'  , [CategoryController::class , 'getCategories'] ) ;
    Route::put('update-category/{categoryId}' , [CategoryController::class , 'updateCategory']) ;
    Route::delete('delete-category/{categoryId}' , [CategoryController::class , 'deleteCategory']) ; 
} ) ;

Route::middleware('auth:sanctum')->prefix('product')->group( function() { 
    Route::post('add-product/{categoryId}', [ProductController::class , 'addProduct']) ; 
    Route::get('getProducts' , [ProductController::class , 'getProducts'] ) ;     
}) ;

Route::middleware('auth:sanctum')->prefic('supplier')->group(  function() {
     Route::post('add-supplier' , [SuppliersController::class ,  'addSupplier']) ; 
    Route::get('get-suppliers' , [SuppliersController::class , 'getSuppliers']) ;
}
);

