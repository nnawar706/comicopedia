<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\BannerSettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\VolumeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;


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
            Route::get('read-notification', 'markRead');
            Route::put('change-password', 'changePassword')->name('admin-change-pwd');
            Route::put('change-info', 'changeInfo')->name('admin-change-info');
            Route::post('change-photo', 'changePhoto')->name('admin-change-photo');
            Route::get('logout', 'logout')->name('admin-logout');

        });

        Route::controller(RolePermissionController::class)->group(function () {

            Route::get('roles', 'getRoles')->name('role-list');
            Route::get('roles/create', 'createView')->name('create-role-view');
            Route::post('roles', 'store')->name('create-role');
            Route::put('roles/{id}', 'updateRole')->name('update-role');

        })->middleware('permission:role & permissions');

        Route::controller(GeneralSettingController::class)->group(function () {

            Route::get('settings', 'show')->name('settings');
            Route::post('site-information', 'updateInfo')->name('update-info');
            Route::put('general-config', 'updateConfig')->name('update-config');

        })->middleware('permission:update website setting');

        Route::controller(BannerSettingController::class)->group(function () {

            Route::get('banners', 'getAll')->name('banner-list')->middleware('permission:banner list');
            Route::get('banners/{id}', 'read')->name('banner-read')->middleware('permission:banner list');
            Route::post('banners/{id}', 'store')->name('store-banner')->middleware('permission:add banner');
            Route::get('banners/delete/{id}', 'delete')->name('delete-banner')->middleware('permission:delete banner');

        });

        Route::controller(UserController::class)->group(function () {

            Route::get('users', 'getAll')->name('user-list');

        });

        Route::controller(AdminController::class)->group(function () {

            Route::get('admins', 'getAll')->name('admin-list')->middleware('permission:user list');
            Route::get('admins/read/{id}', 'read')->name('read-admin-view')->middleware('permission:user information');
            Route::get('admins/store', 'createView')->name('create-admin-view')->middleware('permission:add user');
            Route::post('admins', 'store')->name('create-admin')->middleware('permission:add user');
            Route::get('admins/change-status/{id}', 'updateStatus')->name('change-status')->middleware('permission:activate/deactivate user');
            Route::get('admins/delete/{id}', 'delete')->name('admin-delete')->middleware('permission:delete user');

        });

        Route::controller(MessageController::class)->group(function () {

            Route::get('subscriber-list', 'getAll')->name('subscriber-list');
            Route::get('send-newsletter', 'getView')->name('send-newsletter');
            Route::post('send-mail', 'sendMail')->name('send-mail');

        });

        Route::controller(CategoryController::class)->group(function () {

            Route::get('category-list', 'index');
            Route::get('categories', 'getAll')->name('show-categories')->middleware('permission:genre list');
            Route::put('categories/re-shuffle', 'shuffle')->name('shuffle-categories')->middleware('permission:reshuffle genre');
        });

        Route::controller(ItemController::class)->group(function () {

            Route::get('series', 'getAll')->name('show-items')->middleware('permission:series list');
            Route::get('series/create', 'createView')->name('create-item-view')->middleware('permission:add series');
            Route::get('series/read/{id}', 'read')->name('read-item-view')->middleware('permission:add series');
            Route::post('series', 'create')->name('create-item')->middleware('permission:add series');
            Route::post('series/{id}', 'update')->name('update-item')->middleware('permission:update series');
            Route::delete('series/{id}', 'delete')->name('delete-item')->middleware('permission:delete series');

        });

        Route::controller(VolumeController::class)->group(function () {

            Route::get('volumes', 'getAll')->name('show-volumes');
            Route::get('volumes/read/{id}', 'read')->name('read-volume-view');
            Route::get('volumes/change_status/{id}', 'changeStatus');
            Route::get('volumes/create', 'createView')->name('create-volume-view');
            Route::post('volumes', 'create')->name('create-volume');
            Route::put('volumes/update/{id}', 'update')->name('update-volume');
            Route::get('series/volumes/{id}', 'volumeList');
        });

        Route::controller(ReportController::class)->group(function () {

            Route::get('admins/export-data/all', 'exportAdmins')->name('export-admins');
            Route::get('series/export-data/all', 'exportSeries')->name('export-series');
            Route::get('volumes/export-data/all', 'exportVolumes')->name('export-volumes');
        });

    });

});


