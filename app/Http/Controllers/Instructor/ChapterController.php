<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\Course;
use App\Category;
use App\SubCategory;
use App\Chapter;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware(Auth::guard('instructors')->user());
        
    }
    public function index()
    {
        $chapters=Chapter::all();
        foreach ($chapters as $item) {
            $item->course= Course::where('id',$item->courseId)->first();
        }
        return view('instructor.courses.chapters.all',compact('chapters'));
    }

    public function create()
    {
        $courses=Course::all();    
        return view('instructor.courses.chapters.create',compact('courses'));
    }
    
    public function store(Request $request)
    {
        $this->validate( $request,[          
                'courseId'=>'required',
                'chapter_name'=>'required',
                'short_number'=>'required',
            ],
            [
                'courseId.required'=>'يرجي اختيار التخصص',
                'chapter_name.required'=>' التخصص الفرعي مطلوب ',
                'short_number.required'=>' التخصص الفرعي مطلوي  ',
            ]
        );
        $userid = Auth::guard('instructors')->user();
        
        $add = new Chapter;
        $add->courseId    = $request->courseId;
        $add->chapter_name    = $request->chapter_name;
        $add->short_number    = $request->short_number;
        
        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
   

    public function edit(Chapter $chapter)
    {
        $courses=Course::all();
        
        return view('instructor.courses.chapters.edit',compact('chapter','courses'));
    }

    public function update(Request $request, Chapter $chapter)

    {
        $this->validate( $request,[          
                 'courseId'=>'required',
                'chapter_name'=>'required',
                'short_number'=>'required',
            ],
            [
                'courseId.required'=>'يرجي اختيار التخصص',
                'chapter_name.required'=>' التخصص الفرعي مطلوب ',
                'short_number.required'=>' التخصص الفرعي مطلوي  ',
            ]
        );
        
        $edit = Chapter::findOrFail($chapter->id);
       
        $edit->courseId    = $request->courseId;
        $edit->chapter_name    = $request->chapter_name;
        $edit->short_number    = $request->short_number;
        $edit->save();


        
         
        return redirect()->route('chapters.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        // $appointment=Doctor::where('specialityId',$request->id)->get(); 
        // if(count($appointment) == 0){
            $delete = Chapter::findOrFail($request->id);
            $delete->delete();
            return redirect()->route('chapters.index')->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }        
    } 
}