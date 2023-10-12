<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function pendingOrder(){
        $pending_orders = Order::where('status','pending')->latest()->get();
        return view('admin.orders.all_pending_order',compact('pending_orders'));
    }

    public function OrderDetails($id){
         $order = Order::with('division','district','state')->find($id);
        $order_items = OrderItem::with('product','vendor')->where('order_id',$id)->latest()->get();
        return view('admin.orders.order_details.order_details',compact('order','order_items'));
    }

    public function OrderConfirm($id){
        $confirm = Order::find($id);
        $confirm->status = 'confirm';
        $confirm->update();

        return redirect()->route('all.confirm.order')->with('message','Order Status Confirm Successfully');
    }

    public function OrderProcessing($id){
        $processing = Order::find($id);
        $processing->status = 'processing';
        $processing->update();

        return redirect()->route('all.process.order')->with('message','Order Status Processing Successfully');
    }


    public function StatusDelivered($id){
        $items = OrderItem::where('order_id',$id)->get();
        foreach ($items as $item){
            Product::where('id',$item->product_id)->update([
                'product_qty' => DB::raw('product_qty-'.$item->quantity)
            ]);
        }
        $delivered = Order::find($id);
        $delivered->status = 'delivered';
        $delivered->update();

        return redirect()->route('all.delivered.order')->with('message','Order Status Delivered Successfully');
    }

    public function allConfirmOrder(){
        $all_confirm = Order::where('status','confirm')->latest()->get();
        return view('admin.orders.all_confirm_order',compact('all_confirm'));
    }

    public function allProcessOrder(){
        $all_process = Order::where('status','processing')->latest()->get();
        return view('admin.orders.all_processing_order',compact('all_process'));
    }

    public function allDeliveredOrder(){
        $all_delivered = Order::where('status','delivered')->latest()->get();
        return view('admin.orders.all_delivered',compact('all_delivered'));
    }

    public function adminOrderInvoice($id){
        $order = Order::with('division','district','state')->where('id',$id)->first();
        $order_items = OrderItem::with('product','vendor')->where('order_id',$id)->latest()->get();

        $pdf = Pdf::loadView('frontend.user_profile.user_invoice',compact('order','order_items'))->setPaper('a4')->setOption([
            'temp_dir' => public_path(),
            'chroot' => public_path()
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function allReturnOrder(){
        $return_order = Order::where('return_order',1)->latest()->get();
        return view('admin.return_order.return_request',compact('return_order'));
    }

    public function approveReturnOrder($id){
        $approve = Order::find($id);
        $approve->return_order = '2';
        $approve->update();

        return redirect()->route('all.approve.return.order')->with('message','Return Request Successfully Approved');
    }

    public function allApproveReturnOrder(){
        $allApprove = Order::where('return_order','2')->latest()->get();
        return view('admin.return_order.approve_return_request',compact('allApprove'));
    }








}
