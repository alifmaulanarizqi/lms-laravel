<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use App\Http\Controllers\Frontend\StudentProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * ------------------------------------------------------------
 * Frontend Route
 * ------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'index'])->name('home');

/**
 * ------------------------------------------------------------
 * Student Dashboard Route
 * ------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:student'], 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/become-instructor', [StudentDashboardController::class, 'becomeInstructor'])->name('become-instructor');
    Route::post('/become-instructor/{id}', [StudentDashboardController::class, 'becomeInstructorStore'])->name('become-instructor.store');

    // ** Profile Route ** //
    Route::get('/profile', [StudentProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update-information', [StudentProfileController::class, 'updateInformation'])->name('profile.update.user.information');
    Route::post('/profile/update-social', [StudentProfileController::class, 'updateSocial'])->name('profile.update.user.social');
    Route::post('/profile/update-password', [StudentProfileController::class, 'updatePassword'])->name('profile.update.user.password');
});

/**
 * ------------------------------------------------------------
 * Instructor Dashboard Route
 * ------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function () {
    Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
