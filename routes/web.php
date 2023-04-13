<?php

use App\Http\Controllers\SPA\ClientController;
use App\Http\Controllers\SPA\OrderController;
use App\Http\Controllers\SPA\ProductController;
use App\Http\Controllers\SPA\SupplierController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


// spa routes
Route::resource('product', ProductController::class)->names('spa-product')->middleware('auth')->except(['store', 'update', 'destroy']);
Route::resource('client', ClientController::class)->names('spa-client')->middleware('auth')->except(['store', 'update', 'destroy']);
Route::resource('order', OrderController::class)->names('spa-order')->middleware('auth')->except(['store', 'update', 'destroy']);
Route::resource('supplier', SupplierController::class)->names('spa-supplier')->middleware('auth')->except(['store', 'update', 'destroy']);
