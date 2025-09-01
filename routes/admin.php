<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionAdminController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordAdminController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationAdminController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptAdminController;
use App\Http\Controllers\Admin\Auth\NewPasswordAdminController;
use App\Http\Controllers\Admin\Auth\PasswordAdminController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkAdminController;
use App\Http\Controllers\Admin\Auth\RegisteredUserAdminController;
use App\Http\Controllers\Admin\Auth\VerifyEmailAdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\InstructorRequestAdminController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "guest:admin", "prefix" => "admin", "as" => "admin."], function () {
    Route::get('login', [AuthenticatedSessionAdminController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionAdminController::class, 'store'])->name('login');

    Route::get('forgot-password', [PasswordResetLinkAdminController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkAdminController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordAdminController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordAdminController::class, 'store'])
        ->name('password.store');
});

Route::group(["middleware" => "auth:admin", "prefix" => "admin", "as" => "admin."], function () {
    Route::get('verify-email', EmailVerificationPromptAdminController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailAdminController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationAdminController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordAdminController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordAdminController::class, 'store']);

    Route::put('password', [PasswordAdminController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionAdminController::class, 'destroy'])
        ->name('logout');


    /**
    * ------------------------------------------------------------
    * Dashboard Route
    * ------------------------------------------------------------
    */
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('instructor-requests', [InstructorRequestAdminController::class, 'index'])->name('instructor-requests');

});


