<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class AdminController extends Controller
{
    public function adminDashboard(){
        $all_pending = Order::with('user')->where('status','pending')->latest()->get();
        return view('admin.index',compact('all_pending'));
    }

    public function adminLogout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('info','Logout Successfully');
    }

    public function adminLogin(){
        return view('admin.admin_login');
    }

    // Admin Profile Update
    public function adminProfile(){
        $id = Auth::user()->id;
        $adminProfile = User::find($id);
        return view('admin.profile.admin_profile',compact('adminProfile'));
    }

    public function adminProfileUpdate(Request $request){
        $id = Auth::id();
        $update_profile = User::find($id);

        if ($request->hasFile('photo')){
            $image = $request->file('photo');
            $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(224,224)->save('AdminBackend/upload/admin/'.$unique_name);
            @unlink('AdminBackend/upload/admin/'.$request->old_photo);
        }else {
            $unique_name = $request->old_photo;
        }

        $update_profile->name = $request->name;
        $update_profile->email = $request->email;
        $update_profile->phone = $request->phone;
        $update_profile->photo = $unique_name;
        $update_profile->address = $request->address;
        $update_profile->updated_at = Carbon::now();
        $update_profile->update();

        return redirect()->back()->with('message','Admin Data Updated Successfully');
    }

    public function AdminChangePassword(){
        return view('admin.profile.change_password');
    }

    public function AdminChangePasswordStore(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $id = Auth::id();
        $admin_data = User::find($id);

        if (Hash::check($request->old_password,$admin_data->password)){
            $admin_data->password = Hash::make($request->password);
            $admin_data->update();
            return redirect()->back()->with('message','Password Changed Successfully');
        }else{
            return redirect()->back()->with('error','Password Not Match');
        }

    }

    // active vendor and inactive vendor

    public function vendorInactive(){
        $InactiveVendor = User::where('role','vendor')->where('status','inactive')->get();
        return view('admin.vendor.inactive_vendor',compact('InactiveVendor'));
    }


    public function vendorInactiveDetails($id){
            $inactive_details = User::where('role','vendor')->where('status','inactive')->where('id',$id)->first();
        return view('admin.vendor.inactive_vendor_details',compact('inactive_details'));
    }


    public function vendorStatusActive($id){
            $active = User::find($id);
            $active->status = 'active';
            $active->update();

        return redirect()->route('vendor.active')->with('message','Vendor Status Activated Successfully');
    }

    public function vendorActive(){
       $activeVendor = User::where('role','vendor')->where('status','active')->get();
        return view('admin.vendor.active_vendor',compact('activeVendor'));
    }

    public function vendorActiveDetails($id){
        $active_vendor = User::where('role','vendor')->where('status','active')->where('id',$id)->first();
        return view('admin.vendor.active_vendor_details',compact('active_vendor'));
    }


    public function vendorStatusInactive($id){
           $inactive = User::find($id);
           $inactive->status = 'inactive';
           $inactive->update();

        return redirect()->route('vendor.inactive')->with('message','Vendor Status Inactivated Successfully');
    }










}
