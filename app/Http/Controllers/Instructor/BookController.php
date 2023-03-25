<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;

use App\Story;
use App\Category;

use App\SubCategory;
use App\Country;
use App\City;
use App\ChildCategory;

use Illuminate\Http\Request;
use App\Jobs\SendFileJob;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use DB;
use Auth;
class BookController extends Controller
{
    
    public function index(Request $request)
    {
        // $user = Auth::guard('students')->user();
        // dd(Auth::guard('instructors')->user()->name);
        $userid = Auth::guard('instructors')->user();
        $categories=Category::all();
        if(isset($request->searchname)){
            $books=Story::where('name', $request->searchname)->paginate(8);
        }else{
            $books=Story::where('userId',$userid->id)->paginate(8);
        }
        $countries=Country::all();
        
        return view('instructor.books.books',compact('books','categories','countries'));
    }

    
    public function getSubCategory($id){
        echo json_encode(DB::table('sub_categories')->where('categoryId', $id)->get());
    }

    public function getChildCategory($id){
        echo json_encode(DB::table('child_categories')->where('subCategoryId', $id)->get());
    }

    public function create()
    {
        $categories=Category::all();
        $books=Story::all();
        $countries=Country::all();
        return view('instructor.books.create',compact('books','categories','countries'));
    }

    public function store(Request $request)
    {
        $this->validate( $request,[          
                'categoryId'=>'required',
                // 'subCategoryId'=>'required',
                'countryId'=>'required',
                'name'=>'required',
                'price'=>'required|numeric|min:2|max:9',
                // 'date'=>'required',
                'pages'=>'required',
                'licensing_authority'=>'required',
                'isbn_num'=>'required',
                'license_number'=>'required|numeric',
                'license_year'=>'required',
                'description'=>'required',
                'meta_key'=>'required',
                // 'photo' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                // 'pfile'=>"required|mimetypes:application/pdf|max:10000" 
                //required|mimes:pdf|max:10000

            ],
            [
                'categoryId.required'=>'التصنيف مطلوب',
                // 'subCategoryId'=>'required',
                'countryId.required'=>'يرجى اختيار الدوله ',
                'name.required'=>'ادخل عنوان الكتاب',
                'price.required'=>'ادخل سعر الكتاب',
                'price.max'=>'سعر الكتاب يجب أن لا يزيد عن 9',
                'price.min'=>'سعر الكتاب يجب ان لايقل عن 2',
                // 'date.required'=>'ادخل تاريخ اصدار الكتاب',
                'pages.required'=>'ادخل عدد الصفحات الكتاب',
                'licensing_authority.required'=>'ادخل جهة ترخيص الكتاب',
                'isbn_num.required'=>'ادخل رقم الكتاب',
                'license_number.required'=>'ادخل رقم ترخيص الكتاب',
                'license_year.required'=>'سنة ترخيص الكتاب',
                'description.required'=>'ادخل وصف الكتاب',
                'meta_key.required'=>'ادخل الكلامات الدلالية',
                // 'photo.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
                // 'pfile.required'=>' يرجي إختيار كتاب pdf '

            ]
        );

        $add= new Story;
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/books';
            $request-> file('photo') ->move($path,$file_name);
            $add->photo  = $file_nameone;
        }else{
            $add->photo  = "image-book.jpg";
        }

        if($file=$request->file('file'))
        {
            $file_extension = $request -> file('file') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/files';
            $request-> file('file') ->move($path,$file_name);
            $add->file  = $file_nameone;
        }else{
            $add->file  = "books1.pdf"; 
        }
        
        $instructorId = Auth::guard('instructors')->user()->id;   
        // dd($userid);
        $add->userId  = $instructorId;
        $add->categoryId  = $request->categoryId;
        // $add->subCategoryId  = $request->subCategoryId;
        // $add->languageId  = $request->languageId;
        $add->countryId  = $request->countryId;
        $add->name  = $request->name;
        $add->price   = $request->price;
        // $add->date  = $request->date;
        $add->pages  = $request->pages;
        $add->licensing_authority  = $request->licensing_authority;
        $add->isbn_num  = $request->isbn_num;
        $add->license_number  = $request->license_number;
        $add->license_year  = $request->license_year;
        $add->description  = $request->description;
        $add->meta_key  = $request->meta_key;
        
        $add->slug =Str::slug($request->name, '-', Null);
         // SlugService::createSlug(Book::class, 'slug', $this->make_slug($request->name));


        $add->save();
        toastr()->success(trans('messages.success'));
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
    public function edit(Story $story)
    {
        $categories=Category::all();
        $subcategory=SubCategory::all();
        $country=Country::all();
        $city=City::all();

        // dd($book);

        return view('instructor.books.edit',compact('story','categories','subcategory','country','city'));
    }

    public function update(Request $request,Story $story)
    {
        // dd($request->file('file'));
        // $userId = 1;
        $this->validate( $request,[          
        //         'categoryId'=>'required',
        //         'subCategoryId'=>'required',
        //         'countryId'=>'required',
        //         'name'=>'required',
        
                'price'=>'required|numeric|min:2|max:9',
        //         'date'=>'required',
        //         'pages'=>'required',
        //         'licensing_authority'=>'required',
        //         'isbn_num'=>'required',
        //         'license_number'=>'required',
        //         'License_year'=>'required',
        //         'description'=>'required',
        //         'meta_key'=>'required',
        //         // 'photo' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        //         // 'file' => 'mimes:jpeg,jpg,png,gif|required|max:10000'

            ],
            [
        //         'categoryId'=>'required',
        //         'subCategoryId'=>'required',
        //         'countryId'=>'required',
        //         'name'=>'required',
                'price.required'=>'ادخل سعر الكتاب',
                'price.max'=>'سعر الكتاب يجب أن لا يزيد عن 9',
                'price.min'=>'سعر الكتاب يجب ان لايقل عن 2',
        //         'date'=>'required',
        //         'pages'=>'required',
        //         'licensing_authority'=>'required',
        //         'isbn_num'=>'required',
        //         'license_number'=>'required',
        //         'License_year'=>'required',
        //         'description'=>'required',
        //         'meta_key'=>'required',
        //         // 'photo.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
        //         // 'file.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',

            ]
        );

        $edit = Story::findOrFail($story->id);
        
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/books';
            $request-> file('photo') ->move($path,$file_name);
            $edit->photo  = $file_nameone;
        }else{
            $edit->photo  = $edit->photo;
        }

        if($file=$request->file('file'))
        {
            $file_extension = $request -> file('file') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/files';
            $request-> file('file') ->move($path,$file_name);
            $edit->file  = $file_nameone;
        }else{
            $edit->file  = $edit->file ; 
        }
       
        
        $edit->categoryId  = $request->categoryId;
        // $edit->subCategoryId  = $request->subCategoryId;
        // $add->languageId  = $request->languageId;
        $edit->countryId  = $request->countryId;
        $edit->name  = $request->name;
        $edit->price   = $request->price;
        // $edit->date  = $request->date;
        $edit->pages  = $request->pages;
        $edit->licensing_authority  = $request->licensing_authority;
        $edit->isbn_num  = $request->isbn_num;
        $edit->license_number  = $request->license_number;
        $edit->license_year  = $request->license_year;
        $edit->description  = $request->description;
        $edit->meta_key  = $request->meta_key;
        
        $edit->slug =Str::slug($request->name, '-', Null);
         // SlugService::createSlug(Book::class, 'slug', $this->make_slug($request->name));


        $edit->save();
        toastr()->success(trans('messages.success'));
        return redirect()->back()->with("message", 'تم تعديل بنجاح'); 


         
    }

    
    public function destroy(Request $request)
    {
        $delete = Story::findOrFail($request->id);
        $delete->delete();
            return redirect('instructor/stories')->with("message",'تم الحذف بنجاح'); 
    }
}
