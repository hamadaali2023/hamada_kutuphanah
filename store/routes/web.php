<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\User;

Auth::routes();
  
Route::get('/home', 'FrontKutuphanahController@index')->name('home');

Route::get('details/{slug}', 'FrontKutuphanahController@details');

Route::get('/dmin/dashboard', 'admin\DashBoardController@index');
  
Route::post('signoutinstructors', 'Auth\UserLoginController@signOutInstructors')->name('signoutinstructors');









##### end kutpana  ######################





