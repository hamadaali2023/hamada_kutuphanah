<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Image;

class FrontKutuphanahController extends Controller
{   
    public function index()
    {
        $categories=Category::all();
        $products=Product::all();
        foreach ($courses as $item) {            
            $item->image= Image::where('id',$item->userId)->first();
        }    
        return view('front.home',compact('products'));
    }

    public function getcoursesbycategory(Request $request){
        if($request->ajax()) {
            $data =Course::all();   
            return $data;
        }
    }

    public function details($slug)
    {
        $details=Product::where('slug',$slug)->first();
        $details->image=Image::where('productId',$details->id)->get();
        return view('front.details',compact('details'));
    }

    public function booking(Request $request)
    {
        
        $add = new Order;
        $add->productId    = $request->productId;
        $add->name    = $request->name;
        $add->phone  = $request->phone;
        $add->alternate_phone    = $request->alternate_phone;
        $add->cityId    = $request->cityId;
        $add->adress    = $request->adress;
        $add->type    = $request->type;       
        
        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

}
