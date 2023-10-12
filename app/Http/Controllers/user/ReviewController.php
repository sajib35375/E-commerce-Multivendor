<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function productReview(Request $request){
        $this->validate($request,[
            'quality' => 'required',
            'comment' => 'required'
        ]);

        Review::insert([
            'product_id' => $request->product_id,
            'vendor_id' => $request->vendor_id,
            'user_id' => Auth::id(),
            'quality' => $request->quality,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('message','Admin will Approve Review, Thanks for Your Feedback');
    }

    ///////////  Admin Review  ////////////

    public function allReview(){
        $reviews = Review::with('user','vendor','product')->latest()->get();
        return view('admin.review.review',compact('reviews'));
    }


    public function reviewActive($id){
        $active = Review::find($id);
        $active->status = 1;
        $active->update();

        return redirect()->back()->with('message','Review Activated Successfully');
    }

    public function reviewInactive($id){
        $inactive = Review::find($id);
        $inactive->status = 0;
        $inactive->update();

        return redirect()->back()->with('message','Review InActivated Successfully');
    }

    public function reviewEdit($id){
        $edit_data = Review::find($id);
        $users = User::where('role','user')->get();
        $vendors = User::where('role','vendor')->get();
        $products = Product::where('status',1)->get();

        return view('admin.review.review_edit',compact('edit_data','users','vendors','products'));
    }

    public function reviewUpdate(Request $request,$id){
        $update_data = Review::find($id);
        $update_data->user_id = $request->user_id;
        $update_data->product_id = $request->product_id;
        $update_data->comment = $request->comment;
        $update_data->quality = $request->quality;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('all.review')->with('message','Review Updated Successfully');
    }

    public function vendorReview(){
        $reviews = Review::with('user','vendor','product')->where('vendor_id',Auth::id())->where('status',1)->latest()->get();
        return view('vendor.review.vendor_review',compact('reviews'));
    }


}
