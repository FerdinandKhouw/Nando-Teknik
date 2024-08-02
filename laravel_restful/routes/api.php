<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesDetailController;
use App\Http\Controllers\CustomerController;
use App\Models\Category;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Get Category
Route::get('categories/', [CategoryController::class, 'getCategory'])->name('categories');
//Get Category{id}
Route::get('categories/{id}', [CategoryController::class, 'getCategoryById'])->name('categories');
//Add Category
Route::post('addCategory', [CategoryController::class, 'addCategory']);
//Update Category
Route::put('updateCategory/{id}', [CategoryController::class, 'updateCategory']);
//Delete Category
Route::delete('deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);

//Get Product
Route::get('products/', [ProductController::class, 'getProducts'])->name('products');
//Get Product{id}
Route::get('products/{id}', [ProductController::class, 'getProductById'])->name('products');
//Add Product
Route::post('addProduct', [ProductController::class, 'addProduct']);
//Update Product
Route::put('updateProduct/{id}', [ProductController::class, 'updateProduct']);
//Delete Product
Route::delete('deleteProduct/{id}', [ProductController::class, 'deleteProduct']);

//Get Supplier
Route::get('suppliers/', [SupplierController::class, 'getSuppliers'])->name('suppliers');
//Get Supplier{id}
Route::get('suppliers/{id}', [SupplierController::class, 'getSupplierById']);
//Add Supplier
Route::post('addSupplier', [SupplierController::class, 'addSupplier']);
//Update Supplier
Route::put('updateSupplier/{id}', [SupplierController::class, 'updateSupplier']);
//Delete Supplier
Route::delete('deleteSupplier/{id}', [SupplierController::class, 'deleteSupplier']);

//Get Purchase
Route::get('purchases', [PurchaseController::class, 'getPurchase'])->name('purchases');
//Get Purchase{id}
Route::get('purchases/{id}', [PurchaseController::class, 'getPurchaseById']);
//Add Purchase
Route::post('addPurchase', [PurchaseController::class, 'addPurchase']);
//Delete Purchase
Route::delete('deletePurchase/{id}', [PurchaseController::class, 'deletePurchase']);

//Get PurchaseDetail
Route::get('purchase-details', [PurchaseDetailController::class, 'getPurchaseDetails'])->name('purchase_details');
//Get PurchaseDetail{id}
Route::get('purchase-details/{id}', [PurchaseDetailController::class, 'getPurchaseDetailById']);
//Add PurchaseDetail
Route::post('addPurchaseDetail', [PurchaseDetailController::class, 'addPurchaseDetail']);
Route::put('purchase-details/{id}', [PurchaseDetailController::class, 'updatePurchaseDetail']);
Route::delete('purchase-details/{id}', [PurchaseDetailController::class, 'deletePurchaseDetail']);

//Customer Routes
Route::get('customers', [CustomerController::class, 'getCustomers'])->name('customers');
Route::get('customers/{id}', [CustomerController::class, 'getCustomerById']);
Route::post('addCustomer', [CustomerController::class, 'addCustomer']);
Route::put('updateCustomer/{id}', [CustomerController::class, 'updateCustomer']);
Route::delete('deleteCustomer/{id}', [CustomerController::class, 'deleteCustomer']);

//Sales route
Route::get('sales', [SalesController::class, 'getSales'])->name('sales');
Route::get('sales/{id}', [SalesController::class, 'getSalesById']);
Route::post('addSales', [SalesController::class, 'addSales']);
Route::delete('deleteSales/{id}', [SalesController::class, 'deleteSales']);