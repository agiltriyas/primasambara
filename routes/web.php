<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcom');
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('product', App\Http\Controllers\ProductController::class);
    Route::resource('transaction', App\Http\Controllers\TransactionController::class);
    Route::resource('cart', App\Http\Controllers\CartController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::get('/success-transaction', function () {
        return view('thanks');
    })->name('thanks');
    Route::get('print-sj/{id}', [App\Http\Controllers\PrintController::class, 'sj'])->name('sj');
    Route::get('print-inv/{id}', [App\Http\Controllers\PrintController::class, 'inv'])->name('inv');
});
