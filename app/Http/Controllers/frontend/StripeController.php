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
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function stripeStore(Request $request){
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51NWmWiDNCSRcOc2vBH595WOU6qlsJwbCd1HUgUgzKCyfWS62yjXqYEUFPi5nudfMsVbTuYo50DMJjcQasuEVVoXZ00vINRkY0a');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        if (Cache::has('coupon')){
            $amount = cache()->get('coupon')['total_amount']+ Cache::get('charge');
        }else{
            $amount = Cart::total()+ Cache::get('charge');
        }

        $charge = \Stripe\Charge::create([
            'amount' => $amount*100,
            'currency' => 'usd',
            'description' => 'Multi Vendor Ecommerce',
            'source' => $token,
            'metadata' => ['order_id' => '6735'],
        ]);

        //dd($charge);



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
            'payment_type' => $charge->payment_method,
            'payment_method' => 'Stripe',
            'transaction_id' => $charge->balance_transaction,
            'currency' => 'usd',
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
