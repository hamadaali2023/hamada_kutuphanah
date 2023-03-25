<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use DB;
use Crypt;
use App\Story;
use App\Category;   
use Hash;
use Auth;
class CartController extends Controller
{

     public function __construct()
    {
        $this->middleware(Auth::guard('instructors')->user());
        // $this->middleware('permission:specialities', ['only' => ['index']]);
        // $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        // $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        // $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);

    }
    public function index()
    {
        $user = Auth::guard('instructors')->user();
        // dd(Auth::guard('students')->user()->name);
        // dd($user->email);
        $carts= Cart::where('userId',$user->id)->get();
        // $cartsssss= Story::where('id',$carts->courseId)->sum('price');
        // dd($cartsssss);
        $sum=0;
        foreach ($carts as $item) {       
            $cartsssss= Story::where('id',$item->bookId)->sum('price');   
            $sum+= $cartsssss;
            $item->cartsssss= Story::where('id',$item->bookId)->sum('price');
            $bookid= Story::where('id',$item->bookId)->first();

            $item->book= Story::where('id',$item->bookId)->first();
            $item->category= Category::where('id',$bookid->categoryId)->first();
        }
        // dd($sum);
        return view('web.cart',compact('carts','sum'));
    }

    

    public function addtocart(Request $request)
    {
        if(Auth::guard('instructors')->user()==null){
            return redirect('login/user')->with("message", 'تم الاضافة'); 
        }else{
            $cart_check=Cart::where('bookId',$request->bookId)->first();
            // dd($cart_check);
            if($cart_check){
                return redirect()->back(); 
            }else{
                $user = Auth::guard('instructors')->user();
                $add = new Cart;
                $add->bookId    = $request->bookId;
                $add->userId    = $user->id;
                $add->save();
                return redirect()->back()->with("message", 'تم الاضافة');
            }
            
        }
        


    }
    public function show(Cart $cart)
    {
        //
    }

    public function edit(Cart $cart)
    {
        //
    }

    public function update(Request $request, Cart $cart)
    {
        //
    }

    public function destroy(Request $request)
    {
        $delete = Cart::findOrFail($request->id);
        $delete->delete();
            return back()->with("message",'تم الحذف بنجاح');    
    }
}
