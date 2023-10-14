<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\UserController;
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
// Route::get('/',function(){
//     $name='Barbara';
//     $age='20';
// return view('dashboard.index',compact('name','age'));
// });
Route::get('/',HomeController::class)->name('index');
Route::resource('categories',CategoryController::class);
Route::resource('posts',PostController::class);
Route::resource('users',UserController::class);
Route::get('posts',[PostController::class,'index']);