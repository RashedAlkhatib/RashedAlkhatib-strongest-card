<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('products');
})->name('products');

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');

Route::get('getslideshow', [App\Http\Controllers\LandingPageController::class, 'getslideshow'])->name('slideshow');
Route::get('getcategory', [App\Http\Controllers\LandingPageController::class, 'getcategories'])->name('category');
Route::get('getproduct', [App\Http\Controllers\LandingPageController::class, 'getproduct'])->name('product');
Route::get('getproducts', [App\Http\Controllers\LandingPageController::class, 'getproducts'])->name('allproducts');
Route::post('deleteitem', [App\Http\Controllers\HomeController::class, 'deleteitem'])->name('deleteitem');
Route::post('saveslideshow', [App\Http\Controllers\HomeController::class, 'saveslideshow'])->name('saveslideshow');
Route::post('savesproduct', [App\Http\Controllers\HomeController::class, 'savesproduct'])->name('savesproduct');
Route::post('savescategory', [App\Http\Controllers\HomeController::class, 'savescategory'])->name('savescategory');
Route::get('gotoproduct/{category_id}', [App\Http\Controllers\HomeController::class, 'gotoproduct'])->name('gotoproduct');

