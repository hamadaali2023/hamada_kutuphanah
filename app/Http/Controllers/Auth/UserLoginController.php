<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Instructor;
use App\Student;
use DB;
use Crypt;
use Hash;
use Auth;

use Carbon\Carbon; 

use Mail; 

use Illuminate\Support\Str;
class UserLoginController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
    public function UserLogin()
    {   
        return view('web.loginuser');
    }

    public function LoginUser(request $request)
    {
        $this->validate(request(),[
                'email'    => 'required',
                'password' => 'required',
            ],
            [
               'email.required'=>__('home.email-required'),
               'password.required'=>__('home.password-required'),
            ]
        );
        if(session()->get('locale')){
            $langg=session()->get('locale');
        }else{
            $langg=app()->getLocale();
        }
        $credentials = $request -> only(['email','password']);
        $checkinstructor = Instructor::where("email" , $request->email)->first();

        if($checkinstructor){
        if($checkinstructor->is_activated ==0)
        {
            // Auth::guard('students')->logout();
            if($langg == 'en' ){
              return redirect('login/user')->with("errorss", 'The account is not activated'); 
            }else{
              return redirect('login/user')->with("errorss", 'الحساب غير مفعل'); 
            }
          }else{
            $good = Auth::guard('instructors') -> attempt($credentials);
            if($good ) {
               return redirect('/');
            }else{
              if($langg == 'en' ){
                return redirect('login/user')->with("errorss", 'The login information is incorrect'); 
              }else{
                return redirect('login/user')->with("errorss", 'بيانات الدخول غير صحيحة'); 
              }
            }
          }
         
      }else{
        if($langg == 'en' ){
          return redirect('login/user')->with("errorss", 'The login information is incorrect'); 
        }else{
          return redirect('login/user')->with("errorss", 'بيانات الدخول غير صحيحة'); 
        }
      }
      // if($checkinstructor){
      //     $good =  Auth::guard('instructors') -> attempt($credentials);
      //     if($good ) {
      //         $user = Auth::guard('instructors')->user();
      //         if($user->is_activated ==0)
      //         {
      //           Auth::guard('students')->logout();
      //           return redirect('login/user')->with("errorss", 'الحساب غير مفعل'); 
      //         }
      //       return redirect('/');
      //     }
      // }else{
      //   return redirect('login/user')->with("errorss", 'بيانات الدخول غير صحيحة'); 
      // }
    }

    public function forgotPassword()
    {   
        return view('auth.forgetpassword');
    }

    public function submitForgot(Request $request)
    {
      // dd('iughiu');
          $request->validate([
              'email' => 'required|email|exists:instructors',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
          ]);
  
          Mail::send('emails.forgetpassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          if(session()->get('locale')){
              $langg=session()->get('locale');
          }else{
              $langg=app()->getLocale();
          }

         

          if($langg == 'en' ){
            return back()->with('message', 'We have e-mailed your password reset link! ');
          }else{
            return back()->with('message', 'لقد أرسلنا رابط إعادة تعيين كلمة المرور بالبريد الإلكتروني!');
          }
    }


    public function resetUserPasswordGet($token) { 
         return view('auth.forgetpasswordlink', ['token' => $token]);
    }


    public function resetUserPasswordPost(Request $request)
    {
          $request->validate([
              // 'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6',
              'password_confirmation' => 'required_with:password|same:password|min:6'
          ]);
  
          $updatePassword = DB::table('password_resets')->where([
                                // 'email' => $request->email, 
                                'token' => $request->token
                              ])->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
          $user = Instructor::where('email', $updatePassword->email)->first();
          // $user->email  = $request->email;   
          $user->password  = bcrypt($request->password); 
          $user-> save();
          // $user = Instructor::where('email', $request->email)
          //             ->update(['password' => Hash::make($request->password)]);
 

          DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();
          if(session()->get('locale')){
              $langg=session()->get('locale');
          }else{
              $langg=app()->getLocale();
          }

         

          if($langg == 'en' ){
            return redirect('/login/user')->with('message', 'Your password has been changed! ');
          }else{
            return redirect('/login/user')->with('message', 'تم تغيير كلمة السر الخاصة بك!');
          }
    }












    public function signOutInstructors() {
      Auth::guard('students')->logout();
      return redirect('/');
    }
    // public function signOutInstructors() {
    //   Auth::guard('students')->user()::logout();
    //   return redirect('/');
    // }
    public function signOut() {
      Auth::logout();
      return redirect('/');
    }

    
}
