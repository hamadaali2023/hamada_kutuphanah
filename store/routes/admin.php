<?php

use Illuminate\Support\Facades\Route;

// هن اللوجن مش شغاله عشان ملف الروت الجديد لا يعم مع اللوجن

// عند اضافه معلومات البنك

// اسم الفرع من ابنك  (اسم الرفعي اللي تم فيه فتح الحساب )
// اسم الشخص 
// سويفت كود 


// عند اضافه رقم ترخيص الكتاب 
// ف الكتب رقم الفسح

// السعر من ٢ الي ٩ ويجب ان تكون دنيماكيك

// ISBN غير اجباري


####  admin #######################

Route::get('admin-login', 'Auth\LoginController@LoginAdmin')->name('admin-login');
		Route::group(['middleware' => 'auth', 'namespace' => 'Admin','prefix' => 'admin',], function () {
		    Route::resource('dashboard','DashBoardController');
		    Route::resource('countries','CountryController');
		    Route::resource('cities','CityController');
		    Route::resource('categories','CategoryController');
		    Route::resource('products','ProductController');
		    Route::resource('orders','OrderController');
		    
  		Route::get('getsubcategory/{id}', 'ChildCategoryController@getsubcategory');
});








