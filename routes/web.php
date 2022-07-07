<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\OrangtuaController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SyaratController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\MahasiswaController as FrontendMahasiswaController;
use App\Http\Controllers\Frontend\OrangtuaController as FrontendOrangtuaController;
use App\Http\Controllers\Frontend\SyaratController as FrontendSyaratController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

    // Mahasiswa
    Route::delete('mahasiswas/destroy', [MahasiswaController::class, 'massDestroy'])->name('mahasiswas.massDestroy');
    Route::resource('mahasiswas', MahasiswaController::class);

    // Orangtua
    Route::delete('orangtuas/destroy', [OrangtuaController::class, 'massDestroy'])->name('orangtuas.massDestroy');
    Route::resource('orangtuas', OrangtuaController::class);

    // Syarat
    Route::delete('syarats/destroy', [SyaratController::class, 'massDestroy'])->name('syarats.massDestroy');
    Route::resource('syarats', SyaratController::class)->except('update');
    Route::patch('syarats/update/{syarat}', [SyaratController::class, 'update'])->name('syarats.update');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
    }
});
Route::group(['prefix' => 'frontend', 'as' => 'frontend.', 'middleware' => ['auth']], function () {
    Route::get('/', [FrontendHomeController::class, 'index'])->name('home');
    // Mahasiswa
    Route::delete('mahasiswas/destroy', [FrontendMahasiswaController::class, 'massDestroy'])->name('mahasiswas.massDestroy');
    Route::resource('mahasiswas', FrontendMahasiswaController::class);

    // Orangtua
    Route::delete('orangtuas/destroy', [FrontendOrangtuaController::class, 'massDestroy'])->name('orangtuas.massDestroy');
    Route::resource('orangtuas', FrontendOrangtuaController::class);

    // Syarat
    Route::delete('syarats/destroy', [FrontendSyaratController::class, 'massDestroy'])->name('syarats.massDestroy');
    Route::resource('syarats', FrontendSyaratController::class)->except('update');
    
    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
