<?php

use App\Http\Controllers\Admin\KeysController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// Faqat asosiy sayt sahifalari uchun tilni almashtirish route
Route::get('/lang/{locale}', [LocalizationController::class, '__invoke'])->name('lang');

// Asosiy sahifalar
Route::group(['middleware' => ['language']], function () {

    // Page routes (Bosh sahifa, Biz haqimizda, Aloqa)
    Route::name('page.')->group(function () {
        Route::controller(HomeController::class)->group(function () {
            Route::get('/', 'index')->name('home');  // Bosh sahifa
        });
    });

    Route::middleware(['auth'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/dashboard/dismiss-welcome-alert', [DashboardController::class, 'dismissWelcomeAlert'])->name('dashboard.dismiss-welcome-alert');

        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

        Route::prefix('/admin')->group(function () {
            Route::resource('roles', RoleController::class);
            Route::resource('permissions', PermissionController::class);
            Route::resource('users', UserController::class);
            Route::resource('languages', LanguageController::class)->except(['show']);
            Route::get('/keys/search', [KeysController::class, 'search'])->name('keys.search');
            Route::resource('keys', KeysController::class);
            Route::resource('categories', controller: CategoryController::class);
        });
    });


    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
