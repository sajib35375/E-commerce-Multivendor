<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller
{
    public function categoryView(){
        $allCat = Category::all();
        return view('admin.category.category',compact('allCat'));
    }

    public function categoryStore(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'category_image' => 'required',
        ]);

        if($request->hasFile('category_image')){
            $image = $request->file('category_image');
            $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(120,120)->save('uploads/category/'.$unique_name);

        }


        Category::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_image' => $unique_name,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('message','Category Inserted Successfully');
    }


    public function categoryEdit($id){
        $edit = Category::find($id);
        return view('admin.category.category_edit',compact('edit'));
    }


    public function categoryUpdate(Request $request,$id){
        $update = Category::find($id);

        if($request->hasFile('category_image')){
            $image = $request->file('category_image');
            $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(120,120)->save('uploads/category/'.$unique_name);
            @unlink('uploads/category/'.$request->old_cat_img);

        }else{
           $unique_name =  $request->old_cat_img;
        }



        $update->name = $request->name;
        $update->category_image = $unique_name;
        $update->updated_at = Carbon::now();
        $update->update();

        return redirect()->route('category.view')->with('message','Category Updated Successfully');
    }


    public function categoryDelete($id){
        $deleteCat = Category::find($id);
        $deleteCat->delete();
        @unlink('uploads/category/'.$deleteCat->category_image);
        return redirect()->back()->with('warning','Category Deleted Successfully');
    }


    public function SubCategoryView(){
        $all_cat = Category::latest()->get();
        $sub_cat = SubCategory::with('category')->latest()->get();
        return view('admin.category.subcategory',compact('all_cat','sub_cat'));
    }


    public function SubCategoryStore(Request $request){
        $this->validate($request,[
            'category_id' => 'required',
            'sub_name' => 'required'
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'sub_name' => $request->sub_name,
            'slug' => Str::slug($request->sub_name),
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('message','SubCategory Added Successfully');
    }

    public function SubCategoryEdit($id){
        $edit = SubCategory::find($id);
        $all_cat = Category::latest()->get();

        return view('admin.category.sub_category_edit',compact('edit','all_cat'));
    }

    public function SubCategoryUpdate(Request $request,$id){
        $update = SubCategory::find($id);
        $update->category_id = $request->category_id;
        $update->sub_name = $request->sub_name;
        $update->updated_at = Carbon::now();
        $update->update();

        return redirect()->route('subcategory.view')->with('message','SubCategory Updated Successfully');
    }

    public function SubCategoryDelete($id){
        $delete = SubCategory::find($id);
        $delete->delete();

        return redirect()->back()->with('warning','SubCategory Deleted Successfully');
    }


}
