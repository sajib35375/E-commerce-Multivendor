<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class BrandController extends Controller
{
    public function brandView(){
        $allBrand = Brand::latest()->get();
        return view('admin.brand.all_brand',compact('allBrand'));
    }

    public function brandAdd(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'photo' => 'required'
        ]);

        if ($request->hasFile('photo')){
            $photo = $request->file('photo');
            $unique_name = hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(120,120)->save('AdminBackend/upload/admin/brand/'.$unique_name);
        }

        Brand::insert([
            'name' => $request->name,
            'photo' => $unique_name,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('message','Brand Added Successfully');

    }


    public function brandEdit($id){
        $edit = Brand::find($id);
        return view('admin.brand.edit_brand',compact('edit'));
    }


    public function brandUpdate(Request $request,$id){
        $update_data = Brand::find($id);

        if ($request->hasFile('photo')){
            $photo = $request->file('photo');
            $unique_name = hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(120,120)->save('AdminBackend/upload/admin/brand/'.$unique_name);
            @unlink('AdminBackend/upload/admin/brand/'.$request->old_photo);
        }else{
            $unique_name = $request->old_photo;
        }

        $update_data->name = $request->name;
        $update_data->photo = $unique_name;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('brand.view')->with('message','Brand Updated Successfully');
    }



    public function brandDelete($id){
       $delete_data = Brand::find($id);
       $delete_data->delete();
        @unlink('AdminBackend/upload/admin/brand/'.$delete_data->photo);

       return redirect()->back()->with('warning','Brand Deleted Successfully');
    }











}
