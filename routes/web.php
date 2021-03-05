<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// home
//Route::get('/', App\Http\Livewire\Page\Show::class)->name('home');
Route::get('/', App\Http\Livewire\Product\Index::class)->name('home');

// token check
Route::get('/token/{token}', [App\Http\Controllers\TokenController::class, 'storeToSession'])->name('token.store_to_session');

// product admin
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/product/admin', App\Http\Livewire\Product\AdminIndex::class)->name('product.admin-index');
    Route::get('/product/create', App\Http\Livewire\Product\Create::class)->name('product.create');
    Route::get('/product/{product}/edit', App\Http\Livewire\Product\Edit::class)->name('product.edit');
});
// product frontend
Route::middleware(['token'])->group(function(){
    Route::get('/product/{product}', App\Http\Livewire\Product\Show::class)->name('product.show');
    Route::get('/product/personaliser/epa/{id}', [App\Http\Controllers\ProductController::class, 'getExternalPricingAPI'])->name('product.personaliser.epa');
    Route::get('/product/personaliser/{product}/{ref?}/{rowId?}', [App\Http\Controllers\ProductController::class, 'personaliser'])->name('product.personaliser');
});

// basket
Route::middleware(['token'])->group(function(){
    Route::get('/basket', App\Http\Livewire\Basket\Show::class)->name('basket.show');
    Route::post('/basket/add/{product}/{rowId?}', [App\Http\Controllers\BasketController::class, 'add'])->name('basket.add');   
});

// order admin
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/order/admin', App\Http\Livewire\Order\AdminIndex::class)->name('order.admin-index');
    Route::get('/order/{order}', App\Http\Livewire\Order\Show::class)->name('order.show');
});

// invite admin
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/invite/create', App\Http\Livewire\Invite\Create::class)->name('invite.create');
});

// page admin
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/page/admin', App\Http\Livewire\Page\AdminIndex::class)->name('page.admin-index');
    Route::get('/page/create', App\Http\Livewire\Page\Create::class)->name('page.create');
    Route::get('/page/{page}/edit', App\Http\Livewire\Page\Edit::class)->name('page.edit');
});
// page frontend (must be at bottom of routes)
Route::get('/{page}', App\Http\Livewire\Page\Show::class)->name('page.show');
