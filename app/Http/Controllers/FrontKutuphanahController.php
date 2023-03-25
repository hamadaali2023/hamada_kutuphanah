<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use App\Language;
use App\Country;
use App\User;
use App\Instructor;

use App\Story;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\TranslateClient;
use Mail;
 use Stichoza\GoogleTranslate\GoogleTranslate;
 use Auth;
 use App\Bank;
 use App\Cart;
class FrontKutuphanahController extends Controller
{
    public function Books()
    {
        // $tr = new GoogleTranslate('ar');
        // echo $tr->translate('Hello World!');
        // dd('refrfe');
        $categories=Category::all();
        $books=Story::all();
        foreach ($books as $item) {            
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->country= Country::where('id',$item->countryId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
        }
        // dd($categories);
        return view('web.home',compact('books','categories'));
    }

    // public function searching(Request $request) {
    //     $text = $request->input('txtSearch');
    //     $patients = DB::table('books')->where('name', 'Like', "$text")->get();
    //     return response()->json($patients);
    // }


    public function searching(Request $request){
        
        if($request->ajax()) {
          
           $data = Story::where('name', 'LIKE', $request->country.'%')->get();
           foreach ($data as $item) {            
                $item->instructor= Instructor::where('id',$item->userId)->first();
                $item->country= Country::where('id',$item->countryId)->first();
                $item->category= Category::where('id',$item->categoryId)->first();
                $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            }
           
            return $data;
        }
    }

    public function getbookbycategory(Request $request){
        
        if($request->ajax()) {
            if($request->categoryId==0){
                $data =Story::all();
            }else{
                $data = Story::where('categoryId', $request->categoryId)->get();
            }
            foreach ($data as $item) {            
                $item->instructor= Instructor::where('id',$item->userId)->first();
                $item->country= Country::where('id',$item->countryId)->first();
                $item->category= Category::where('id',$item->categoryId)->first();
                $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            }
           
            return $data;
        }
    }


   
    public function BookDetails($slug)
    {
        $details=Story::where('slug',$slug)->first();                   
        // $lang= Language::where('id',$details->languageId)->first();
        $country= Country::where('id',$details->countryId)->first();
        $category= Category::where('id',$details->categoryId)->first();
        $subcategory= SubCategory::where('id',$details->subCategoryId)->first();
        return view('web.details',compact('details','country','category','subcategory'));
    }



    public function bankdetails()
    {
        $user = Auth::guard('instructors')->user();  
        $bank= Bank::where('userId',$user->id)->first();
        return view('web.bank-details',compact('user','bank'));
    }

    public function updateBankDetails(Request $request)
    {
        $this->validate( $request,[          
                'countryId'=>'required',
                'cityId'=>'required',
                'persone_name'=>'required',
                'bank_name'=>'required',
                'bank_sub_name'=>'required',
            ],
            [
                'countryId.required'=>'الدولة مطلوبه',
                'cityId.required'=>' المدينة  مطلوبه ',
                'persone_name.required'=>' اسم الشخص صاحب الحساب مطلوب  ', 
                'bank_name.required'=>' اسم البنك مطلوب   ', 
                'bank_sub_name.required'=>' اسم فرع البنك الذي تم فيه فتح الحساب مطلوب  ', 
            ]
        );

         $userid = Auth::guard('instructors')->user();
         $edit = Bank::where('userId',$userid->id)->first();
         // dd($edit);
         $edit->persone_name  = $request->persone_name;
         $edit->iban  = $request->iban;
         $edit->countryId  = $request->countryId;
         $edit->cityId  = $request->cityId;
         $edit->bank_name  = $request->bank_name;
         $edit->acount_number  = $request->acount_number;

         $edit->bank_sub_name  = $request->bank_sub_name;
         $edit->swift_code  = $request->swift_code;

         $edit->save();
         return back()->with("message", 'تم التعديل بنجاح'); 
    }
    // public function useraddtocart(Request $request){
    //     dd('ihiybbk');
    // }
    // public function useraddtocart(Request $request)
    // {
    //     // dd('utftujb');
    //     if(Auth::guard('instructors')->user()==null){
    //         return redirect('login/user'); 
    //     }else{
    //         $cart_check=Cart::where('bookId',$request->bookId)->first();
    //         // dd($cart_check);
    //         if($cart_check){
    //             return redirect()->back(); 
    //         }else{
    //             $user = Auth::guard('instructors')->user();
    //             $add = new Cart;
    //             $add->bookId    = $request->bookId;
    //             $add->userId    = $user->id;
    //             $add->save();
    //             return redirect()->back()->with("message", 'تم الاضافة');
    //         }   
    //     }
    // }    
    public function mywishlist()
    {
        $user = Auth::guard('instructors')->user();  
        return view('web.mywishlist',compact('user'));
    }

    public function myprofile()
    {
        $user = Auth::guard('instructors')->user();  
        return view('web.myprofile',compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $userid = Auth::guard('instructors')->user();
        $edit = instructor::findOrFail($userid->id);
        $edit->name    = $request->name;
        $edit->mobile  = $request->mobile;
        $edit->detail  = $request->detail;
        $edit->dateOfBirth  = $request->dateOfBirth;
        $edit->address  = $request->address; 
        // $edit->countryId  = $request->countryId; 
        // $edit->cityId  = $request->cityId;         
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo')-> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/profiles';
            $request-> file('photo') ->move($path,$file_name);
            $edit->photo  =$file_nameone;
        }else{
            $edit->photo  = $edit->photo; 
        }
        $edit->save();

        return back()->with("success", 'تم التعديل بنجاح'); 
    }


     public function becomeInstructor()
    {
        $user = Auth::guard('instructors')->user();  
        return view('web.become-instructor',compact('user'));
    }
    public function updatebecomeInstructor(Request $request)
    {
        $userid = Auth::guard('instructors')->user();
        $edit = instructor::findOrFail($userid->id);
        $edit->type    = $request->type;
        $edit->save();
        if ($request->type=='instructor') {
            return redirect()->to('instructor/dashboard')->with("success", 'تم التعديل بنجاح'); 
        }else{
            return back()->with("success", 'تم التعديل بنجاح'); 
        }
    }

    public function about()
    {
        return view('web.about');
    }
     public function contact()
    {
        return view('web.contact');
    }
     public function agreements()
    {
        return view('web.agreement');
    }


    
    public function termsconditions()
    {
        return view('web.terms');
    }
    public function return_policy()
    {
        return view('web.return_policy');
    }
    public function policy()
    {
        return view('web.policy');
    }
   
     public function teslive()
    {
        return view('testlive');
    }
    
    public function search()
    {
        return view('search');
    }
    
    public function reports()
    {
        
        return view('web.reports');
    }
    
    public function send_report(Request $request)
    {
        $input = $request->all();
        $this->validate( $request,[          
            'name' => "required",
            'email' => "required",
            'mobile' => "required",
            'report' => "required",
            ],
            [
                'name.required' => "ادخل الاسم",
                'email.required' => "ادخل البريد الإلكتروني",
                'mobile.required' => "ادخل رقم الهاتف",
                'report.required' => "ادخل تفاصيل البلاغ",
            ]
        );
       
        
            try {
                $details = [
                    'title' => 'شكاوى',
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'report' => $request->report,
                ];
                Mail::to("admin@kutuphanah.com")->send(new \App\Mail\SendReport($details));
                
                return redirect()->back()->with("message", 'تم ارسال بلاغك'); 
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        
    }

    
}
