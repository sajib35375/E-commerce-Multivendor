<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class VendorController extends Controller
{
    public function vendorDashboard(){
        $id = Auth::id();
        $approve = User::find($id);
        return view('vendor.index',compact('approve'));
    }

    public function vendorLogout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/vendor/login')->with('info','Logout Successfully');
    }

    public function vendorLogin(){
        return view('vendor.vendor_login');
    }

    public function vendorProfile(){
        $id = Auth::user()->id;
        $vendorProfile = User::find($id);

        return view('vendor.profile.vendor_profile',compact('vendorProfile'));
    }


    public function vendorProfileUpdate(Request $request){
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
        $update_profile->vendor_join = $request->vendor_join;
        $update_profile->vendor_info = $request->vendor_info;
        $update_profile->updated_at = Carbon::now();
        $update_profile->update();

        return redirect()->back()->with('message','Vendor Data Updated Successfully');
    }

    public function vendorChangePassword(){
        return view('vendor.profile.change_password');
    }


    public function vendorChangePasswordUpdate(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $id = Auth::id();
        $vendor_data = User::find($id);

        if (Hash::check($request->old_password,$vendor_data->password)){
            $vendor_data->password = Hash::make($request->password);
            $vendor_data->update();
            return redirect()->back()->with('message','Password Changed Successfully');
        }else{
            return redirect()->back()->with('error','Password Not Match');
        }
    }


    public function vendorRegister(){
        return view('vendor.vendor_register');
    }

    public function vendorRegisterStore(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

            User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('vendor.login')->with('message','Vendor Registered Successfully');

    }






}
