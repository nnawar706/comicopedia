<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\BannerSettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\VolumeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReviewController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('welcome');
    })->name('dashboard');
});

Route::controller(EcommerceController::class)->group(function () {
    Route::get('/', 'getMainPage')->name('welcome');
    Route::get('genres/{id}', 'getGenre')->name('genre-info');
    Route::get('items/{id}', 'getItem')->name('item-info');
    Route::get('volumes/{id}', 'getVolume')->name('volume-info');

    Route::post('subscribe', 'subscribe')->name('subscribe');
    Route::post('review/volume/{id}', 'rateVolume')->name('rate-volume');
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

            Route::get('banners', 'getAll')->name('banner-list')->middleware(['auth:admin', 'permission:banner list,admin']);
            Route::get('banners/{id}', 'read')->name('banner-read')->middleware(['auth:admin', 'permission:banner list,admin']);
            Route::post('banners/{id}', 'store')->name('store-banner')->middleware(['auth:admin', 'permission:add banner,admin']);
            Route::get('banners/delete/{id}', 'delete')->name('delete-banner')->middleware(['auth:admin', 'permission:delete banner,admin']);

        });

        Route::controller(UserController::class)->group(function () {

            Route::get('users', 'getAll')->name('user-list');

        });

        Route::controller(AdminController::class)->group(function () {

            Route::get('admins', 'getAll')->name('admin-list')->middleware(['auth:admin', 'permission:user list,admin']);
            Route::get('admins/read/{id}', 'read')->name('read-admin-view')->middleware(['auth:admin', 'permission:user information,admin']);
            Route::get('admins/store', 'createView')->name('create-admin-view')->middleware(['auth:admin', 'permission:add user,admin']);
            Route::post('admins', 'store')->name('create-admin')->middleware(['auth:admin', 'permission:add user,admin']);
            Route::get('admins/change-status/{id}', 'updateStatus')->name('change-status')->middleware(['auth:admin', 'permission:activate/deactivate user,admin']);
            Route::get('admins/delete/{id}', 'delete')->name('admin-delete')->middleware(['auth:admin', 'permission:delete user,admin']);

        });

        Route::controller(SubscriberController::class)->group(function () {

            Route::get('subscriber-list', 'getAll')->name('subscriber-list');
            Route::get('send-newsletter', 'getView')->name('send-newsletter');
            Route::post('send-mail', 'sendMail')->name('send-mail');

        });

        Route::controller(CategoryController::class)->group(function () {

            Route::get('category-list', 'index');
            Route::get('categories', 'getAll')->name('show-categories')->middleware(['auth:admin', 'permission:genre list,admin']);
            Route::put('categories/re-shuffle', 'shuffle')->name('shuffle-categories')->middleware(['auth:admin', 'permission:reshuffle genre,admin']);
        });

        Route::controller(ItemController::class)->group(function () {

            Route::get('series', 'getAll')->name('show-items')->middleware(['auth:admin', 'permission:series list,admin']);
            Route::get('series/create', 'createView')->name('create-item-view')->middleware(['auth:admin', 'permission:add series,admin']);
            Route::get('series/read/{id}', 'read')->name('read-item-view')->middleware(['auth:admin', 'permission:add series,admin']);
            Route::post('series', 'create')->name('create-item')->middleware(['auth:admin', 'permission:add series,admin']);
            Route::post('series/{id}', 'update')->name('update-item')->middleware(['auth:admin', 'permission:update series,admin']);
            Route::delete('series/{id}', 'delete')->name('delete-item')->middleware(['auth:admin', 'permission:delete series,admin']);

        });

        Route::controller(VolumeController::class)->group(function () {

            Route::get('volumes', 'getAll')->name('show-volumes')->middleware(['auth:admin', 'permission:volume list,admin']);
            Route::get('volumes/read/{id}', 'read')->name('read-volume-view')->middleware(['auth:admin', 'permission:volume list,admin']);
            Route::get('volumes/change_status/{id}', 'changeStatus')->middleware(['auth:admin', 'permission:update volume,admin']);
            Route::get('volumes/create', 'createView')->name('create-volume-view')->middleware(['auth:admin', 'permission:add volume,admin']);
            Route::post('volumes', 'create')->name('create-volume')->middleware(['auth:admin', 'permission:add volume,admin']);
            Route::put('volumes/update/{id}', 'update')->name('update-volume')->middleware(['auth:admin', 'permission:update volume,admin']);
            Route::get('series/volumes/{id}', 'volumeList')->middleware(['auth:admin', 'permission:delete volume,admin']);

        });

        Route::controller(ReviewController::class)->group(function () {

            Route::get('review/delete/{id}', 'delete')->name('review-delete')->middleware(['auth:admin', 'permission:delete-review,admin']);
        });

        Route::controller(ReportController::class)->group(function () {

            Route::get('admins/export-data/all', 'exportAdmins')->name('export-admins');
            Route::get('series/export-data/all', 'exportSeries')->name('export-series');
            Route::get('volumes/export-data/all', 'exportVolumes')->name('export-volumes');
        });

    });

});


