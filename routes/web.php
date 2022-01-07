<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MyHomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\customerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductsController::class, 'products'])->name('products');
Route::get('/add_products', [ProductsController::class, 'add_products'])->name('add_products');
Route::post('/products/add/store', [ProductsController::class, 'store'])->name('products_store');
Route::get('/edit_products/edit/{id}', [ProductsController::class, 'edit_products'])->name('edit_products');
Route::put('/products/update/{products}', [ProductsController::class, 'updateproducts'])->name('products_update');
Route::delete('/products/delete/{products}', [ProductsController::class, 'delete'])->name('delete_products');


Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::get('/add_category', [CategoryController::class, 'add_category'])->name('add_category');
Route::post('/category/add/store', [CategoryController::class, 'store'])->name('category_store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit_category'])->name('edit_category');
Route::put('/category/update/{category}', [CategoryController::class, 'updatecategory'])->name('category_update');
Route::delete('/category/delete/{category}', [CategoryController::class, 'delete'])->name('delete_category');


Route::get('/sale', [SaleController::class, 'sale'])->name('sale');
Route::get('/add_sale', [SaleController::class, 'add_sale'])->name('add_sale');
Route::post('/sale/add/store', [SaleController::class, 'store'])->name('sale_store');

Route::get('/purchase', [PurchaseController::class, 'purchase'])->name('purchase');
Route::get('/add_purchase', [PurchaseController::class, 'add_purchase'])->name('add_purchase');
Route::post('/purchase/add/store', [PurchaseController::class, 'store'])->name('purchase_store');

Route::get('/supplier', [SupplierController::class, 'supplier'])->name('supplier');
Route::get('/add_supplier', [SupplierController::class, 'add_supplier'])->name('add_supplier');
Route::post('/supplier/add/store', [SupplierController::class, 'store'])->name('supplier_store');
Route::get('/supplier/edit/{id}', [SupplierController::class, 'edit_supplier'])->name('edit_supplier');
Route::put('/supplier/update/{supplier}', [SupplierController::class, 'updatesupplier'])->name('supplier_update');
Route::delete('/supplier/delete/{supplier}', [SupplierController::class, 'delete'])->name('delete_supplier');

Route::get('/customer', [customerController::class, 'customer'])->name('customer');
Route::get('/add_customer', [customerController::class, 'add_customer'])->name('add_customer');
Route::post('/customer/add/store', [customerController::class, 'store'])->name('customer_store');
Route::get('/customer/edit/{id}', [customerController::class, 'edit_customer'])->name('edit_customer');
Route::put('/customer/update/{customer}', [customerController::class, 'updatecustomer'])->name('customer_update');



Route::get('/getProductDetails/{id}', [SaleController::class, 'getProductDetails'])->name('getProductDetails');