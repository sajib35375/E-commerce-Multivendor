<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class BannerController extends Controller
{
    public function bannerView(){
        $banners = Banner::latest()->get();
        return view('admin.banner.banner',compact('banners'));
    }

    public function bannerStore(Request $request){
        $this->validate($request,[
            'banner_title' => 'required',
            'banner_url' => 'required',
            'banner_image' => 'required',
        ]);

        if ($request->hasFile('banner_image')){
            $banner = $request->file('banner_image');
            $unique_name = hexdec(uniqid()).'.'.$banner->getClientOriginalExtension();
            Image::make($banner)->resize(768,450)->save('uploads/banner/'.$unique_name);
        }

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $unique_name,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('message','Banner Added Successfully');
    }

    public function bannerCount($id){
       $banner_click = Banner::find($id);
       $banner_click->clicks = $banner_click->clicks +1;
        $banner_click->update();

       return redirect($banner_click->banner_url);
    }

    public function bannerEdit($id){
        $edit_data = Banner::find($id);
        return view('admin.banner.banner_edit',compact('edit_data'));
    }

    public function bannerUpdate(Request $request,$id){
        $update_data = Banner::find($id);

        if ($request->hasFile('banner_image')){
            $banner = $request->file('banner_image');
            $unique_name = hexdec(uniqid()).'.'.$banner->getClientOriginalExtension();
            Image::make($banner)->resize(768,450)->save('uploads/banner/'.$unique_name);
            @unlink('uploads/banner/'.$request->old_image);
        }else{
            $unique_name = $request->old_image;
        }

        $update_data->banner_title = $request->banner_title;
        $update_data->banner_url = $request->banner_url;
        $update_data->banner_image = $unique_name;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('banner.view')->with('message','Banner Updated Successfully');
    }


    public function bannerDelete($id){
        $delete_data = Banner::find($id);
        $delete_data->delete();
        @unlink('uploads/banner/'.$delete_data->banner_image);

        return redirect()->route('banner.view')->with('warning','Banner Deleted Successfully');

    }









}
