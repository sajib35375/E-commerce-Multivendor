<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class ActiveUserController extends Controller
{
    public function activeUser(){
        $users = User::where('role','user')->latest()->get();
        return view('admin.user.active_user',compact('users'));
    }

    public function activeUserEdit($id){
        $edit_data = User::find($id);
        return view('admin.user.active_user_edit',compact('edit_data'));
    }

    public function activeUserUpdate(Request $request,$id){
        $update_data = User::find($id);
        if ($request->hasFile('photo')){
            $img = $request->file('photo');
            $unique_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(150,150)->save('uploads/user/'.$unique_name);
            @unlink('uploads/user/'.$request->old_photo);
        }else{
            $unique_name = $request->old_photo;
        }
        $update_data->name = $request->name;
        $update_data->email = $request->email;
        $update_data->phone = $request->phone;
        $update_data->address = $request->address;
        $update_data->photo = $unique_name;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('active.user')->with('message','User Data Updated Successfully');

    }

    public function activeUserDelete($id){
        $delete_user = User::find($id);
        $delete_user->delete();

        return redirect()->back()->with('warning','User Data Deleted Successfully');
    }

    public function activeVendor(){
        $vendors = User::where('role','vendor')->latest()->get();
        return view('admin.user.active_vendor',compact('vendors'));
    }

    public function activeVendorEdit($id){
        $edit_data = User::find($id);
        return view('admin.user.active_vendor_edit',compact('edit_data'));
    }

    public function activeVendorUpdate(Request $request,$id){
        $update_data = User::find($id);
        if ($request->hasFile('photo')){
            $img = $request->file('photo');
            $unique_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(150,150)->save('AdminBackend/upload/admin/'.$unique_name);
            @unlink('AdminBackend/upload/admin/'.$request->old_photo);
        }else{
            $unique_name = $request->old_photo;
        }
        $update_data->name = $request->name;
        $update_data->email = $request->email;
        $update_data->phone = $request->phone;
        $update_data->address = $request->address;
        $update_data->photo = $unique_name;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('active.vendor')->with('message','Vendor Data Updated Successfully');
    }

    public function activeVendorDelete($id){
        $delete_data = User::find($id);
        $delete_data->delete();

        return redirect()->back()->with('warning','Vendor Data Deleted Successfully');
    }

}
