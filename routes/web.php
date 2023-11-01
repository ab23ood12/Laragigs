<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\listing;
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

Route::get('/',[ListingController::class,'index'] );

Route::get('/listing/create',[ListingController::class,'create'])->middleware('auth');

Route::post('/listing/store',[ListingController::class,'store'])->middleware('auth');

Route::get('/listing/{listing}/edit',[ListingController::class,'edit'])->middleware('auth','guest');

Route::put('/listing/{listing}',[ListingController::class,'update'])->middleware('auth');

Route::delete('listing/{listing}',[ListingController::class,'destroy'])->middleware('auth');

Route::get('/listing/{listing}',[ListingController::class,'show']);

Route::get('/register',[UserController::class,'create'])->middleware('guest');

Route::post('/register/store',[UserController::class,'store']);

Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

Route::post('/users/authenticate',[UserController::class,'authenticate']);

Route::get('/listings/manage',[ListingController::class,'manage']);
