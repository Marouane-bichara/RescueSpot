<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

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


Route::get('/Home', [UserController::class, 'home'])->name('Home');

Route::get('/Auth', [AuthController::class , 'index'])->name('Auth');


Route::post('/register' , [AuthController::class , 'register'])->name('register');

Route::post('/login' , [AuthController::class , 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Route::get('/HomeUser', [UsersController::class, 'index'])->name('HomeUser')->middleware(['auth', 'user.role']);



Route::prefix('user')->middleware(['auth', 'user.role'])->name('user.')->group(function () {
    Route::get('/HomeUser', [UsersController::class, 'index'])->name('HomeUser');
}); 