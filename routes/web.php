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



// Route::get('said/{lang}', function ($lang) {
//     App::setlocale($lang);
//             session()->put('locale', $lang);

//     return view('welcome');
// });
// Route::get('said', function () {
//     return view('welcome');
// });


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['middleware' => ['auth']], function() {
// 	Route::resource('roles','RoleController');
// 	Route::resource('users','Admin\UserController');
// 	Route::resource('products','ProductController');
// });


// start livewire route
  Route::view('add_parent','livewire.show_Form');
  Route::view('validd','livewire.validd');
// end livewire route



Route::get('lang/{locale}', 'LocalizationController@index');

// Route::get('/user/activation/{token}', 'UserController@userActivation');
Route::get('/instructor/activation/{token}', 'Auth\RegisterController@instructorActivation');
Route::get('/student/activation/{token}', 'UserController@studentActivation');
Route::get('/activated', function () {
    return view('emails.activated');
});
##### start kutpana  ######################

  Route::resource('sliderss','SliderController');

  Route::get('/style', 'HomeController@index')->name('home');

  Route::get('/', 'FrontKutuphanahController@Books');

  Route::get('book/{slug}', 'FrontKutuphanahController@BookDetails');

  Route::get('about', 'FrontKutuphanahController@about');

  Route::get('return_policy', 'FrontKutuphanahController@return_policy');

  Route::get('policy', 'FrontKutuphanahController@policy');

  Route::get('teslive', 'FrontKutuphanahController@teslive');

  Route::get('search', 'FrontKutuphanahController@search');

  Route::get('terms/conditions', 'FrontKutuphanahController@termsconditions')->name('terms.conditions');
  Route::get('agreements', 'FrontKutuphanahController@agreements')->name('agreements');
  
  Route::get('contact', 'FrontKutuphanahController@contact')->name('contact');

  Route::get('become-instructor', 'FrontKutuphanahController@becomeInstructor');

  Route::post('become-instructor-update', 'FrontKutuphanahController@updatebecomeInstructor')->name('become-instructor-update');

  Route::get('my-wishlist', 'FrontKutuphanahController@mywishlist');

  Route::get('bank-details', 'FrontKutuphanahController@bankdetails');

  Route::post('updatebankdetails', 'FrontKutuphanahController@updateBankDetails')->name('updatebankdetails');

  Route::get('my-profile', 'FrontKutuphanahController@myprofile');
  
  Route::post('updateprofile', 'FrontKutuphanahController@updateProfile')->name('updateprofile');
  

 	Route::get('login/user', 'Auth\UserLoginController@UserLogin')->name('login.user');
  Route::post('userlogin', 'Auth\UserLoginController@LoginUser')->name('userlogin');

  // Route::post('signoutotudent', 'Auth\UserLoginController@signOutStudent')->name('signoutotudent');
  Route::post('signoutinstructors', 'Auth\UserLoginController@signOutInstructors')->name('signoutinstructors');

  Route::get('create/acount', 'Auth\RegisterController@registerUser')->name('create.acount');
  Route::post('create/acount', 'Auth\RegisterController@registerNewUser')->name('create.acount');

  Route::get('forgot/password', 'Auth\UserLoginController@forgotPassword');
  Route::post('forgot/password', 'Auth\UserLoginController@submitForgot')->name('forgot.password.post');

  Route::get('reset-user-password/{token}', 'Auth\UserLoginController@resetUserPasswordGet')->name('reset-user-password');
  Route::post('reset-user-password', 'Auth\UserLoginController@resetUserPasswordPost')->name('reset-user-password.post');


   

    Route::get('getcounrty/{id}', 'Auth\RegisterController@getCountry');

    Route::get('getbookbycategory', 'FrontKutuphanahController@getbookbycategory')->name('getbookbycategory');

    Route::get('searchbook', 'FrontKutuphanahController@searching')->name('searchbook');
    // Route::post('user/addcart', 'FrontKutuphanahController@useraddtocart')->name('user.addcart');
 
	// Route::get('cart', 'CartController@index')->name('cart');
 //  Route::post('cart/delete', 'CartController@destroy')->name('cart.delete');

	// Route::post('user/cart', 'CartController@addtocart')->name('user.cart');
	





    Route::get('cart', 'CartController@index');
    Route::get('add-to-cart', 'CartController@addToCart')->name('add-to-cart');
    // Route::patch('update-cart', 'CartController@update');
    Route::delete('remove-from-cart', 'CartController@destroy');    	
	
    Route::get('reports', 'FrontKutuphanahController@reports')->name('reports');
    Route::post('send_report', 'FrontKutuphanahController@send_report')->name('send_report');

##### end kutpana  ######################





