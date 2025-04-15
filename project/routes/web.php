<?php

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SheltersController;
use App\Http\Controllers\AdoptionsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserProfileController;

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
    // Route::post('/CreateReports', [ReportsController::class, 'addReport'])->name('CreateReports');
    Route::resource('UserReports', ReportsController::class);
    Route::resource('UserAdoptions', AdoptionsController::class);
    Route::post('logout' , [AuthController::class , 'logout'])->name('logout');
}); 



Route::prefix('user')->middleware(['auth', 'user.role'])->name('shelter.')->group(function () {
    Route::get('/HomeShelter', [SheltersController::class, 'indexHome'])->name('HomeShelter');

});