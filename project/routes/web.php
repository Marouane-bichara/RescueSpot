<?php

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SheltersController;
use App\Http\Controllers\AdoptionsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UsersAdminController;
use App\Http\Controllers\AdoptionReqController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ReportShelterController;
use App\Http\Controllers\SheltersAdminController;
use App\Http\Controllers\AdoptionsAdminController;
use App\Http\Controllers\ShelterProfileController;
use App\Http\Controllers\EditeProfileInfoSController;
use App\Http\Controllers\AnimalReportsAdminController;
use App\Http\Controllers\UserAprovedAdoptionController;

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
    Route::get('AprovedRequests', [UserAprovedAdoptionController::class, 'index'])->name('AprovedRequests');

}); 



Route::prefix('shelter')->middleware(['auth', 'shelter.role'])->name('shelter.')->group(function () {
    Route::get('/HomeShelter', [SheltersController::class, 'indexHome'])->name('HomeShelter');
    Route::post('logout' , [AuthController::class , 'logout'])->name('logout');
    Route::post('/addAnimal', [AnimalController::class, 'addAnimal'])->name('addAnimal');
    Route::resource('ShelterProfile', ShelterProfileController::class);
    Route::post('/editProfile', [EditeProfileInfoSController::class, 'editeProfileInfoS'])->name('editProfile');
    Route::get('/AdoptionsRequests', [AdoptionReqController::class, 'index'])->name('AdoptionsRequests');
    Route::post('/rejectAdoptionRequest', [AdoptionReqController::class, 'rejectAdoptionRequest'])->name('rejectAdoptionRequest');
    Route::post('/aproveAdoptionRequest', [AdoptionReqController::class, 'aproveAdoptionRequest'])->name('aproveAdoptionRequest');
    Route::get('/animalsShelter', [AnimalController::class, 'index'])->name('animalsShelter');
    Route::get('/reportsShelter', [ReportShelterController::class, 'index'])->name('reportsShelter');
    Route::post('requestStatus' , [ReportShelterController::class , 'reportStatus'])->name('requestStatus');

});

Route::prefix('admin')->middleware(['auth', 'admin.role'])->name('admin.')->group(function () {
    Route::get('/HomeAdmin', [AdminController::class, 'indexHome'])->name('HomeAdmin');
    Route::get('/ReportsAnimal', [AnimalReportsAdminController::class, 'index'])->name('ReportsAnimal');
    Route::post('/deleteReport', [AnimalReportsAdminController::class, 'deleteReport'])->name('deleteReport');
    Route::get('/adoptions', [AdoptionsAdminController::class, 'index'])->name('adoptions');
    Route::get('/shelters', [SheltersAdminController::class, 'index'])->name('shelters');
    Route::get('/users', [UsersAdminController::class, 'index'])->name('users');
    Route::post('/activeUser', [SheltersAdminController::class, 'active'])->name('activeUser');
    Route::post('/inactiveUser', [SheltersAdminController::class, 'inactive'])->name('inactiveUser');
    Route::post('logout' , [AuthController::class , 'logout'])->name('logout');

    
});