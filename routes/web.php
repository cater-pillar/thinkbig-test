<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;
use App\Models\Book;
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



Route::get('/', [BookController::class, 'index']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');

Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy']);

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');

Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest');

Route::get('upload', [AdminController::class, 'upload'])->middleware('admin');

Route::post('store', [AdminController::class, 'store'])->middleware('admin');