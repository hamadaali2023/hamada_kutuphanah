<?php

namespace App\Http\Controllers\Instructor;
use App\User;
use App\ContactInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Country;
use App\City;
use DB;
use App\Bank;

use App\Instructor;
use App\Student;

class ProfileController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $countries=Country::all();
        $userid = Auth::guard('instructors')->user();
        $users=instructor::findOrFail($userid->id);
        $country=Country::where('id',$userid->countryId)->first();
        $users->country=$country->name;
        return view('instructor.profile',compact('users','countries'));
    }
   
    public function agreements()
    {
        return view('instructor.agreement');
    }


    public function updateProfile(Request $request)
    {
        $userid = Auth::guard('instructors')->user();

        $edit = instructor::findOrFail($userid->id);
        $edit->name    = $request->name;
        $edit->mobile  = $request->mobile;
        // $add->detail  = $request->detail; 
        // $add->countryId  = $request->countryId; 
        // $add->cityId  = $request->cityId;         
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/profiles';
            $request-> file('photo') ->move($path,$file_name);
            $edit->photo  =$file_nameone;
        }else{
            $edit->photo  = $request->url; 
        }
        $edit->save();
        return back()->with("success", 'تم التعديل بنجاح'); 
    }

    
      public function changePassword(Request $request){
        $user= Auth::guard('instructors')->user();
        // $this->validate($request, [
        //     'current-password'     => 'required',
        //     'new-password'     => 'required',
        //     // 'confirm_password' => 'required|same:new_password',
        // ]);

        $this->validate( $request,[          
                'current-password'=>'required',
                'new-password'=>'required',
            ],
            [
                'current-password'=>'required',
                'new-password'=>'required',
            ]
        );



        // dd('ugutg');
        if (!(Hash::check($request->get('current-password'), $user->password))) {
            return redirect()->back()->with("errorss","كلمة المرور الحالية لا تتطابق مع كلمة المرور التي قدمتها. حاول مرة اخرى.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("errorss","لا يمكن أن تكون كلمة المرور الجديدة هي نفسها كلمة مرورك الحالية. الرجاء اختيار كلمة مرور مختلفة.");
        }
        // dd('veferfrr');
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("message","تم تغيير الرقم السري بنجاح !");
    }
    public function getCity($id){
        echo json_encode(DB::table('cities')->where('countryId', $id)->get());
    }
    public function bankDetails()
    {        
        $userid = Auth::guard('instructors')->user();
        $bankdetails=Bank::where('userId',$userid->id)->first();
        $country= Country::All();
        $cities= City::All();
        // dd($cities);
        $cities=City::all();
        foreach ($cities as $item) {
            $item->country= Country::where('id',$item->countryId)->first();
        }
        return view('instructor.bank.edit',compact('bankdetails','country','cities'));
    }
    public function updateBankDetails(Request $request)
    {
        $this->validate( $request,[          
                'countryId'=>'required',
                // 'cityId'=>'required',
                'persone_name'=>'required',
                'bank_name'=>'required',
                'bank_sub_name'=>'required',
                'acount_number'=>'required',  
            ],
            [
                'countryId.required'=>'الدولة مطلوبه',
                // 'cityId.required'=>' المدينة  مطلوبه ',
                'persone_name.required'=>' اسم الشخص صاحب الحساب مطلوب  ', 
                'bank_name.required'=>' اسم البنك مطلوب   ', 
                'bank_sub_name.required'=>' اسم فرع البنك الذي تم فيه فتح الحساب مطلوب  ', 
                'acount_number.required'=>' رقم الحساب ',

            ]
        );

         $userid = Auth::guard('instructors')->user();
         $edit = Bank::where('userid',$userid->id)->first();
         $edit->persone_name  = $request->persone_name;
         $edit->iban  = $request->iban;
         $edit->countryId  = $request->countryId;
         $edit->cityId  = $request->cityId;
         $edit->bank_name  = $request->bank_name;
         $edit->bank_sub_name  = $request->bank_sub_name;
         $edit->acount_number  = $request->acount_number;
         $edit->swift_code  = $request->swift_code;

         $edit->save();
         return back()->with("message", 'تم التعديل بنجاح'); 
    }








}
