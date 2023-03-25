<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\ContactInfo;
use App\Language;
use App\SubCategory;



use App\Category;
use App\Courses_joined;
use App\Instructor;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Auth;
use App\City;
use App\Country;
use App\Live;
use App\Session;
use Validator;

use Hash;
use App\Course;
use App\Chapter;
use App\Video;
use App\Review;
use App\ChildCategory;
use Mail;
use Password;
use Illuminate\Support\Str;

class HomeController extends Controller   
{  
    use GeneralTrait; 




    public function login(Request $request)
    {
         // $userid = Auth::guard('instructors')->user();
        // dd('vefuhivervrefre');
        try {
            $rules = [
                "email" => "required",
                "password" => "required",
                "device_token" => "required"
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
                
            $credentials = $request->only(['email','password']);

            $token =  Auth::guard('instructors-api') -> attempt($credentials);
            // dd($token);
            if(!$token)
                return $this -> returnError('البريد الإلكتروني أو كلمة المرور خطأ');
            
            $UserData = Instructor::where("email" , $request->email)->first();
            if($UserData->is_activated ==0)
            {
                return $this -> returnError('البريد الإلكتروني غير مفعل');
            }else{
                $admin = Auth::guard('instructors-api') -> user();
                $admin -> api_token = $token;
                $UserData->device_token=$request->device_token;
                $UserData->token=$token;
                $UserData->save();                    
                $user = Instructor::where('id',$UserData->id)->first();                    
                $user->photo= "img/profiles/".$user->photo;    
                $home  = [  
                    'user'=>$user,
                ];
                return $this -> returnDataa(
                    'data',$home,'تم تسجيل الدخول بنجاح'
                );                          // 
            }

        }catch (\Exception $ex){
            return $this->returnError( $ex->getMessage());
        }


    }
    public function register(Request $request)
    {
        // dd('iughi');
        $checkemail = Instructor::where("email" , $request->email)->first();
        if($checkemail){
            return $this -> returnError('البريد الإلكتروني موجود مسبقا');
        }else{
            $add = new Instructor();
            
            $add->photo  = "profile.png";
            
            $add->name  = $request->name; 
            $add->email  = $request->email;   
            $add->password  = bcrypt($request->password);  
            $add->gender  = $request->gender;
            $add-> save();
            $user = $add->toArray();
            $user['link'] = Str::random(32);
            DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);
            Mail::send('emails.activation', $user, function($message) use ($user){
                $message->to($user['email']);
                $message->subject('Courses - Activation Code');
            });
            return $this -> returnSuccessMessage('يرجى زيارة بريدك الإلكتروني لتفعيل الحساب');
        } 
        // return $this -> returnData('doctor' , $doctor);
        // return redirect()->back()->with("message",'تمت الإضافة بنجاح'); 
    }
    // public function getInstructorData(Request $request)
    // {
    //     // dd('vevreverv');
    //     $user = Auth::guard('instructors-api')->user();
    //     // dd($user);
    //     // $admin = Auth::guard('instructors-api') -> user();
    //     return $this->returnDataa('data', $user,'');
    // }
    public function allcourses()
    {
        $user = Auth::guard('instructors-api')->user();
        if(!$user)
            return $this->returnError('يجب تسجيل الدخول أولا');
        $courses=Course::all();
        foreach ($courses as $item) {  
            $item->image="https://kutuphanah.com/courses/assets_admin/img/courses/".$item->image;
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            $item->childcategory= ChildCategory::where('id',$item->childCategoryId)->first();
            
            $chapters= Chapter::where('courseId',$item->id)->get();
            $item->chapters= Chapter::where('courseId',$item->id)
                            ->with(array('videos'=>function($query){
                                $query;
                            }))->get(); 
            $lectures_count= Video::where('courseId',$item->id)->count();                
            $item->lectures_count=$lectures_count;          
            $joined_student = Courses_joined::where("courseId" , $item->id)->count();
            $item->joined_student=$joined_student;
        ////// isJoind    
            
            
             $isjoind= Courses_joined::where('userId',$user->id)->where('courseId',$item->id)->first();
             if($isjoind){
                $item->isjoind = 1;
             }else{
                $item->isjoind = 0;
             }
            
            // ///////////     
            $sum_review=Review::where('courseId',$item->id)->sum('rate');
            $allreview=Review::where('courseId',$item->id)->get();
            $count_review= count($allreview);
            
            if($count_review ==0){
                $item->rate= 0.0;    
            }else{
                $total_rate= $sum_review / $count_review;
                $item->rate=$total_rate;
                
            }
        }
        
        return $this->returnDataa('data', $courses,'');
    }
    public function allcoursesLive()
    {
         // $mytime = Carbon::now('Palestine');
        $mytime = Carbon::now('Israel');
        // dd($mytime->toDateTimeString());
        $dt=Carbon::now('Europe/London');
        dd($dt);
        // $todayDate = date("Y-m-d");
        // $time = new DateTime();
        // $time->modify('+3 hours');
        // $mytime=$time->format("H:i");
        // dd($mytime);
        $user = Auth::guard('instructors-api')->user();
        if(!$user)
            return $this->returnError('يجب تسجيل الدخول أولا');
        $courses=Live::all();
        foreach ($courses as $item) {            
            
            $item->image="https://kutuphanah.com/courses/assets_admin/img/livecourses/".$item->image;
            $item->instructor= Instructor::where('id',$item->userId)->first(); 
            $sessions= Session::where('liveId',$item->id)->get(); 
            foreach ($sessions as $sessions_item) {
                if($sessions_item->status==1){
                    $sessions_item->status=;
                }elseif(){

                }elseif(){

                }elseif(){

                }elseif(){

                }elseif(){

                }elseif(){

                }elseif(){

                }
            }
            $item->sessions= $sessions; 

            $sessions_count= Session::where('liveId',$item->id)->count();                
            $item->sessions_count=$sessions_count;  
            
            $joined_student = Courses_joined::where("liveId" , $item->id)->count();
            $item->joined_student=$joined_student;
            
            $isjoind= Courses_joined::where('userId',$user->id)->where('liveId',$item->id)->first();
            if($isjoind){
                $item->isjoind = 1;
            }else{
                $item->isjoind = 0;
            }
            
            // ///////////     
            $sum_review=Review::where('liveId',$item->id)->sum('rate');
            $allreview=Review::where('liveId',$item->id)->get();
            $count_review= count($allreview);
            
            if($count_review ==0){
                $item->rate= 0.0;    
            }else{
                $total_rate= $sum_review / $count_review;
                $item->rate=$total_rate;
                
            }
        }
        return $this->returnDataa('data', $courses,'');
    }
    
    
    public function change_password(Request $request)
    {

        $user = Auth::guard('instructors-api')->user();
         if(!$user)
            return $this->returnError('يجب تسجيل الدخول أولا');
        $input = $request->all();
        $userid = Instructor::where("id" , $user->id)->first();
        
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                
                if ((Hash::check(request('old_password'), $userid->password)) == false) {
                    if(isset($request->lang)  && $request -> lang == 'en' ){
                        $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                    } else {
                        $arr = array("status" => 400, "message" => "تحقق من كلمة السر القديمة.", "data" => array());
                    }     
                }else if ((Hash::check(request('new_password'), $request->password)) == true) {
                    if(isset($request->lang)  && $request -> lang == 'en' ){
                        $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                    } else {
                        $arr = array("status" => 400, "message" => "الرجاء إدخال كلمة مرور لا تشبه كلمة المرور الحالية.", "data" => array());
                    }   

                }else {                     
                     $userid->password  = bcrypt($input['new_password']);
                     $userid->save();
                    if(isset($request->lang)  && $request -> lang == 'en' ){
                        $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => $userid);
                    } else {
                        $arr = array("status" => 200, "message" => "تم تحديث كلمة السر بنجاح.", "data" => $userid);
                    }    
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return \Response::json($arr);
    }
    
    // public function forgetPassword(Request $request)
    // {
        
    //     $input = $request->all();
    //     $rules = array(
    //         'email' => "required|email",
    //     );

    //     $validator = Validator::make($input, $rules);
    //     if ($validator->fails()) {
    //         $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
    //     } else {
    //         try {
    //             $patients= Instructor::where('email',$request->email)->first();
    //             if($patients==null){
    //                 if(isset($request->lang)  && $request -> lang == 'en' ){
    //                      return $this -> returnError('001','Email not found ');
    //                 }else{
    //                     return $this -> returnError('001','البريد الإلكتروني غير موجود');
    //                 }
    //             }else{
                    
    //                 $gene = mt_rand(1000000000, 9999999999);
    //                 $patients->password = bcrypt($gene);
    //                 // str_rand(8)->make_bcrypt->unique;
    //                 $patients->save();
                    
    //                 $user = $patients->toArray();
    //                 $user['passwordgenerat'] =  $gene;
    //                 Mail::send('emails.forgot', $user, function($message) use ($user){
    //                     $message->to($user['email']);
    //                     $message->subject('Courses - New password');
    //                 });
                    
    //                 if(isset($request->lang)  && $request -> lang == 'en' ){
    //                      return $this -> returnSuccessMessage('Please visit your email ');
    //                 }else{
    //                     return $this -> returnSuccessMessage('يرجى زيارة بريدك الإلكتروني');
    //                 }
    //             }

    //         } catch (\Swift_TransportException $ex) {
    //             $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
    //         } catch (Exception $ex) {
    //             $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
    //         }
    //     }
    //     // return \Response::json('doneeeee');
    // }
    
    public function forgetPassword(Request $request)
    {
        
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                 $doctorss= Instructor::where('email',$request->email)->first();
                if($doctorss==null){
                    return $this -> returnError('البريد الإلكتروني غير موجود');
                }else{
                    $gene = mt_rand(1000000000, 9999999999);
                    $doctorss->password = bcrypt($gene);
                    $doctorss->save();
                    $details = [
                        'title' => 'Password of Courses',
                        'body' => 'Cope this password to enter Courses: ' ." " . $gene . " "
                    ];
                    Mail::to($request->email)->send(new \App\Mail\SendPassword($details));
                        return $this -> returnSuccessMessage('يرجى زيارة بريدك الإلكتروني');

                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        // return \Response::json('doneeeee');
    }
    
    
    // public function coursesDetails(Request $request)
    // {
    //     $details=Course::where('id',$request->courseId)->first();                   
        
    //     $chapters= Chapter::where('courseId',$details->id)->get();
    //     foreach ($chapters as $item) {      
    //         $item->videos= Video::where('chapterId',$item->id)->get();
    //     }    
    //     $recently_courses=Course::where('categoryId',$details->categoryId)->get();
    //     $home  = [  
    //                 'details'=>$details,
    //                 'chapters'=>$chapters,
    //                 'category'=>$category,
    //                 'subcategory'=>$subcategory,
    //                 'childcategory'=>$childcategory,
    //                 'user'=>$user,
    //                 'recently_courses'=>$recently_courses,             
    //             ];
    //     return $this -> returnData(
    //         'home',$home
    //     );
    // }

     public function Countries(Request $request)
    {
            $countries = Country::selection()->get(); 
            
            return $this->returnDataa('data', $countries,'iw7ryhfr');
    }


    public function Cities(Request $request)
    {
            $cities = City::selection()->where('countryId',$request->countryId)->get(); 
            
            return $this->returnDataa('cities', $cities,'wfiurw');
    }

    public function languages()
    {    
        $languages = Language::selection()->get();
        return $this -> returnDataa(
            'data',$languages,'igrfrwf'
        );
    }
    
    public function categotries()
    {    
        $categotries = Category::selection()->get();
        foreach ($categotries as $item) {
            $item->icon="https://findfamily.net/care/assets_admin/img/categories/".$item->icon;

            $item->subcategory= SubCategory::selection()->where('categoryId',$item->id)->get();  
        }    
        return $this -> returnDataa(
            'data',$categotries,'riuhfer'
        );
    }

    public function subcategory(Request $request)
    {
        $subcategory = SubCategory::selection()->where('categoryId',$request->categoryId)->get(); 
        foreach ($subcategory as $item) {
            $item->icon="https://findfamily.net/care/assets_admin/img/categories/".$item->icon;
        }
        return $this->returnData('data', $subcategory);
    }

    public function contactInfo()
    {    
        
        $contactinfo = ContactInfo::first();
        
        $contactinfo->logo="https://findfamily.net/care/assets_admin/img/settings/".$contactinfo->logo;
        $contactinfo->favicon="https://findfamily.net/care/assets_admin/img/settings/".$contactinfo->favicon;
        
        
        return $this -> returnDataa(
            'data',$contactinfo,'erifhr'
        );
    }
    
    

   
    
   
   

}
