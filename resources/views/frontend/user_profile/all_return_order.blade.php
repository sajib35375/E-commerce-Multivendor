@extends('frontend.main_master')
@section('main')
    @section('title')
        User Dashboard
    @endsection
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.dashboard') }}" ><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ route('user.order') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('user.all.return.order') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Return Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"  href="{{ route('order.track') }}" ><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.address') }}" ><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.account') }}" ><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.change.password') }}" ><i class="fi-rs-user mr-10"></i>Change Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">

                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Date</th>
                                                        <th>Invoice No.</th>
                                                        <th>Amount</th>
                                                        <th>Payment Method</th>
                                                        <th>Return Reason</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($orders as $order)
                                                        <tr>
                                                            <td>{{ $loop->index+1 }}</td>
                                                            <td>{{ $order->order_date }}</td>
                                                            <td>{{ $order->invoice_number }}</td>
                                                            <td>{{ $order->amount }} ৳</td>
                                                            <td>{{ $order->payment_method }}</td>
                                                            <td>{{ $order->return_reason }}</td>
                                                            <td>
                                                                @if($order->return_order=='0')
                                                                    <span class="badge badge-pill bg-primary">No Return Request</span>
                                                                @elseif($order->return_order=='1')
                                                                    <span class="badge badge-pill bg-danger">Pending</span>
                                                                @elseif($order->return_order=='2')
                                                                    <span class="badge badge-pill bg-success">Success</span>
                                                                    @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('user.order.details',$order->id) }}"><i class="fa fa-eye"></i></a>
                                                                <a href="{{ route('user.invoice',$order->id) }}"><i class="fa fa-download"></i></a>
                                                            </td>

                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Date</th>
                                                        <th>Invoice No.</th>
                                                        <th>Amount</th>
                                                        <th>Payment Method</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
