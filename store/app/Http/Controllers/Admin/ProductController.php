<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Gate;
use App\Product;
use App\Image;		
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('admin.products.all',compact('products','categories'));
    }
    
    public function store(Request $request)
    {
        
        $add = new Product;
        $add->categoryId    = $request->categoryId;
        $add->title    = $request->title;
        $add->description  = $request->description;
        
       
        $add->price    = $request->price;
        $add->slug    = $request->title;
        $add->save();

        // $file_extension = $request -> file('url') -> getClientOriginalExtension();
        // $file_name = time().'.'.$file_extension;
        // $file_nameone = $file_name;
        // $path = 'assets_admin/products';
        // $request-> file('url') ->move($path,$file_name);

        // $add_image = new Image;
        // $add_image->productId    =  $add->productId;
        // $add_image->title    =  $request->title;
        // $add_image->url    = $file_nameone;
        
        // $add_image->save();
        // if($request->url)
        // {
        //     $data=$request->url;
        //     foreach($data as $_file)
        //     {   
        //         $file_extension = $_file['url'] -> getClientOriginalExtension();
        //         $file_name = time().'.'.$file_extension;
        //         $file_nameone = $file_name;
        //         $path = 'assets_admin/products';
        //         $request-> file('url') ->move($path,$file_name);
                
        //         $add_image = new Image;
		      //   $add_image->productId    =  $add->productId;
		      //   $add_image->title    =  $request->title;
		      //   $add_image->url    = $file_nameone;
		      //   $add_image->save();
        //     }
        // }
        

       // if($request->url)
       //  {
            
       //      foreach($request->file('url') as $file)
       //      {
       //          $file_extension = $file -> getClientOriginalExtension();
       //          $file_name = time().rand(1,100).'.'.$file_extension;
       //          $file->move('assets_admin/products/', $file_name);   
       //          $data[] = $file_name;  
       //      }
       //      $length_file = count($data);
       //      if($length_file > 0)
       //      {
       //          for($i=0; $i<$length_file; $i++)
       //          {
       //              $add_image= new Image;
       //              // $add_image->productId    =  $add->productId;
       //              $add_image->url  = $data[$i];             
       //              // $add_image->title    =  $request->title[$i];       
       //              $add_image->save();
       //          }
       //      }
       //  }





    //     $image = array();
	  	// if($file = $request->file('imagee')){
	   //    foreach($file as $file){
	   //        $image_name = md5(rand(1000,10000));
	   //        $ext = strtolower($file->getClientOriginalExtension());
	   //        $image_full_name = $image_name.'.'.$ext;
	   //        $uploade_path = 'assets_admin/products/';
	   //        $image_url = $uploade_path.$image_full_name;
	   //        $file->move($uploade_path,$image_full_name);
	   //        $image[] = $image_url;
	   //    }
    
	  	// }

	  	
        if($request->hasfile('imagee'))
         {
            foreach($request->file('imagee') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/assets_admin/products/', $name);  
                $data[] = $name;  
            }
         }


         $add_image= new Image();
         $add_image->productId    =  $add->productId;
         $add_image->url=json_encode($data);
         $add_image->save();

        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
    public function edit(Product $subcategory)
    {
        $categories=Category::all();
        return view('admin.subcategories.edit',compact('subcategory','categories'));
    }

    public function update(Request $request)
    {
        $edit = Product::findOrFail($request->id);
        $edit->title  = $request->title;
        $edit->description   = $request->description;
        $edit->price    = $request->price;
        
         
       

        // if($file=$request->file('image'))
        // {
        //     $img_extension = $request -> file('image') -> getClientOriginalExtension();
        //     $img_name = time().'.'.$img_extension;
        //     $img_path = 'assets_admin/img/subcategory';
        //     $request-> file('image') ->move($img_path,$img_name);
        //     $edit->image  =$img_name;
        // }else{
        //     $edit->image  = $edit->image; 
        // }
        $edit->save();
        return back()->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        
            $delete = Product::findOrFail($request->id);
            $delete->delete();
            return redirect()->route('subcategories.index')->with("message",'تم الحذف بنجاح'); 
              
    } 
}
