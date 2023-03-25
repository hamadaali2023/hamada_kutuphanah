<?php

namespace App\Providers;
use App\Cart;
use Illuminate\Support\ServiceProvider;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Auth;
use App\ContactInfo;
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
        // $cartcount=0;
        // $studentid   = Auth::guard('instructors')->user();  
        // // dd($studentid); 
        // if($studentid){
        //     $cont = Cart::where('userId',$studentid->id);
        //     $cartcount = $cont->count();
        //    // dd($cartcount);
        //    view()->share('cartcount', $cartcount);
        // }
        // view()->share('cartcount', $cartcount);
        
        $cont = ContactInfo::first();
        view()->share('contact', $cont);
    }
}
