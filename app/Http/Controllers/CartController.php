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
    }
    public function index()
    {
        return view('web.cart');
    }

    

    public function addToCart(Request $request)
    {
        // $cart = session()->get('cart');
        // dd($cart);
        // $request->bookId
        // dd('utftujb');
        $book = Story::find($request->bookId);

        if(!$book) {
            abort(404);
        }
        $cart = session()->get('cart');
        
        if(!$cart) {
            $cart = [
                    $request->bookId => [
                        "name" => $book->name,
                        "quantity" => 1,
                        "price" => $book->price,
                        "photo" => $book->photo
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        // if(isset($cart[$request->bookId])) {
        //     $cart[$request->bookId]['quantity']++;
        //     session()->put('cart', $cart);
        //     return redirect()->back()->with('success', 'Product added to cart successfully!');
        // }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$request->bookId] = [
            "name" => $book->name,
            "quantity" => 1,
            "price" => $book->price,
            "photo" => $book->photo
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
        
    }    
    

    // public function update(Request $request)
    // {
    //     if($request->id and $request->quantity)
    //     {
    //         $cart = session()->get('cart');
    //         $cart[$request->id]["quantity"] = $request->quantity;
    //         session()->put('cart', $cart);
    //         session()->flash('success', 'Cart updated successfully');
    //     }
    // }
    
    public function destroy(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }   
    }
}
