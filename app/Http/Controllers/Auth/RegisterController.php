<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Instructor;
use App\Student;
use App\Wallet;
use App\Bank;
use Illuminate\Support\Str;
use Mail;
use DB;
use Crypt;
use Auth;
use App\Country;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function registerUser()
    {   
        $countries=Country::all();

        return view('web.register.author',compact('countries'));
    }
    public function getCountry($id){
        // dd($id);
        echo json_encode(DB::table('cities')->where('countryId', $id)->get());
    }
    public function registerNewUser(Request $request)
    {
        
        $this->validate( $request,[  
                'name'=>'required',
                // 'countryId'=>'required',
                'email'=>'required',
                'password'=>'required',
            ],
            [
                'name.required'=>'ادخل الاسم',
                // 'countryId.required'=>'اختر البلد',
                'email.required'=>'البريد الالكتروني مطلوب ',
                'password.required'=>'يرجى ادخال كلمة المرور ',
            ]
        );
        if(session()->get('locale')){
            $lang=session()->get('locale');
        }else{
            $lang=app()->getLocale();
        }
        $checkemail = Instructor::where("email" , $request->email)->first();
        if($checkemail){
            if(isset($lang)  && $lang == 'en' ){
                return back()->with("errorss", 'Email already exists'); 
            }else{
                return back()->with("errorss", 'البريد الإلكتروني موجود مسبقا'); 
            }
        }else{
            $add = new Instructor();
            $add->name  = $request->name;    
            $add->email  = $request->email;   
            $add->password  = bcrypt($request->password);
            // $add->countryId  = $request->countryId;
            $add->type  = 'instructor';
            $add-> save();
            // $add->mobile  = $request->mobile; 
            // $add->detail  = $request->detail; 
            // $add->cityId  = $request->cityId; 
            // $add->dateOfBirth  = $request->dateOfBirth; 
            // $add->address  = $request->address; 
            // $add->gender  = $request->gender;

            $createwallet = new Wallet;
            $createwallet->instructorId    = $add->id;
            $createwallet->save();

            $createwallet = new Bank;
            $createwallet->userId    = $add->id;
            $createwallet->save();

            $user = $add->toArray();
            $user['link'] = Str::random(30);
            DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);
            Mail::send('emails.activation', $user, function($message) use ($user){
                $message->to($user['email']);
                $message->subject('kutuphanah.com - Activation Code');
            });

            if($lang  && $lang == 'en' ){
                return redirect()->back()->with("message", 'Register successfully. Please visit your email'); 
            }else{
                return redirect()->back()->with("message", 'تم التسجيل بنجاح يرجي زيارة بريدك الإلكتروني'); 
            }
        }
    
    }
    public function instructorActivation($token){
        if(session()->get('locale')){
            $lang=session()->get('locale');
        }else{
            $lang=app()->getLocale();
        }
        $check = DB::table('user_activations')->where('token',$token)->first();
        if(!is_null($check)){
            $user = Instructor::find($check->id_user);
            if ($user->is_activated ==1){
                if($lang  && $lang == 'en' ){
                    return redirect()->to('/login/user')->with('Warning',"The account is activated"); 
                }else{
                    return redirect()->to('login/user')->with('message'," الحساب مفعل ");
                }
            }
            $user->update(['is_activated' => 1]);
            DB::table('user_activations')->where('token',$token)->delete();
            if($lang  && $lang == 'en' ){
                return redirect()->to('/login/user')->with('Warning',"Your account has been activated"); 
            }else{
                return redirect()->to('login/user')->with('message',"تم تفعيل حسابك");
            }
        }
        // return $this -> returnError('رمز التفعيل غير صالح');  
        // ");
        
            if($lang  && $lang == 'en' ){
                return redirect()->to('/login/user')->with('Warning',"Invalid activation code"); 
            }else{
                return redirect()->to('/login/user')->with('Warning',"رمز التفعيل غير صالح"); 
            }
    }
           

    
}
