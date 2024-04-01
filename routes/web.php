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

route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function (){

 Route::match(['get','post'],'login','adminController@login');
 //Route::group(['middleware'=>['admin']],function (){

  route::get('/dashboard','adminController@dashboard');
  route::get('/users','adminController@users');

  Route::post('update-user-status','adminController@UpdateUserStatus');


  Route::get('logout','adminController@logout');

  // });


});

