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


route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function (){

<<<<<<< HEAD



 Route::match(['get','post'],'login','adminController@login');
 Route::group(['middleware'=>['admin']],function (){
=======
 Route::match(['get','post'],'login','adminController@login');
 //Route::group(['middleware'=>['admin']],function (){
>>>>>>> 184cb556cfe738b593cd42a5497ceba887630191

  route::get('/dashboard','adminController@dashboard');
  route::get('/users','adminController@users');

  Route::post('update-user-status','adminController@UpdateUserStatus');


  Route::get('logout','adminController@logout');

<<<<<<< HEAD
   });
=======
  // });
>>>>>>> 184cb556cfe738b593cd42a5497ceba887630191


});

