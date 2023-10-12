<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    public function userDashboard(){
        return view('frontend.user_profile.user_profile');
    }

    public function userLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('info','Logout Successfully');
    }

    public function userOrder(){
        $orders = Order::where('user_id',Auth::id())->latest()->get();
        return view('frontend.user_profile.user_order',compact('orders'));
    }

    public function orderTrack(){
        return view('frontend.user_profile.order_track');
    }

    public function userAddress(){
        return view('frontend.user_profile.user_address');
    }

    public function userAccount(){
        $user_data = User::find(Auth::id());
        return view('frontend.user_profile.user_account',compact('user_data'));
    }


    public function userChangePassword(){
        return view('frontend.user_profile.user_change_password');
    }


    public function userAccountStore(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        if ($request->hasFile('photo')){
            $img = $request->file('photo');
            $unique_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(200,200)->save('uploads/user/'.$unique_name);
            unlink('uploads/user/'.$request->old_photo);
        }else{
            $unique_name = $request->old_photo;
        }

        $update_user = User::find(Auth::id());
        $update_user->name = $request->name;
        $update_user->username = $request->username;
        $update_user->email = $request->email;
        $update_user->address = $request->address;
        $update_user->phone = $request->phone;
        $update_user->photo = $unique_name;
        $update_user->updated_at = Carbon::now();
        $update_user->update();

        return redirect()->back()->with('message','User Data Updated Successfully');
    }



    public function storeChangePassword(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);


        if (Hash::check($request->old_password,Auth::user()->password)){
            $user_data = User::find(Auth::id());
            $user_data->password = Hash::make($request->password);
            $user_data->update();
        }

        return redirect()->back()->with('message','Password Change Successfully Successfully');
    }


    public function userOrderDetails($id){
        $order = Order::with('division','district','state')->where('user_id',Auth::id())->where('id',$id)->first();
        $order_items = OrderItem::with('product','vendor')->where('order_id',$id)->latest()->get();
        return view('frontend.user_profile.user_order_details',compact('order','order_items'));
    }


    public function userInvoice($id){
        $order = Order::with('division','district','state')->where('user_id',Auth::id())->where('id',$id)->first();
        $order_items = OrderItem::with('product')->where('order_id',$id)->latest()->get();

        $pdf = Pdf::loadView('frontend.user_profile.user_invoice',compact('order','order_items'))->setPaper('a4')->setOption([
            'temp_dir' => public_path(),
            'chroot' => public_path()
        ]);
        return $pdf->download('invoice.pdf');
    }


    public function returnOrder(Request $request,$id){
        $update = Order::find($id);
        $update->return_date = Carbon::now();
        $update->return_reason = $request->return_reason;
        $update->return_order = '1';
        $update->update();

        return redirect()->back()->with('message','Order Return Request Successfully');
    }

    public function userAllReturnOrder(){
        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->get();
        return view('frontend.user_profile.all_return_order',compact('orders'));
    }

    public function userOrderTracking(Request $request){
        $this->validate($request,[
            'invoice_number' => 'required'
        ]);

        $invoice = $request->invoice_number;
        $track = Order::where('invoice_number',$invoice)->first();

        if ($track){
            return view('frontend.user_profile.order_track_page',compact('track'));
        }else{
            return redirect()->back()->with('error','Invalid Invoice Number');
        }
    }


}
