<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserAprovedAdoptionController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AdoptionsController;

use App\Http\Controllers\SheltersController;
use App\Http\Controllers\ShelterProfileController;
use App\Http\Controllers\EditeProfileInfoSController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AdoptionReqController;
use App\Http\Controllers\ReportShelterController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimalReportsAdminController;
use App\Http\Controllers\AdoptionsAdminController;
use App\Http\Controllers\SheltersAdminController;
use App\Http\Controllers\UsersAdminController;

// Public
Route::get('/Home', [UserController::class, 'home'])->name('Home');
Route::get('/Auth', [AuthController::class , 'index'])->name('Auth');
Route::post('/register', [AuthController::class , 'register'])->name('register');
Route::post('/login', [AuthController::class , 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// USER
Route::prefix('user')->middleware(['auth', 'user.role'])->name('user.')->group(function () {
    Route::get('/HomeUser', [UsersController::class, 'indexHome'])->name('HomeUser');

    Route::get('/Profile', [UserProfileController::class, 'index'])->middleware('permission:manage_user_profile')->name('Profile');
    Route::post('/editProfile', [UserProfileController::class, 'editProfileInfo'])->middleware('permission:manage_user_profile')->name('editProfile');

    Route::resource('UserReports', ReportsController::class)->middleware('permission:report_animal');
    Route::resource('UserAdoptions', AdoptionsController::class)->middleware('permission:request_adoption');

    Route::get('AprovedRequests', [UserAprovedAdoptionController::class, 'index'])->name('AprovedRequests');

    Route::post('logout', [AuthController::class , 'logout'])->name('logout');
});


Route::prefix('shelter')->middleware(['auth', 'shelter.role'])->name('shelter.')->group(function () {
    Route::get('/HomeShelter', [SheltersController::class, 'indexHome'])->name('HomeShelter');

    Route::post('/addAnimal', [AnimalController::class, 'addAnimal'])->middleware('permission:update_animal_status')->name('addAnimal');
    Route::resource('ShelterProfile', ShelterProfileController::class)->middleware('permission:create_shelter_profile');
    Route::post('/editProfile', [EditeProfileInfoSController::class, 'editeProfileInfoS'])->middleware('permission:create_shelter_profile')->name('editProfile');

    Route::get('/AdoptionsRequests', [AdoptionReqController::class, 'index'])->middleware('permission:manage_adoption_requests')->name('AdoptionsRequests');
    Route::post('/rejectAdoptionRequest', [AdoptionReqController::class, 'rejectAdoptionRequest'])->middleware('permission:validate_or_reject_adoption')->name('rejectAdoptionRequest');
    Route::post('/aproveAdoptionRequest', [AdoptionReqController::class, 'aproveAdoptionRequest'])->middleware('permission:validate_or_reject_adoption')->name('aproveAdoptionRequest');

    Route::get('/animalsShelter', [AnimalController::class, 'index'])->middleware('permission:see_shelter_animals')->name('animalsShelter');

    Route::get('/reportsShelter', [ReportShelterController::class, 'index'])->middleware('permission:view_animal_detail')->name('reportsShelter');
    Route::post('/requestStatus', [ReportShelterController::class, 'reportStatus'])->middleware('permission:update_animal_status')->name('requestStatus');

    Route::post('logout', [AuthController::class , 'logout'])->name('logout');
});


// ADMIN
Route::prefix('admin')->middleware(['auth', 'admin.role'])->name('admin.')->group(function () {
    Route::get('/HomeAdmin', [AdminController::class, 'indexHome'])->middleware('permission:access_admin_panel')->name('HomeAdmin');

    Route::get('/ReportsAnimal', [AnimalReportsAdminController::class, 'index'])->middleware('permission:access_admin_panel')->name('ReportsAnimal');
    Route::post('/deleteReport', [AnimalReportsAdminController::class, 'deleteReport'])->middleware('permission:access_admin_panel')->name('deleteReport');

    Route::get('/adoptions', [AdoptionsAdminController::class, 'index'])->middleware('permission:access_admin_panel')->name('adoptions');
    Route::get('/shelters', [SheltersAdminController::class, 'index'])->middleware('permission:access_admin_panel')->name('shelters');
    Route::get('/users', [UsersAdminController::class, 'index'])->middleware('permission:access_admin_panel')->name('users');

    Route::post('/activeUser', [SheltersAdminController::class, 'active'])->middleware('permission:access_admin_panel')->name('activeUser');
    Route::post('/inactiveUser', [SheltersAdminController::class, 'inactive'])->middleware('permission:access_admin_panel')->name('inactiveUser');

    Route::post('logout', [AuthController::class , 'logout'])->name('logout');
});
