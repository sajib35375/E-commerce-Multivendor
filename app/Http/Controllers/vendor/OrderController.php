<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function vendorPendingOrder(){
        $pending_orders = OrderItem::with('order')->where('vendor_id',Auth::id())->latest()->get();
        $arr = [];

            if (!$pending_orders->contains('order_id')){
                foreach ($pending_orders as $order) {
                    array_push($arr, $order->order_id);
                }
            }

        $orders = Order::whereIn('id',$arr)->latest()->get();

        return view('vendor.orders.all_vendor_order',compact('orders'));
    }

    public function vendorOrderDetails($id){
        $order = Order::with('division','district','state')->find($id);
        $order_items = OrderItem::with('product')->where('order_id',$id)->where('vendor_id',Auth::id())->latest()->get();

        return view('vendor.orders.vendor_order_details',compact('order','order_items'));
    }

    public function vendorReturnOrder(){
        $return_order = OrderItem::with('order')->where('vendor_id',Auth::id())->latest()->get();
        $arr = [];

        if (!$return_order->contains('order_id')){
            foreach ($return_order as $order) {
                array_push($arr, $order->order_id);
            }
        }
        $orders = Order::whereIn('id',$arr)->where('return_order','1')->latest()->get();

        return view('vendor.orders.vendor_return_order',compact('orders'));
    }


    public function vendorApproveReturnOrder(){
        $return_order = OrderItem::with('order')->where('vendor_id',Auth::id())->latest()->get();
        $arr = [];

        if (!$return_order->contains('order_id')){
            foreach ($return_order as $order) {
                array_push($arr, $order->order_id);
            }
        }
        $orders = Order::whereIn('id',$arr)->where('return_order','2')->latest()->get();
        return view('vendor.orders.vendor_approve_return_order',compact('orders'));
    }











}
