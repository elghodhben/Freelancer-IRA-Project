<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuth\adminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/')->namespace('App\Http\Controllers\AdminAuth')->group(function () {

    Route::match(['get', 'post'],'/login', [adminController::class, 'login'])->name('admin.login');

/*     Route::middleware([Admin::class])->group(function () { */
        Route::get('/dashboard', [adminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [adminController::class, 'users'])->name('admin.users');
        Route::post('/update-user-status', [adminController::class, 'updateUserStatus'])->name('admin.updateUserStatus');
        Route::get('/logout', [adminController::class, 'logout'])->name('admin.logout');
        Route::get('/delete-user/{id}', [adminController::class, 'delete'])->name('admin.deleteUser');
    });
/* }); */
