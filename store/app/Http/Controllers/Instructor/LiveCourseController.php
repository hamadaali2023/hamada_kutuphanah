<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\Course;
use App\Category;
use App\SubCategory;
use App\ChildCategory;
// use App\Live;
use App\Straight;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Courses_joined;
use App\Lecture;
class LiveCourseController extends Controller
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
        $categories=Category::all();
        $courses=Straight::all();
        return view('instructor.livecourses.all',compact('courses','categories'));
    }

    public function create()
    {
        $categories=Category::all();    
        return view('instructor.livecourses.create',compact('categories'));
    }
    

    
    public function store(Request $request)
    { 
            
        // dd($request->all());
        $this->validate( $request,[          
                'title'=>'required',
                'short_detail'=>'required',
                'detail'=>'required',
                
                'date'=>'required',

                'endDate'=>'required',
                
                'duration'=>'required',
                // 'payed'=>'required',
                // 'price'=>'required',
                // 'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'title.required'=>' العنوان مطلوب ',   
                'short_detail.required'=>' يرجى كتابة وصف قصير ',
                'detail.required'=>' يرجي كتابة تفاصيل الكورس',
                
                'date.required'=>'ادخل تاريخ بداية الكورس',

                'endDate.required'=>'ادخل تاريخ نهاية الكورس',
                'duration.required'=>' مدة الكورس مطلوبة ',
                // 'payed.required'=>' حدد الكورس مدفوع ام مجاني ',
               // 'price.required'=>' سعر الكورس مطلوب ',
                // 'image.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );
        $userid = Auth::guard('instructors')->user();
        $file_extension = $request -> file('image') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/livecourses';
        $request-> file('image') ->move($path,$file_name);

        $add = new Straight;
        
        $add->userId    = $userid->id;
        $add->title    = $request->title;
        $add->short_detail    = $request->short_detail;
        $add->detail    = $request->detail;
        
        $add->date    = $request->date;
        $add->endDate    = $request->endDate;
        $add->duration    = $request->duration;
        $add->slug =Str::slug($request->title, '-', Null);
        $add->payed    = $request->payed;
        $add->price    = $request->price;
        $add->image    = $file_name;
        $add->save();


        // dd('count');
        $length = count($request->sessiontitle);
        if($length > 0)
        {
            // dd('length');
            for($i=0; $i<$length; $i++)
            {
                // dd('dddddd');
                $add_lecture = new Lecture;
                $add_lecture->liveId    = $add->id;
                $add_lecture->title    = $request->sessiontitle[$i];
                $add_lecture->date    = $request->sessiondate[$i];
                $add_lecture->time    = $request->time[$i];
                $add_lecture->duration    = $request->sessionduration[$i];
                $add_lecture->url    = $request->url[$i];
                $add_lecture->meeting_password    = $request->meeting_password[$i];
                $add_lecture->meeting_id    = $request->meeting_id[$i];
                $add_lecture->save();
            }
             
        }
        // dd('re');
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
   
    public function edit(Straight $straight)
    {
        // dd($straight->id);
        // dd($straight);
        // $dd=Course::where('id',$course->id)->first();
        // dd($course);
        $categories=Category::all();
        $subcategory=SubCategory::all();
        $childcategory=ChildCategory::all();
        return view('instructor.livecourses.edit',compact('straight','categories','subcategory','childcategory'));
    }

    public function update(Request $request, Straight $straight)

    {
        // $this->validate( $request,[          
        //         'title'=>'required',
        //         'short_detail'=>'required',
        //         'detail'=>'required',
        //         'price'=>'required',
        //         'date'=>'required',
        //         'time'=>'required',
        //         'duration'=>'required',
        //         'payed'=>'required',
        //         'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        //     ],
        //     [
        //         'title.required'=>' العنوان مطلوب ',   
        //         'short_detail.required'=>' يرجى كتابة وصف قصير ',
        //         'detail.required'=>' يرجي كتابة تفاصيل الكورس',
        //         'price.required'=>' سعر الكورس مطلوب ',
        //         'date.required'=>' المستوى مطلوب ',
        //         'time.required'=>' يرجى كتابة متطلبات الكورس ',
        //         'duration.required'=>' مدة الكورس مطلوبة ',
        //         'payed.required'=>' ادخل بعض الكلامات الدلالية ',
        //         'image.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
        //     ]
        // );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        // dd($course->id);
        $edit = Straight::findOrFail($straight->id);
        if($file=$request->file('image'))
        {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/livecourses';
            $request-> file('image') ->move($path,$file_name);
            $edit->image  = $file_nameone;
        }else{
            $edit->image  = $edit->image;
        }
        $edit->title    = $request->title;
        $edit->short_detail    = $request->short_detail;
        $edit->detail    = $request->detail;
        $edit->date    = $request->date;
        $edit->endDate    = $request->endDate;
        $edit->duration    = $request->duration;
        $edit->slug =Str::slug($request->title, '-', Null);
        $edit->payed    = $request->payed;
        $edit->price    = $request->price;
        $edit->save();


        
         
        return redirect()->route('straights.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        // $appointment=Doctor::where('specialityId',$request->id)->get(); 
        // if(count($appointment) == 0){
            $delete = Straight::findOrFail($request->id);
            $delete->delete();
            return redirect()->route('straights.index')->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }    
        
        $delete = Straight::findOrFail($request->id);
        if($delete){
            $courses_joined= Courses_joined::where('liveId',$delete->id)->get();
            foreach ($courses_joined as $item) {         
                $delete_course = Courses_joined::findOrFail($item->id);
                $delete_course->delete();
            }
            $sessionss= Session::where('liveId',$delete->id)->get();
            foreach ($sessionss as $item) {         
                $delete_course = Courses_joined::findOrFail($item->id);
                $delete_course->delete();
            }
        }
        $delete->delete();
        return redirect()->route('straights.index')->with("message",'تم الحذف بنجاح'); 
    } 
}