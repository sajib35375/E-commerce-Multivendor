<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class SettingController extends Controller
{
    public function siteSetting(){
        $data = SiteSetting::find(1);
        return view('admin.setting.setting',compact('data'));
    }

    public function siteSettingStore(Request $request){
        $update = SiteSetting::find(1);

        if ($request->hasFile('logo')){
            $logo = $request->file('logo');
            $unique_name = hexdec(uniqid()).'.'.$logo->getClientOriginalExtension();
            Image::make($logo)->resize(515,366)->save('uploads/logo/'.$unique_name);
            unlink('uploads/logo/'.$request->old_logo);
        }else{
            $unique_name = $request->old_logo;
        }

        $update->logo = $unique_name;
        $update->address = $request->address;
        $update->cell = $request->cell;
        $update->email = $request->email;
        $update->hours = $request->hours;
        $update->support_center = $request->support_center;
        $update->facebook = $request->facebook;
        $update->twitter = $request->twitter;
        $update->linkedin = $request->linkedin;
        $update->instagram = $request->instagram;
        $update->youtube = $request->youtube;
        $update->updated_at = Carbon::now();
        $update->update();

        return redirect()->back()->with('message','Setting Updated Successfully');
    }



    public function seoSetting(){
        $data = Seo::find(1);
        return view('admin.setting.seo',compact('data'));
    }


    public function seoSettingStore(Request $request){
        $update = Seo::find(1);
        $update->meta_title = $request->meta_title;
        $update->meta_author = $request->meta_author;
        $update->meta_keywords = $request->meta_keywords;
        $update->meta_description = $request->meta_description;
        $update->update();


        return redirect()->back()->with('message','Seo Setting Updated Successfully');
    }







}
