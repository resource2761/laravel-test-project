<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import 'category' model
use App\Models\category;

//import 'brand' model
use App\Models\brand;


//import 'multipic' model
use App\Models\multipic;


use Illuminate\Support\Carbon;

// import QueryBuilder
use Illuminate\Support\Facades\DB;

//use image intervention
use Image;

class BrandController extends Controller
{
    //

    public function AllBrand()
    {
        $brands=brand::latest()->paginate(5); // Order By last entry 
         return view('admin.brand.index',compact('brands'));
    }


    // function AddBrand
    public function AddBrand(Request $req)
    {
        $validateData=$req->validate(
            //'form_field'=>'required|unique:table Name|max:255'
            [   
                'brand_name'=>'required|unique:brands|max:255|min:5',
                'brand_image'=>'required|mimes:jpg,jpeg,png',

            ],
            [   
                'brand_name.required'=>'Please Insert Brand Name',
                'brand_name.max'=>'Brand Name not to be Exceed 255 Characters',
                'brand_name.min'=>'Brand Name not to be Less Than 5 Characters'


            ]);

            // get the brand image
            $brand_image=$req->file('brand_image');

            // image intervention
            $name_gen=hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(300, 200)->save('image/brand/'.$name_gen);
            $upload_location='image/brand/';
            $final_image=$upload_location.$name_gen;


            // generate a hexadecimal code
            //$name_gen=hexdec(uniqid()); 

            // get the image extension
            //$img_ext=strtolower($brand_image->getClientOriginalExtension());

            // generate the image name with extension
            //$img_name=$name_gen.'.'.$img_ext;

            // set the upload location
            //$upload_location='image/brand/';

            // set the image Location
            //$final_image=$upload_location.$img_name;

            // Finally, Upload the image
            //$brand_image->move($upload_location,$img_name);


            // if brand model is valid, the insert ORM using Model
            brand::insert([
                //'table field name'->$req->form_object
                'brand_name'=>$req->brand_name,
                'brand_image'=>$final_image,
                'created_at'=>Carbon::now() // Current date and time
            ]);

            // Anothe way to insert Data using Eloquent Model
            // $category = new category;
            // $category->category_name=$req->category_name;
            // $category->user_id=Auth::user()->id;
            // $category->save();


            // insert data using queryBuilder
            // $data=array();
            //$data['table field name']=$req->'request data';
            // $data['category_name']=$req->category_name;
            // $data['user_id']=Auth::user()->id;
            // DB::table('categories')->insert($data);    

            // return to the back page with session('Success')
            return Redirect()->back()->with('Success','Brand Inserted Successfully');


    }


    public function Edit($id)
    {
        // Eloquent ORM find
        $brands=brand::find($id); 

        // Query Builder to Edit Data
        //$categories=DB::table('categories')->where('id',$id)->first(); // get the first data
 
        // send data to view under: admin->category->category_edit.blade.php after find with categories array
        return view('admin.brand.brand_edit',compact('brands'));
    }



    public function Update(Request $req, $id)
    {

        $validateData=$req->validate(
            //'form_field'=>'required|unique:table Name|max:255'
            [   
                'brand_name'=>'required|max:255|min:5',
                'brand_image'=>'required|mimes:jpg,jpeg,png',

            ],
            [   
                'brand_name.required'=>'Please Insert Brand Name',
                'brand_name.max'=>'Brand Name not to be Exceed 255 Characters',
                'brand_name.min'=>'Brand Name not to be Less Than 5 Characters'


            ]);

            $old_image=$req->old_image; // hidden field in form occupies old_image before edit

            // get the brand image
            $brand_image=$req->file('brand_image');
            // generate a hexadecimal code
            $name_gen=hexdec(uniqid()); 

            // get the image extension
            $img_ext=strtolower($brand_image->getClientOriginalExtension());

            // generate the image name with extension
            $img_name=$name_gen.'.'.$img_ext;

            // set the upload location
            $upload_location='image/brand/';

            // set the image Location
            $final_image=$upload_location.$img_name;

            // Finally, Upload the image
            $brand_image->move($upload_location,$img_name);

            // delete the old_image
            unlink($old_image);

        // Eloquent ORM find and update the find data
        $update=brand::find($id)->update(
            [
                'brand_name'=>$req->brand_name,
                'brand_image'=>$final_image,
                'created_at'=>Carbon::now() // Current date and time
            ]
        );

        // Query Builder Update
            // $data=array();
            //$data['table field name']=$req->'request data';
            // $data['category_name']=$req->category_name;
            // $data['user_id']=Auth::user()->id;
            // DB::table('categories')->where('id',$id)->update($data); 

        // return to the route name page with session('Success')
        return Redirect()->route('all.brand')->with('Success','Brand Updated Successfully');



    }


    // Brand Delete  according Id
    public function Brand_Confirm_Delete($id)
    {

        $image=brand::find($id)->brand_image;
        unlink($image);
        $Delete=brand::find($id)->delete();
        return Redirect()->route('all.brand')->with('Success','Brand Deleted Successfully');
        
    }


    // this section for show Multiple images 

    public function Multipic()
    {

        $multipic=multipic::latest()->paginate(5); // Order By last entry         
        return view('admin.multipic.index',compact('multipic'));

    }

    // this section for add Multiple images 
    
    public function AddMultipleImage(Request $req)
    {

         // get the multople image from form array
         $image=$req->file('image');
        
         foreach($image as $multi)
         { // foreach to read image array

            // image intervention
            $name_gen=hexdec(uniqid()).'.'.$multi->getClientOriginalExtension();
            Image::make($multi)->resize(300, 200)->save('image/multi/'.$name_gen);
            $upload_location='image/multi/';
            $final_image=$upload_location.$name_gen;
            

            // if multipic model is valid, the insert ORM using Model
            multipic::insert([
                //'table field name'->$req->form_object
            
                'image'=>$final_image,
                'created_at'=>Carbon::now() // Current date and time
            ]);

        } // end of foreach
         // return to the back page with session('Success')
         return Redirect()->back()->with('Success','Multiple Inserted Successfully');

    }


}
