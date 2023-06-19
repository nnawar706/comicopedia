<?php

use App\Http\Controllers\BannerSettingController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', [AuthController::class, 'loginForm'])->name('login-form');
    Route::post('login', [AuthController::class, 'login'])->name('admin-login');

    Route::group(['middleware' => 'auth.admin'], function () {

        Route::controller(AuthController::class)->group(function () {

            Route::get('dashboard', 'dashboard')->name('admin-dashboard');
            Route::get('profile', 'profile')->name('admin-profile');
            Route::get('permissions', 'getPermissions')->name('admin-permissions');
            Route::put('change-password', 'changePassword')->name('admin-change-pwd');
            Route::put('change-info', 'changeInfo')->name('admin-change-info');
            Route::post('change-photo', 'changePhoto')->name('admin-change-photo');
            Route::get('logout', 'logout')->name('admin-logout');

        });

        Route::controller(GeneralSettingController::class)->group(function () {

            Route::get('settings', 'show')->name('settings');
            Route::post('site-information', 'updateInfo')->name('update-info');
            Route::put('general-config', 'updateConfig')->name('update-config');

        });

        Route::controller(BannerSettingController::class)->group(function () {

            Route::get('banners', 'getAll')->name('banner-list');
            Route::post('banners', 'store')->name('store-banner');
            Route::delete('banners/{id}', 'delete')->name('delete-banner');

        });

        Route::controller(UserController::class)->group(function () {

            Route::get('user-list', 'getAll')->name('user-list');

        });

        Route::controller(MessageController::class)->group(function () {

            Route::get('subscriber-list', 'getAll')->name('subscriber-list');
            Route::get('send-newsletter', 'getView')->name('send-newsletter');
            Route::post('send-mail', 'sendMail')->name('send-mail');

        });

        Route::controller(CategoryController::class)->group(function () {

            Route::get('categories', 'getAll')->name('show-categories');
            Route::post('categories', 'create')->name('create-category');
            Route::put('categories/re-shuffle', 'shuffle')->name('shuffle-categories');
        });

        Route::controller(CategoryController::class)->group(function () {});

    });

});


