<?php

use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\PostController;
use App\Http\Controllers\Website\ProfileController;
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

// Route::get('home', function () {
//     return "hello you are not allowed";
// })->name('home');
// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('posts',PostController::class);
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('categories', CategoryController::class);
Route::resource('profile', ProfileController::class);
