<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function allCoupon(){
        $all_coupon = Coupon::latest()->get();
        return view('admin.coupon.all_coupon',compact('all_coupon'));
    }

    public function addCoupon(){
        return view('admin.coupon.add_new_coupon');
    }

    public function storeCoupon(Request $request){
            $this->validate($request,[
                'coupon_name' => 'required',
                'coupon_validity' => 'required',
                'coupon_discount' => 'required',
            ]);

            Coupon::insert([
                'coupon_name' => $request->coupon_name,
                'coupon_validity' => $request->coupon_validity,
                'coupon_discount' => $request->coupon_discount,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('all.coupon')->with('success','Coupon Inserted Successfully');
    }


    public function editCoupon($id){
        $editCoupon = Coupon::find($id);
        return view('admin.coupon.coupon_edit',compact('editCoupon'));
    }


    public function updateCoupon(Request $request,$id){
        $update_data = Coupon::find($id);
        $update_data->coupon_name = $request->coupon_name;
        $update_data->coupon_validity = $request->coupon_validity;
        $update_data->coupon_discount = $request->coupon_discount;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('all.coupon')->with('success','Coupon Updated Successfully');
    }


    public function deleteCoupon($id){
        $delete_data = Coupon::find($id);
        $delete_data->delete();

        return redirect()->back()->with('warning','Coupon Deleted Successfully');
    }




}
