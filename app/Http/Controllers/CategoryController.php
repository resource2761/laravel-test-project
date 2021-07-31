<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// import 'category' model
use App\Models\category;
use Auth;
use Illuminate\Support\Carbon;

// import QueryBuilder
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    //

    // function AllCat() to read data and send to view
    public function AllCat()
    {
        // load view under admin/category/index
        // get all data from categories table with model
        //$categories=category::all();
        // $categories=category::latest()->get(); // Order By last entry
        // build Eloquent ORM  to read data with pagination
        $categories=category::latest()->paginate(5); // Order By last entry 

        // for softdelete or Temporarily Delete  of category data
        $trashCat=category::onlyTrashed()->latest()->paginate(3);

        // read data using query builder order by last entry
        //$categories=DB::table('categories')->latest()->get(); // Order By last entry 

        //read data using query builder and apply pagination
        //$categories=DB::table('categories')->latest()->paginate(3); // Order By last entry  and paginate

        // Query Builder to join both tables
        // $categories=DB::table('categories')->join('users','categories.user_id','users.id')
        // ->select('categories.*','users.name')->latest()->paginate(5);



        // return view with after get data into $categories with compact('categories')
        return view('admin.category.index',compact('categories','trashCat'));
    }

    // function AddCat
    public function AddCat(Request $req)
    {
        $validateData=$req->validate(
            //'form_field'=>'required|unique:table Name|max:255'
            [   
                'category_name'=>'required|unique:categories|max:255|min:5'
            ],
            [   
                'category_name.required'=>'Please Input Category Name',
                'category_name.max'=>'Category Name not to be Exceed 255 Characters',
                'category_name.min'=>'Category Name not to be Less Than 5 Characters'


            ]);

            // if category model is valid, the insert ORM using Model
            category::insert([
                //'table field name'->$req->form_object
                'category_name'=>$req->category_name,
                'user_id'=>Auth::user()->id,
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
            return Redirect()->back()->with('Success','Category Inserted Successfully');


    }


    public function Edit($id)
    {
        // Eloquent ORM find
        $categories=category::find($id); 

        // Query Builder to Edit Data
        //$categories=DB::table('categories')->where('id',$id)->first(); // get the first data
 
        // send data to view under: admin->category->category_edit.blade.php after find with categories array
        return view('admin.category.category_edit',compact('categories'));
    }


    public function Update(Request $req, $id)
    {
        // Eloquent ORM find and update the find data
        $update=category::find($id)->update(
            [
                'category_name'=>$req->category_name,
                'user_id'=>Auth::user()->id
            ]
        );

        // Query Builder Update
            // $data=array();
            //$data['table field name']=$req->'request data';
            // $data['category_name']=$req->category_name;
            // $data['user_id']=Auth::user()->id;
            // DB::table('categories')->where('id',$id)->update($data); 

        // return to the route name page with session('Success')
        return Redirect()->route('all.category')->with('Success','Category Updated Successfully');



    }

    // Soft Delete or Temporary Delete
    public function TempDelete($id)
    {
        // Eloquent ORM find
        $tempDelete=category::find($id)->delete(); 
        return Redirect()->route('all.category')->with('Success','Category Temporary Deleted Successfully');


    }

    // Restore From Soft Delete or Restore from Trash
    public function TempDelete_Restore($id)
    {
        $RestoreFromTrash=category::withTrashed()->find($id)->restore();
        return Redirect()->route('all.category')->with('Success','Category Restored Successfully');
        
    }


        // Confirm Delete from Trash List
        public function Category_Confirm_Delete($id)
        {
            $Delete_From_Trash=category::onlyTrashed()->find($id)->forceDelete();
            return Redirect()->route('all.category')->with('Success','Category from Trashed Deleted Successfully');
            
        }

}
