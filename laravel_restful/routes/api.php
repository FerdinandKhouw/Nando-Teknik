<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
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

//Category route
Route::get('categories/', [CategoryController::class, 'getCategory'])->name('categories');
Route::get('categories/{id}', [CategoryController::class, 'getCategoryById'])->name('categories');
Route::post('addCategory', [CategoryController::class, 'addCategory']);
Route::put('updateCategory/{id}', [CategoryController::class, 'updateCategory']);
Route::delete('deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);

//Product route
Route::get('products/', [ProductController::class, 'getProducts'])->name('products');
Route::get('products/{id}', [ProductController::class, 'getProductById'])->name('products');
Route::post('addProduct', [ProductController::class, 'addProduct']);
Route::put('updateProduct/{id}', [ProductController::class, 'updateProduct']);
Route::delete('deleteProduct/{id}', [ProductController::class, 'deleteProduct']);

//Supplier route
Route::get('suppliers/', [SupplierController::class, 'getSuppliers'])->name('suppliers');
Route::get('suppliers/{id}', [SupplierController::class, 'getSupplierById']);
Route::post('addSupplier', [SupplierController::class, 'addSupplier']);
Route::put('updateSupplier/{id}', [SupplierController::class, 'updateSupplier']);
Route::delete('deleteSupplier/{id}', [SupplierController::class, 'deleteSupplier']);

//Customer Routes
Route::get('customers', [CustomerController::class, 'getCustomers'])->name('customers');
Route::get('customers/{id}', [CustomerController::class, 'getCustomerById']);
Route::post('addCustomer', [CustomerController::class, 'addCustomer']);
Route::put('updateCustomer/{id}', [CustomerController::class, 'updateCustomer']);
Route::delete('deleteCustomer/{id}', [CustomerController::class, 'deleteCustomer']);

//Purchase route
Route::get('purchases', [PurchaseController::class, 'getPurchase'])->name('purchases');
Route::get('purchases/{id}', [PurchaseController::class, 'getPurchaseById']);
Route::post('addPurchase', [PurchaseController::class, 'addPurchase']);
Route::delete('deletePurchase/{id}', [PurchaseController::class, 'deletePurchase']);

//PurchaseDetail route
Route::get('purchase-details', [PurchaseDetailController::class, 'getPurchaseDetails'])->name('purchase_details');
Route::get('purchase-details/{id}', [PurchaseDetailController::class, 'getPurchaseDetailById']);
Route::post('addPurchaseDetail', [PurchaseDetailController::class, 'addPurchaseDetail']);
Route::put('purchase-details/{id}', [PurchaseDetailController::class, 'updatePurchaseDetail']);
Route::delete('deletePurchaseDetail/{id}', [PurchaseDetailController::class, 'deletePurchaseDetail']);

//Sale route
Route::get('sales', [SaleController::class, 'getSale'])->name('sales');
Route::get('sales/{id}', [SaleController::class, 'getSaleById']);
Route::post('addSale', [SaleController::class, 'addSale']);
Route::delete('deleteSale/{id}', [SaleController::class, 'deleteSale']);

//SaleDetail route
Route::get('sale-details', [SaleDetailController::class, 'getSaleDetails'])->name('sale_details');
Route::get('sale-details/{id}', [SaleDetailController::class, 'getSaleDetailById']);
Route::post('addSaleDetail', [SaleDetailController::class, 'addSaleDetail']);
Route::put('updateSaleDetail', [SaleDetailController::class, 'updateSaleDetail']);
Route::delete('deleteSaleDetail', [SaleDetailController::class, 'deleteSaleDetail']);

//ServiceProduct route
Route::get('service-products', [ServiceProductController::class, 'getAllServiceProducts'])->name('service-products');
Route::get('service-products/{id}', [ServiceProductController::class, 'getServiceProductById']);
Route::post('addServiceProduct', [ServiceProductController::class, 'addServiceProduct']);
Route::put('updateServiceProduct/{id}', [ServiceProductController::class, 'updateServiceProduct']);
Route::delete('deleteServiceProduct/{id}', [ServiceProductController::class, 'deleteServiceProduct']);

//Report route
Route::post('getReport', [ReportController::class, 'getReport']);

//Auth (Login) route
Route::get('login', [AuthController::class, 'login']);