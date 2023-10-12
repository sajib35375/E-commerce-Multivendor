<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    public function sliderView(){
        $all_slider = Slider::latest()->get();
        return view('admin.slider.slider',compact('all_slider'));
    }

    public function sliderStore(Request $request){
        $this->validate($request,[
            'slider_image' => 'required'
        ]);

        if ($request->hasFile('slider_image')){
            $slider = $request->file('slider_image');
            $unique_name = hexdec(uniqid()).'.'.$slider->getClientOriginalExtension();
            Image::make($slider)->resize(1570,530)->save('uploads/slider/'.$unique_name);
        }

        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $unique_name,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('message','Slider Added Successfully');
    }

    public function sliderEdit($id){
        $edit_data = Slider::find($id);
        return view('admin.slider.slider_edit',compact('edit_data'));
    }

    public function sliderUpdate(Request $request,$id){
        $update_data = Slider::find($id);
        if ($request->hasFile('slider_image')){
            $image = $request->file('slider_image');
            $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1570,530)->save('uploads/slider/'.$unique_name);
            @unlink('uploads/slider/'.$request->old_image);
        }else{
            $unique_name = $request->old_image;
        }

        $update_data->slider_title = $request->slider_title;
        $update_data->short_title = $request->short_title;
        $update_data->slider_image = $unique_name;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('slider.view')->with('message','Slider Updated Successfully');
    }

    public function sliderDelete($id){
        $delete_data = Slider::find($id);
        $delete_data->delete();
        @unlink('uploads/slider/'.$delete_data->slider_image);
        return redirect()->back()->with('warning','Slider Deleted Successfully');
    }
}
