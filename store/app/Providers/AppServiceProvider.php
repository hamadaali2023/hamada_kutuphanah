<?php

namespace App\Providers;
use App\Cart;
use Illuminate\Support\ServiceProvider;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Auth;
use App\ContactInfo;
use App\Category;

use App\Instructor;
use App\Notification;
use App\SubCategory;
use App\User;
use App\ChildCategory;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // if(session()->get('locale')){
        //         $tr = new GoogleTranslate(session()->get('locale')); 
        //         $langg=session()->get('locale');
        // }else{
        //         $tr = new GoogleTranslate(app()->getLocale()); 
        //         $langg=app()->getLocale();
        // }
         
        // view()->share('tr', $tr);
        // view()->share('langg', $langg);

        // start notification
        $cont = ContactInfo::first();
        view()->share('contact', $cont);


    }
}
