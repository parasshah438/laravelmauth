<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminResetPasswordController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('admin.guest')->group(function () {
        Route::controller(LoginController::class)->group(function () {

            Route::get('/', function () {
                return redirect()->route('admin.login');
            });

            Route::get('login', 'showLoginForm')->name('login');
            Route::post('login', 'login')->name('login.submit');
        });

        Route::controller(AdminForgotPasswordController::class)->group(function () {
            Route::get('/password/reset','showLinkRequestForm')->name('password.request');
            Route::post('/password/email','sendResetLinkEmail')->name('password.email');
        });

        Route::controller(AdminResetPasswordController::class)->group(function () {
            Route::get('/password/reset/{token}','showResetForm')->name('password.reset');
            Route::post('/password/reset','reset')->name('password.update');
        });
    });

    Route::middleware('admin.auth')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
            Route::get('admin-logout',[DashboardController::class,'logout'])->name('logout');

            Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
            Route::post('/profile',[ProfileController::class, 'update_profile']);

            Route::get('/change-password', [ProfileController::class, 'change_password'])->name('change-password');
            Route::post('/change-password',[ProfileController::class, 'update_change_password']);

            Route::get('/cache-clear', [DashboardController::class, 'cacheClear'])->name('cache.clear');
        });
    });    
});