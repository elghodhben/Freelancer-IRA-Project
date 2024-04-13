<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/administrateur', function () {
    return redirect('/admin/login');
});

Route::get('/admin/login', function () {
    return view('admin.login'); // Replace 'admin.login' with the actual view name for your login page
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function (){
    Route::match(['get','post'],'login','adminController@login');
    //Route::group(['middleware'=>['admin']],function (){
    Route::get('/dashboard','adminController@dashboard');
    Route::get('/users','adminController@users');
    Route::post('update-user-status','adminController@UpdateUserStatus');
    Route::get('logout','adminController@logout');
    // });
});
