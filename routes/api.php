<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('product', ProductController::class);
Route::apiResource('client', ClientController::class);
Route::apiResource('order', OrderController::class);
Route::apiResource('order-detail', OrderDetailController::class);
Route::apiResource('supplier', SupplierController::class);
Route::apiResource('supplier-product', SupplierProductController::class);