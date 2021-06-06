<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\AreaController;


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

// use App\Models\PermissionGroup;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {

    // === Not login admin routes ===
    Route::middleware(['admin.guest'])->group(function () {
        Route::get('login', [AuthController::class, 'loginForm'])->name('admin-login');
        Route::get('forget-password', [AuthController::class, 'forgetPasswordForm'])->name('admin-forget-password');
        Route::get('reset-password', [AuthController::class, 'resetPasswordForm'])->name('admin-reset-password');
        Route::post('submit-login',[AuthController::class, 'submitLogin'])->name('admin-submit-login');
        Route::post('submit-forget-password', [AuthController::class, 'submitForgetPassword'])->name('admin-submit-forget-password');
        Route::post('submit-reset-password', [AuthController::class, 'submitResetPassword'])->name('admin-submit-reset-password');
    });

    // === Login admin routes ===
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/', [HomeController::class, 'index']);
        Route::get('home', [HomeController::class, 'index'])->name('admin-home');
        Route::post('logout', [AuthController::class, 'logout'])->name('admin-logout');
        Route::get('profile', [AuthController::class, 'profile'])->name('admin-profile');
        Route::put('update-profile', [AuthController::class, 'updateProfile'])->name('admin-update-profile');
        Route::resource('admins', AdminController::class);
        Route::resource('roles', RoleController::class);
        Route::get('role-admins/{role?}', [AdminController::class, 'index'])->name('role-admins');
        Route::resource('countries', CountryController::class);
        Route::get('toJsonData', [CountryController::class, 'toJsonData'])->name('toJsonData');
        Route::resource('cities', CityController::class);
        Route::get('country-cities/{countryId}', [CityController::class, 'countryCities'])->name('admin-country-cities');
        Route::resource('areas', AreaController::class);
        Route::get('city-areas/{cityId}', [AreaController::class, 'cityAreas'])->name('admin-city-areas');
        Route::resource('pages', PageController::class);
        Route::get('settings', [SettingController::class, 'index'])->name('admin-settings');
        Route::put('settings', [SettingController::class, 'update'])->name('admin-update-settings');
        Route::get('change-language/{lang}', [SettingController::class, 'changeLanguage'])->name('admin-change-language');
        Route::get('download-country-pdf', [CountryController::class, 'downloadPdf'])->name('download-country-pdf');
        Route::get('download-admin-pdf', [AdminController::class, 'downloadPdf'])->name('download-admin-pdf');
        Route::get('download-role-pdf', [RoleController::class, 'downloadPdf'])->name('download-role-pdf');
        Route::get('download-city-pdf', [CityController::class, 'downloadPdf'])->name('download-city-pdf');
        Route::get('download-area-pdf', [AreaController::class, 'downloadPdf'])->name('download-area-pdf');
        Route::get('download-page-pdf', [PageController::class, 'downloadPdf'])->name('download-page-pdf');
    });

});
