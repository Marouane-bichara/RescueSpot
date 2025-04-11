<?php

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserReportsController;

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




Route::prefix('user')->middleware(['auth', 'user.role'])->name('user.')->group(function () {
    Route::get('/HomeUser', [UsersController::class, 'indexHome'])->name('HomeUser');
    Route::get('/Profile', [UserProfileController::class, 'index'])->name('Profile');
    Route::post('/editProfile', [UserProfileController::class, 'editProfileInfo'])->name('editProfile');
    Route::get('/UserReports', [UserReportsController::class, 'indexReports'])->name('UserReports');
}); 