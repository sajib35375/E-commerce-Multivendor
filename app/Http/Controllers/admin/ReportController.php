<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function allReports(){
        return view('admin.report.report');
    }

    public function dateReports(Request $request){
        $date = $request->date;
        $orders = Order::where('order_date',$date)->latest()->get();

        return view('admin.report.date_report',compact('orders'));
    }

    public function monthReports(Request $request){
        $month = $request->month;
        $year = $request->year_name;
        $orders = Order::where('order_month',$month)->where('order_year',$year)->latest()->get();

        return view('admin.report.month_report',compact('orders'));
    }

    public function yearReports(Request $request){
        $year = $request->year;
        $orders = Order::where('order_year',$year)->latest()->get();

        return view('admin.report.year_report',compact('orders'));
    }

    public function userReportsShow(){
        $users = User::where('role','user')->get();
        return view('admin.report.user_report_yearly',compact('users'));
    }

    public function userReportsStore(Request $request){
        $year = $request->year;
        $user_id = $request->user_id;
        $orders = Order::where('order_year',$year)->where('user_id',$user_id)->get();

        return view('admin.report.user_report_data',compact('orders'));
    }






}
