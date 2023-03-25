<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

// هن اللوجن مش شغاله عشان ملف الروت الجديد لا يعم مع اللوجن


		// Route::get('departments/{id}/edit', 'DocumentController@edit');
		// Route::get('departments', 'DocumentController@update');
		Route::get('files/create', 'DocumentController@create');
		Route::post('files', 'DocumentController@store');
		Route::get('files', 'DocumentController@index');

		Route::post('files/{id}', 'DocumentController@show');
		Route::post('file/download/{file}', 'DocumentController@download');





// start livewire route

	// Route::view('booksss','livewire.index');

// end livewire route


 ###################### user-status ##############################
        // Route::post('users/status/{id}', 'UsersController@updateStatus')->name('users/status/{id}');

        ###################### admin-profile ##############################
       
Auth::routes();
Route::post('savevideo', 'Instructor\CourseController@addvideostore')->name('savevideo');
Route::get('removeVideoSessionItem/{id}', 'Instructor\CourseController@removeVideoSessionItem');

Route::group(['middleware' => 'checkInstructor','namespace' => 'Instructor','prefix' => 'instructor'], function () {

	Route::get('getSubCategory/{id}','BookController@getSubCategory');
	Route::get('getchildcategory/{id}','BookController@getChildCategory');

    Route::resource('students','StudentController');
    Route::resource('dashboard','DashBoardController');


    // Route::middleware(['checkInstructor'])->group(function(){

        Route::resource('stories','BookController');
    // });
    
    // Route::post('add-video-to-session', 'ProgressBarController@addVideoToSession');


    
    Route::resource('straights','LiveCourseController');    
    // Route::resource('straights','LiveCourseController');
    Route::resource('courses','CourseController');
    Route::resource('chapters','ChapterController');
    Route::resource('videos','VideoController');
    Route::get('allvideos/{id}','VideoController@allvideoss');
    Route::get('addvideos/{id}','VideoController@addvideos');

    Route::get('allsessions/{id}','SessionssController@allsessions');
    Route::get('addsessions/{id}','SessionssController@addsessions');


    Route::resource('sessions','SessionssController');
    Route::get('getchapter/{id}','BookController@getchapter');


    Route::get('report/sales','ReportController@sales');
    Route::get('report/transfers','ReportController@transfers');
    Route::get('report/statistics','ReportController@statistics');
   	Route::get('getbook/{id}', 'BookController@getbook');

    Route::get('profile', 'ProfileController@index');
    Route::get('bankdetails', 'ProfileController@bankDetails');
    Route::post('bankdetails','ProfileController@updateBankDetails')->name('bankdetails');
   	Route::get('getcity/{id}', 'ProfileController@getCity');

    Route::post('profile/update','ProfileController@updateProfile');
    Route::post('user/changepassword', 'ProfileController@changePassword')->name('user.changepassword');
	Route::get('agreements', 'ProfileController@agreements')->name('agreements');	    	
});	


