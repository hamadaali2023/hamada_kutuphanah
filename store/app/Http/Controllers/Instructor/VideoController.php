<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\Video;
use App\Course;
use App\Category;
use App\SubCategory;
use App\Chapter;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class VideoController extends Controller
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
        $videos=Video::all();
        foreach ($videos as $item) {
            $item->course= Course::where('id',$item->courseId)->first();
            $item->chapter= Chapter::where('id',$item->chapterId)->first();
        }
        return view('instructor.courses.videos.all',compact('videos'));
    }

    public function allvideoss($id)
    {
        // dd('wefrwf');
        $videos = Video::where('courseId',$id)->get();
        foreach ($videos as $item) {
            $item->course= Course::where('id',$item->courseId)->first();
        }
        return view('instructor.courses.videos.all',compact('videos'));
    }

    public function addvideos($id)
    {
        $courses = Course::where('id',$id)->first();     
        return view('instructor.courses.videos.create',compact('courses'));
    }

    // public function create()
    // {
    //     $chapter=Chapter::all();  
    //     $courses=Course::all();      
    //     return view('instructor.courses.videos.create',compact('chapter','courses'));
    // }
    
    public function store(Request $request)
    {
        $this->validate( $request,[          
                'courseId'=>'required',
                // 'chapterId'=>'required',
                'name'=>'required',
                // 'url' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'courseId.required'=>'يرجي اختيار التخصص',
                // 'chapterId.required'=>' التخصص الفرعي مطلوب ',
                'name.required'=>' التخصص الفرعي مطلوي  ',              
                // 'url.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        $file_extension = $request -> file('url') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/courses/videos';
        $request-> file('url') ->move($path,$file_name);
        
         
        $add = new Video;
        $add->courseId    = $request->courseId;
        // $add->chapterId    = $request->chapterId;
        $add->name    = $request->name;
        $add->url    = $file_nameone;
        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    public function edit(Video $video)
    {
        $chapter=Chapter::all();  
        $courses=Course::all();  
        return view('instructor.courses.videos.edit',compact('video','courses','chapter'));
    }

    public function update(Request $request, Video $video)

    {
        // dd($request->name);
        $this->validate( $request,[          
                'courseId'=>'required',
                // 'chapterId'=>'required',
                'name'=>'required',
            ],
            [
                'courseId.required'=>'يرجي اختيار التخصص',
                // 'chapterId.required'=>' التخصص الفرعي مطلوب ',
                'name.required'=>' التخصص الفرعي مطلوي  ',
                
            ]
        );$edit = Video::findOrFail($video->id);
        if($file=$request->file('url'))
        {
            $file_extension = $request -> file('url') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/courses/videos';
            $request-> file('url') ->move($path,$file_name);
            $edit->url  = $file_nameone;
        }else{
            $edit->url  =$edit->url;
        }

        $edit->courseId    = $request->courseId;
        // $edit->chapterId    = $request->chapterId;
        $edit->name    = $request->name;
        
        $edit->save();
        return redirect()->route('courses.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        // $appointment=Doctor::where('specialityId',$request->id)->get(); 
        // if(count($appointment) == 0){
            $delete = Video::findOrFail($request->id);
            $delete->delete();
            return back()->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }        
    } 
}
