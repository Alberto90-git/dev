<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Recuperer tous les produits
Route::get('/product', [ProductController::class, 'index']);


Route::get('/product/new', [ProductController::class, 'new'])->name('product/new');

Route::post('/product/store', [ProductController::class, 'store'])->name('store');

//Modification
Route::post('/product/edit', [ProductController::class, 'edit'])->name('edit');



