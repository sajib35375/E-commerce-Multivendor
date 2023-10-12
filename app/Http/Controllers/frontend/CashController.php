<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class CashController extends Controller
{
    public function cashStore(Request $request){

        if (Cache::has('coupon')){
            $amount = cache()->get('coupon')['total_amount']+ Cache::get('charge');
        }else{
            $amount = Cart::total()+ Cache::get('charge');
        }



        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->info,
            'amount' => $amount,
            'payment_type' => 'Cash on Delivery',
            'payment_method' => 'Cash on Delivery',
            'currency' => 'BDT',
            'order_date' => date('Y-m-d'),
            'order_month' => date('F'),
            'order_year' => date('Y'),
            'order_number' => uniqid(),
            'invoice_number' => 'MVE'.mt_rand(10000000,99999999),
            'status' => 'pending',
            'created_at' => Carbon::now()
        ]);


        $mailData = Order::find($order_id);
        $data = [
            'name' => $mailData->name,
            'email' => $mailData->email,
            'amount' => $mailData->amount,
            'order_date' => $mailData->order_date,
            'invoice_number' => $mailData->invoice_number,
            'payment_method' => $mailData->payment_method,
        ];

        Mail::to($request->email)->send(new OrderMail($data));


        $carts = Cart::content();

        foreach ($carts as $cart){
            if ($cart->options->vendor_id){
                $vendor_id = $cart->options->vendor_id;
            }else{
                $vendor_id = NULL;
            }
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $vendor_id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'price' => $cart->price,
                'quantity' => $cart->qty,
                'created_at' => Carbon::now(),
            ]);
        }

        if (Cache::has('coupon')){
            Cache::forget('coupon');
        }

        Cart::destroy();

        Cache::forget('charge');


        return redirect()->route('index')->with('message','Order Completed Successfully');
    }
}
