<?php

use App\Http\Controllers\admin\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\CategoriesController;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
require __DIR__.'/auth.php';
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:web,admins'])->name('dashboard');

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){   
    Route::prefix('admin')
    ->as('admins.')
    ->group(function () {
         
        require __DIR__.'/auth.php';
    });
});
Route::prefix('admin')->group(function () {
    
    Route::get('products/trash',[ProductsController::class,'trash'])->name('products.trash');
    Route::put('products/restore/{id?}',[ProductsController::class,'restore'])->name('products.restore');
    Route::delete('products/force-delete/{id?}',[ProductsController::class,'forceDelete'])->name('products.force-delete');
    Route::resource('products',ProductsController::class);
    Route::resource('categories',CategoriesController::class);
});
Route::group(['prefix' => LaravelLocalization::setLocale()], function(){   
    Route::prefix('merchant')
    ->as('merchants.')
    ->group(function () {
        
        require __DIR__.'/auth.php';
    });
});
Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('carts/increase/quantitiy/{id}', [CartController::class , 'increaseQuantity'])->name('carts.quantityIn');
Route::get('carts/decrease/quantitiy/{id}', [CartController::class , 'decreaseQuantity'])->name('carts.quantityDe');
Route::get('carts/{id}', [CartController::class , 'deleteItem'])->name('carts.delete');
Route::resource('carts', CartController::class);
Route::get('/', [HomeController::class , 'index'])->name('home.index');
Route::get('/{slug}', [HomeController::class , 'show'])->name('home.show');


